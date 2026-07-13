<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotLead;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotAdminController extends Controller
{
    public function index()
    {
        $knowledges = ChatbotKnowledge::latest()->get();
        return view('admin.chatbot.index', compact('knowledges'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'intent_name' => 'required',
            'keywords' => 'required',
            'response' => 'required'
        ]);

        $keywordsArray = array_map('trim', explode(',', strtolower($request->keywords)));

        ChatbotKnowledge::create([
            'topic' => $request->topic,
            'intent_name' => Str::slug($request->intent_name, '_'),
            'keywords' => json_encode($keywordsArray),
            'response' => $request->response
        ]);

        return back()->with('success', 'Respon bot ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'topic' => 'required',
            'intent_name' => 'required',
            'keywords' => 'required',
            'response' => 'required'
        ]);

        $knowledge = ChatbotKnowledge::findOrFail($id);
        $keywordsArray = array_map('trim', explode(',', strtolower($request->keywords)));
        
        $knowledge->update([
            'topic' => $request->topic,
            'intent_name' => Str::slug($request->intent_name, '_'),
            'keywords' => json_encode($keywordsArray),
            'response' => $request->response
        ]);

        return back()->with('success', 'Respon berhasil diperbarui');
    }

    public function destroy($id)
    {
        ChatbotKnowledge::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }

    public function history()
    {
        $leads = ChatbotLead::latest()->get();
        return view('admin.chatbot.history', compact('leads'));
    }

    public function live()
    {
        return view('admin.chatbot.live');
    }

    public function toggleLeadStatus($id)
    {
        $lead = ChatbotLead::findOrFail($id);
        $lead->status = $lead->status === 'pending' ? 'contacted' : 'pending';
        $lead->save();
        return back()->with('success', 'Status follow up diperbarui!');
    }

    public function getLeadHistory($id)
    {
        $lead = ChatbotLead::findOrFail($id);
        return response()->json([
            'history' => json_decode($lead->chat_history, true) ?? []
        ]);
    }

    public function pollLiveChats() {
        return response()->json([
            'pending' => \App\Models\ChatbotLead::with('user')->where('live_chat_status', 'pending')->latest()->get(),
            'active'  => \App\Models\ChatbotLead::with('user')->where('live_chat_status', 'active')->where('admin_id', auth('admin')->id())->latest()->get(),
            'ended'   => \App\Models\ChatbotLead::with('user')->where('live_chat_status', 'ended')->where('admin_id', auth('admin')->id())->latest()->get()
        ]);
    }

    public function actionLiveChat(Request $request) {
        $lead = \App\Models\ChatbotLead::find($request->lead_id);
        $adminName = auth('admin')->user()->name;
        
        if ($request->action === 'accept') {
            $history = json_decode($lead->chat_history, true) ?? [];
            $history[] = ['sender' => 'admin', 'text' => "Halo, saya {$adminName}. Ada yang bisa saya bantu?", 'time' => now()->format('d M, H:i')];
            $lead->update(['live_chat_status' => 'active', 'admin_id' => auth('admin')->id(), 'chat_history' => json_encode($history)]);
        } elseif ($request->action === 'reject') {
            $history = json_decode($lead->chat_history, true) ?? [];
            $history[] = ['sender' => 'bot', 'text' => 'Maaf, saat ini semua admin sedang sibuk. Silakan tinggalkan kontak Anda di bawah ini agar kami bisa menghubungi Anda.', 'time' => now()->format('d M, H:i')];
            $lead->update(['live_chat_status' => 'ended', 'chat_history' => json_encode($history)]);
        } elseif ($request->action === 'end') {
            $history = json_decode($lead->chat_history, true) ?? [];
            $history[] = ['sender' => 'bot', 'text' => "Obrolan Live Chat dengan {$adminName} telah berakhir. Anda kembali terhubung dengan Asisten Virtual.", 'time' => now()->format('d M, H:i')];
            $lead->update(['live_chat_status' => 'ended', 'chat_history' => json_encode($history)]);
        }
        return response()->json(['success' => true]);
    }

    public function sendLiveChatMessage(Request $request) {
        $lead = \App\Models\ChatbotLead::find($request->lead_id);
        
        if ($lead && !empty($request->message)) {
            $history = json_decode($lead->chat_history, true) ?? [];
            $history[] = ['sender' => 'admin', 'text' => $request->message, 'time' => now()->format('d M, H:i')];
            
            $lead->update([
                'chat_history' => json_encode($history),
                'updated_at' => now()
            ]);
        }
        
        return response()->json(['success' => true]);
    }
}