<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Halaman Contact
    public function index()
    {
        return view('contact');
    }

    // Proses Kirim Email
    public function send(Request $request)
    {
        // 1. Validasi Input
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Cek Login (Server Side Protection)
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengirim pesan.');
        }

        // 3. Kirim Email ke Admin
        try {
            Mail::to('ptbtt01@gmail.com')->send(new ContactFormMail($data));
            return back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi nanti. Error: ' . $e->getMessage())->withInput();
        }
    }
}