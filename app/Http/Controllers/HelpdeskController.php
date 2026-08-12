<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HelpdeskController extends Controller
{
    private function apiBase()
    {
        return rtrim(config('services.chatbot_api.url', 'https://api-chatbot.futurecloud.id'), '/');
    }

    private function helpdesk()
    {
        return Auth::guard('helpdesk')->user();
    }

    public function dashboard()
    {
        $helpdesk = $this->helpdesk();
        return view('helpdesk.dashboard', compact('helpdesk'));
    }

    /**
     * Poll chat data from chatbot-plugin-api
     */
    public function poll(Request $request)
    {
        $helpdesk = $this->helpdesk();

        try {
            $response = Http::timeout(10)->get($this->apiBase() . '/api/helpdesk/poll', [
                'license' => $helpdesk->license_key,
                'helpdesk_id' => $helpdesk->id,
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return response()->json([
            'pending' => [],
            'active' => [],
            'ended' => [],
        ]);
    }

    /**
     * Claim a pending chat
     */
    public function claim(Request $request)
    {
        $request->validate(['lead_id' => 'required|integer']);
        $helpdesk = $this->helpdesk();

        try {
            $response = Http::timeout(10)->post($this->apiBase() . '/api/helpdesk/claim', [
                'license' => $helpdesk->license_key,
                'helpdesk_id' => $helpdesk->id,
                'helpdesk_name' => $helpdesk->name,
                'lead_id' => $request->lead_id,
            ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal menghubungi server.'], 500);
        }
    }

    /**
     * Send a message in an active chat
     */
    public function send(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|integer',
            'message' => 'required|string',
        ]);
        $helpdesk = $this->helpdesk();

        try {
            $response = Http::timeout(10)->post($this->apiBase() . '/api/helpdesk/send', [
                'license' => $helpdesk->license_key,
                'helpdesk_id' => $helpdesk->id,
                'helpdesk_name' => $helpdesk->name,
                'lead_id' => $request->lead_id,
                'message' => $request->message,
            ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal mengirim pesan.'], 500);
        }
    }

    /**
     * End an active chat session
     */
    public function endChat(Request $request)
    {
        $request->validate(['lead_id' => 'required|integer']);
        $helpdesk = $this->helpdesk();

        try {
            $response = Http::timeout(10)->post($this->apiBase() . '/api/helpdesk/end', [
                'license' => $helpdesk->license_key,
                'helpdesk_id' => $helpdesk->id,
                'helpdesk_name' => $helpdesk->name,
                'lead_id' => $request->lead_id,
            ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal mengakhiri chat.'], 500);
        }
    }
}
