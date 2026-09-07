<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailcowService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.mailcow.url'), '/');
        $this->apiKey = config('services.mailcow.key');
    }

    protected function client()
    {
        return Http::withHeaders([
            'X-API-Key' => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
    }

    // Ambil semua mailbox
    public function getMailboxes()
    {
        return $this->client()
            ->get($this->baseUrl . '/get/mailbox/all')
            ->json();
    }

    // Edit mailbox
    public function updateMailbox($username, $data)
    {
        $quotaMb = (int) $data['quota'];

        // GUNAKAN 1 / 0
        $isActive = ($data['active'] == 1 || $data['active'] === '1') ? 1 : 0;

        $payload = [
            'items' => [$username],
            'attr' => [
                'name'   => $data['name'],
                'quota'  => $quotaMb,
                'active' => $isActive,
            ]
        ];

        Log::info("Mengirim POST request ke Mailcow API /edit/mailbox", [
            'url' => $this->baseUrl . '/edit/mailbox',
            'payload' => $payload
        ]);

        $response = $this->client()
            ->post($this->baseUrl . '/edit/mailbox', $payload)
            ->json();

        Log::info("Response diterima dari Mailcow API /edit/mailbox", [
            'target_username' => $username,
            'raw_response' => $response
        ]);

        return $response;
    }

    // Tambah mailbox baru
    public function createMailbox($data)
    {
        $payload = [
            'local_part' => strstr($data['username'], '@', true),
            'domain'     => substr(strrchr($data['username'], "@"), 1),
            'name'       => $data['name'],
            'quota'      => (string) ((int) $data['quota']),
            'password'   => $data['password'],
            'password2'  => $data['password'],
            'active'     => '1',
        ];

        Log::info('Mengirim request create mailbox ke Mailcow', [
            'url'     => $this->baseUrl . '/add/mailbox',
            'payload' => [
                'local_part' => $payload['local_part'],
                'domain'     => $payload['domain'],
                'name'       => $payload['name'],
                'quota'      => $payload['quota'],
                'active'     => $payload['active'],
            ]
        ]);

        $response = $this->client()
            ->post($this->baseUrl . '/add/mailbox', $payload);

        $json = $response->json();

        Log::info('Response Mailcow create mailbox diterima', [
            'response' => $json,
            'status'   => $response->status(),
        ]);

        return $json;
    }

    // Hapus mailbox
    public function deleteMailbox($username)
    {
        $payload = [
            $username
        ];

        Log::info('Mengirim request delete mailbox ke Mailcow', [
            'url'      => $this->baseUrl . '/delete/mailbox',
            'username' => $username,
            'payload'  => $payload,
        ]);

        $response = $this->client()
            ->post($this->baseUrl . '/delete/mailbox', $payload);

        $json = $response->json();

        Log::info('Response Mailcow delete mailbox diterima', [
            'username' => $username,
            'response' => $json,
            'status'   => $response->status(),
            'raw'      => $response->body(),
        ]);

        return $json;
    }

    public function getDomain($domain)
    {
        return $this->client()
            ->get($this->baseUrl . '/get/domain/' . $domain)
            ->json();
    }

    public function getDomains()
    {
        Log::info('Mengambil daftar domain dari Mailcow', [
            'url' => $this->baseUrl . '/get/domain/all',
        ]);

        $response = $this->client()
            ->get($this->baseUrl . '/get/domain/all');

        $json = $response->json();

        Log::info('Response Mailcow get domains diterima', [
            'status' => $response->status(),
            'response' => $json,
        ]);

        return $json;
    }

    // Tambah domain baru
    public function createDomain($data)
    {
        $payload = [
            'domain'             => $data['domain'],
            'description'        => $data['description'] ?? $data['domain'],
            'aliases'            => (string) ($data['aliases'] ?? 400),
            'mailboxes'          => (string) ($data['mailboxes'] ?? 50),
            'defquota'           => (string) ($data['defquota'] ?? 1024),
            'maxquota'           => (string) ($data['maxquota'] ?? 2048),
            'quota'              => (string) ($data['quota'] ?? 10240),
            'active'             => '1',
            'rl_value'           => null,
            'rl_frame'           => 's',
            'backupmx'           => '0',
            'relay_all_recipients' => '0',
            'restart_sogo'       => '1',
        ];

        Log::info('Mengirim request create domain ke Mailcow', [
            'url' => $this->baseUrl . '/add/domain',
            'payload' => $payload,
        ]);

        $response = $this->client()
            ->post($this->baseUrl . '/add/domain', $payload);

        $json = $response->json();

        Log::info('Response Mailcow create domain diterima', [
            'status' => $response->status(),
            'response' => $json,
        ]);

        return $json;
    }
}