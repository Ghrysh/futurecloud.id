<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\EmailAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Cache\FileStore;
use Illuminate\Cache\Repository;
use Illuminate\Filesystem\Filesystem;
use Webklex\PHPIMAP\ClientManager;

class WebmailService
{
    protected function getCache()
    {
        $webmailCachePath = storage_path('webmail-cache');

        $fileStore = new FileStore(
            new Filesystem(),
            $webmailCachePath
        );

        return new Repository($fileStore);
    }

    protected function getImapClient($account)
    {
        $cm = new ClientManager();

        return $cm->make([
            'host'          => $account->imap_host,
            'port'          => (int) $account->imap_port,
            'username'      => $account->email,
            'password'      => $account->email_password,
            'protocol'      => $account->imap_protocol ?? 'imap',
            'encryption'    => $account->imap_encryption ?: false,
            'validate_cert' => false,
            'timeout'       => 10,
        ]);
    }

    public function getFolders(EmailAccount $account): array
    {
        $customCache = $this->getCache();

        $cacheKeyFolders = "webmail_folders_{$account->id}";

        Log::info('WEBMAIL CACHE CHECK FOLDERS', [
            'key'    => $cacheKeyFolders,
            'exists' => $customCache->has($cacheKeyFolders),
        ]);

        return $customCache->remember(
            $cacheKeyFolders,
            now()->addMinutes(10),

            function () use ($account) {

                Log::info("Webmail IMAP - [CACHE MISS] Folder {$account->email}");

                $client = $this->getImapClient($account);

                $client->connect();

                $folders = $client->getFolders(false);

                $mappedFolders = [];

                foreach ($folders as $folder) {

                    $mappedFolders[] = [
                        'full_name' => trim($folder->full_name),
                        'name'      => trim($folder->name),
                    ];
                }

                return $mappedFolders;
            }
        );
    }

    public function getMessages(
        EmailAccount $account,
        string $folderName
    ): array {

        $customCache = $this->getCache();

        $folderName = trim($folderName);

        $cacheKeyMessages = "webmail_messages_{$account->id}_" .
            md5(strtolower($folderName));

        Log::info('WEBMAIL CACHE CHECK MESSAGES', [
            'folder' => $folderName,
            'key'    => $cacheKeyMessages,
            'exists' => $customCache->has($cacheKeyMessages),
        ]);

        return $customCache->remember(
            $cacheKeyMessages,
            now()->addMinutes(10),

            function () use ($account, $folderName) {

                Log::info("Webmail IMAP - [CACHE MISS] Folder {$folderName} (WebmailService)");

                $client = $this->getImapClient($account);

                $client->connect();

                $selectedFolder = null;

                $folders = $client->getFolders(false);

                foreach ($folders as $folder) {

                    if (
                        strtolower(trim($folder->full_name))
                        === strtolower($folderName)
                    ) {

                        $selectedFolder = $folder;
                        break;
                    }
                }

                if (!$selectedFolder) {

                    $selectedFolder = $client->getFolder($folderName);
                }

                if (!$selectedFolder) {
                    return [];
                }

                $fetchedMessages = $selectedFolder
                    ->messages()
                    ->all()
                    ->limit(20)
                    ->get();

                $mappedMessages = [];

                foreach ($fetchedMessages as $msg) {

                    $attachmentsData = [];

                    if ($msg->hasAttachments()) {

                        try {

                            foreach (
                                $msg->getAttachments()
                                as $attachment
                            ) {

                                $attachmentsData[] = [
                                    'name' => $attachment->getName(),
                                    'size' => round(
                                        ($attachment->size ?? 0) / 1024,
                                        2
                                    ) . ' KB',
                                ];
                            }

                        } catch (\Exception $e) {

                            Log::warning(
                                "Attachment gagal UID: " .
                                $msg->getUid()
                            );
                        }
                    }

                    $fromCollection = $msg->getFrom();

                    $firstFrom = !empty($fromCollection)
                        && isset($fromCollection[0])
                        ? $fromCollection[0]
                        : null;

                    $toCollection = $msg->getTo();

                    $firstTo = !empty($toCollection)
                        && isset($toCollection[0])
                        ? $toCollection[0]
                        : null;

                    $subjectData = $msg->getSubject();

                    $subject = is_array($subjectData)
                        ? ($subjectData[0] ?? '(Tanpa Subjek)')
                        : ($subjectData ?? '(Tanpa Subjek)');

                    $dateFormatted = '-';

                    try {

                        $dateData = $msg->getDate();

                        if (
                            is_array($dateData)
                            && isset($dateData[0])
                        ) {

                            $dateData = $dateData[0];
                        }

                        if ($dateData) {

                            $dateFormatted = Carbon::parse($dateData)
                                ->format('d M Y, H:i');
                        }

                    } catch (\Exception $e) {

                        Log::warning(
                            "Format tanggal gagal UID: " .
                            $msg->getUid()
                        );
                    }

                    $previewBody = substr(
                        strip_tags(
                            $msg->getHTMLBody()
                            ?? (
                                $msg->getTextBody()
                                ?? 'Tidak ada isi pesan.'
                            )
                        ),
                        0,
                        150
                    );

                    $mappedMessages[] = [
                        'uid'             => (string) $msg->getUid(),
                        'subject'         => (string) $subject,

                        'from_name' =>
                            $firstFrom && isset($firstFrom->personal)
                            ? (string) $firstFrom->personal
                            : (
                                $firstFrom && isset($firstFrom->mail)
                                ? (string) $firstFrom->mail
                                : '(Unknown)'
                            ),

                        'from_mail' =>
                            $firstFrom && isset($firstFrom->mail)
                            ? (string) $firstFrom->mail
                            : '-',

                        'to_mail' =>
                            $firstTo && isset($firstTo->mail)
                            ? (string) $firstTo->mail
                            : '-',

                        'date'            => (string) $dateFormatted,

                        'is_seen'         => (bool)
                            ($msg->getFlags()->has('seen')),

                        'has_attachments' => (bool)
                            $msg->hasAttachments(),

                        'attachments'     => $attachmentsData,

                        'raw_body'        => $previewBody,
                    ];
                }

                return $mappedMessages;
            }
        );
    }

    public function refreshFolder(
        EmailAccount $account,
        string $folderName
    ): void {

        $customCache = $this->getCache();

        $cacheKeyMessages = "webmail_messages_{$account->id}_" .
            md5(strtolower(trim($folderName)));

        $customCache->forget($cacheKeyMessages);
    }
}