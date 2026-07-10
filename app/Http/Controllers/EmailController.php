<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\WebmailService;
use App\Models\EmailAccount;
use Webklex\PHPIMAP\ClientManager;
use Symfony\Component\Mailer\Transport;
use Illuminate\Mail\Mailer;

class EmailController extends Controller
{
    public function index(Request $request, WebmailService $webmailService)
    {
        try {

            $accountId = session('email_account_id');

            $account = EmailAccount::find($accountId);

            if (!$account) {

                return redirect()
                    ->route('webmail.login')
                    ->withErrors([
                        'email' => 'Session email tidak valid.'
                    ]);
            }

            $currentFolderName = trim(
                $request->query('folder', 'INBOX')
            );

            if ($request->has('refresh')) {

                $webmailService->refreshFolder(
                    $account,
                    $currentFolderName
                );
            }

            $folders = $webmailService->getFolders($account);

            $messages = $webmailService->getMessages(
                $account,
                $currentFolderName
            );

            return view('webmail.inbox', [
                'folders'       => $folders,
                'currentFolder' => $currentFolderName,
                'messages'      => collect($messages),
                'status'        => 'Connected',
                'account'       => $account,
            ]);

        } catch (\Exception $e) {

            Log::error("Webmail error", [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function refreshFolder(Request $request, WebmailService $webmailService)
    {
        $accountId = session('email_account_id');

        $account = EmailAccount::find($accountId);

        if (!$account) {
            return response()->json([
                'success' => false
            ]);
        }

        $folder = trim($request->folder ?? 'INBOX');

        /*
        |--------------------------------------------------------------------------
        | Hapus cache folder aktif
        |--------------------------------------------------------------------------
        */

        $webmailService->refreshFolder($account, $folder);

        /*
        |--------------------------------------------------------------------------
        | Ambil ulang dari IMAP
        |--------------------------------------------------------------------------
        */

        $messages = $webmailService->getMessages(
            $account,
            $folder
        );

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    public function sendEmail(Request $request)
    {
        // 1. Ambil dan bersihkan string Cc/Bcc menjadi array email bersih
        // Menghapus spasi dan memisahkan berdasarkan karakter koma (jika ada)
        $ccEmails = $request->filled('cc') 
            ? array_filter(array_map('trim', explode(',', $request->input('cc')))) 
            : [];
            
        $bccEmails = $request->filled('bcc') 
            ? array_filter(array_map('trim', explode(',', $request->input('bcc')))) 
            : [];

        // Gabungkan kembali ke request untuk divalidasi sebagai array
        $request->merge([
            'cc_array' => $ccEmails,
            'bcc_array' => $bccEmails,
        ]);

        // 2. Validasi input data dari form modal
        $request->validate([
            'to'          => 'required|email',
            'cc_array'    => 'nullable|array',
            'cc_array.*'  => 'email', // Memastikan setiap email di dalam list Cc valid
            'bcc_array'   => 'nullable|array',
            'bcc_array.*' => 'email', // Memastikan setiap email di dalam list Bcc valid
            'subject'     => 'required|string|max:255',
            'body'        => 'required|string',
            'attachments'   => 'nullable|array',
            'attachments.*' => 'nullable|file|max:10240', // Maksimal 10MB per file
        ]);

        // Catat log ketika request pengiriman mulai masuk
        Log::info("Webmail: Memulai proses kirim email.", [
            'to'                       => $request->input('to'),
            'cc'                       => $ccEmails,
            'bcc'                      => $bccEmails,
            'subject'                  => $request->input('subject'),
            'session_email_account_id' => session('email_account_id'),
            'has_attachments'          => $request->hasFile('attachments') ? 'Yes (' . count($request->file('attachments')) . ' files)' : 'No'
        ]);

        try {
            // Ambil akun pengirim dari database berdasarkan session login
            $account = EmailAccount::find(session('email_account_id'));

            if (!$account) {
                Log::warning("Webmail Send Error: Sesi email_account_id tidak ditemukan atau tidak valid di database.");
                return redirect()->back()->with('error', 'Sesi Anda telah berakhir, akun pengirim tidak ditemukan.');
            }

            $to      = $request->input('to');
            $subject = $request->input('subject');
            $content = $request->input('body');

            // Fallback cerdas jika data SMTP di database masih kosong
            $smtpHost = $account->smtp_host ?: ($account->imap_host ?? 'localhost');
            
            if ($account->smtp_port) {
                $smtpPort = (int) $account->smtp_port;
            } else {
                // Jika port kosong, deteksi dari keamanan IMAP
                $smtpPort = ($account->imap_port == 993 || $account->imap_encryption === 'ssl') ? 465 : 587;
            }

            // Tentukan skema enkripsi DSN
            $encryption = ($smtpPort == 465) ? 'smtps' : 'smtp'; 

            // Buat DSN Transport manual untuk Symfony Mailer secara real-time
            $dsn = sprintf(
                '%s://%s:%s@%s:%s',
                $encryption,
                urlencode($account->email),
                urlencode($account->email_password),
                $smtpHost,
                $smtpPort
            );

            $symfonyTransport = Transport::fromDsn($dsn);
            
            $dynamicMailer = new Mailer(
                'dynamic_vps_mailer',
                app()->get('view'),
                $symfonyTransport,
                app()->get('events')
            );

            $dynamicMailer->alwaysFrom($account->email, explode('@', $account->email)[0]);

            $attachments = $request->file('attachments') ?? [];

            // 3. Kirim email menggunakan instance mailer dinamis
            // Masukkan array $ccEmails dan $bccEmails ke dalam scope closure 'use'
            $dynamicMailer->raw($content, function ($message) use ($to, $ccEmails, $bccEmails, $subject, $attachments) {
                $message->to($to)->subject($subject);

                // Jika array Cc tidak kosong, masukkan ke mailer
                if (!empty($ccEmails)) {
                    $message->cc($ccEmails);
                }

                // Jika array Bcc tidak kosong, masukkan ke mailer
                if (!empty($bccEmails)) {
                    $message->bcc($bccEmails);
                }

                // Perulangan untuk melampirkan berkas
                foreach ($attachments as $file) {
                    if ($file->isValid()) {
                        $message->attach($file->getRealPath(), [
                            'as'   => $file->getClientOriginalName(),
                            'mime' => $file->getClientMimeType(),
                        ]);
                    }
                }
            });

            // Log sukses setelah Mailer berhasil mengirim
            Log::info("Webmail Success: Email berhasil dikirim.", [
                'from'    => $account->email,
                'to'      => $to,
                'cc'      => $ccEmails,
                'bcc'     => $bccEmails,
                'subject' => $subject
            ]);

            return redirect()->back()->with('with', 'success')->with('success', 'Email berhasil dikirim ke ' . $to);

        } catch (Exception $e) {
            Log::error("Webmail Failed: Gagal mengirim email via SMTP dinamis.", [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'account_email' => isset($account) ? $account->email : 'Unknown'
            ]);

            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'folder' => 'required'
        ]);

        try {
            $account = EmailAccount::find(session('email_account_id'));
            
            $cm = new ClientManager();
            $client = $cm->make([
                'host'          => $account->imap_host,
                'port'          => (int) $account->imap_port,
                'username'      => $account->email,
                'password'      => $account->email_password,
                'protocol'      => $account->imap_protocol ?? 'imap',
                'encryption'    => $account->imap_encryption ?: false,
                'validate_cert' => false,
            ]);
            
            $client->connect();
            
            // Dapatkan folder asal saat ini
            $folder = $client->getFolder($request->folder);
            
            // Cari pesan berdasarkan UID
            $message = $folder->query()->getMessageByUid($request->uid);
            
            if ($message) {
                // Pindahkan pesan ke folder Trash secara otomatis
                // Library Webklex akan otomatis mencari nama folder "Trash" atau "INBOX.Trash" di server
                $message->move('Trash'); 
                
                return redirect()->back()->with('success', 'Email berhasil dipindahkan ke kotak sampah.');
            }

            return redirect()->back()->with('error', 'Pesan tidak ditemukan.');

        } catch (\Exception $e) {
            Log::error("Webmail IMAP Delete Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus pesan: ' . $e->getMessage());
        }
    }
}