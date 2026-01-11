<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            $tickets = Ticket::with(['user', 'category'])->latest()->get();
        } else {
            $tickets = $user->tickets()->with(['category'])->latest()->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048', // 2MB Max
            'location' => 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tickets', 'public');
        }

        Auth::user()->tickets()->create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image_path' => $imagePath,
            'location' => $request->location,
            'status' => 'pending',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Laporan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with(['comments.user', 'category', 'user'])->findOrFail($id);

        // Simple Authorization
        if (!Auth::user()->is_admin && Auth::id() !== $ticket->user_id) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        // Authorization: Only Admin can change status
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $ticket->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}
