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
}