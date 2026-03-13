<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotResponse;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatbotAdminController extends Controller
{
    // 1. Halaman Kelola Jawaban (Knowledge Base)
    public function index()
    {
        $responses = ChatbotResponse::latest()->get();
        return view('admin.chatbot.index', compact('responses'));
    }

    public function store(Request $request)
    {
        ChatbotResponse::create($request->validate([
            'keyword' => 'required',
            'answer' => 'required'
        ]));
        return back()->with('success', 'Respon bot ditambahkan');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'keyword' => 'required',
        'answer' => 'required',
    ]);

    $response = \App\Models\ChatbotResponse::findOrFail($id);
    $response->update([
        'keyword' => $request->keyword,
        'answer' => $request->answer
    ]);

    return back()->with('success', 'Respon berhasil diperbarui');
}

    public function destroy($id)
    {
        ChatbotResponse::destroy($id);
        return back()->with('success', 'Deleted');
    }

    // 2. Halaman History Chat User
    public function history()
    {
        $sessions = ChatSession::with('messages')->latest()->get();
        return view('admin.chatbot.history', compact('sessions'));
    }
}