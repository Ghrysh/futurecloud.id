<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->orderBy('updated_at', 'desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('messages.user', 'messages.admin', 'user')->findOrFail($id);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('tickets', 'public');
        }

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'admin_id' => Auth::guard('admin')->id(),
            'message' => $request->message,
            'attachment' => $attachmentPath,
        ]);

        $ticket->update(['status' => 'answered']);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim.');
    }

    public function status(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $request->validate([
            'status' => 'required|in:open,answered,closed'
        ]);

        $ticket->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }
}
