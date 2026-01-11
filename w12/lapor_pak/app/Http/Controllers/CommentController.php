<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ticket $ticket)
    {
        // Ensure user can comment on THIS ticket (Admin or Owner)
        if (!Auth::user()->is_admin && Auth::id() !== $ticket->user_id) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Komentar terkirim!');
    }
}
