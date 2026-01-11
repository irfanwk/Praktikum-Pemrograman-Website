<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    // 1. Tampilkan daftar tiket
    public function index()
    {
        // Jika Admin, lihat semua. Jika Mahasiswa, lihat miliknya saja.

        if (auth()->user()->is_admin) {
            $tickets = Ticket::with('category', 'user')->latest()->get();
        } else {
            $tickets = Ticket::where('user_id', auth()->id())->with('category')->latest()->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    // 2. Tampilkan form buat laporan
    public function create()
    {
        $categories = Category::all(); // Ambil kategori untuk isi dropdown select
        return view('tickets.create', compact('categories'));
    }

    // 3. Simpan laporan ke Database
    public function store(Request $request)
    {
        // VALIDASI sesuai tugas: max 2MB, format jpg/png
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048', 
        ]);

        // HANDLE UPLOAD FOTO
        // Foto akan disimpan di folder: storage/app/public/tickets
        $imagePath = $request->file('image')->store('tickets', 'public');

        // SIMPAN KE DATABASE
        Ticket::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $imagePath,
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('tickets.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Ticket $ticket)
    {
        // Eager Load comments dan user-nya agar tidak berat
        $ticket->load('comments.user', 'category', 'user');
        
        // Pastikan user biasa tidak bisa mengintip tiket orang lain
        if (!auth()->user()->is_admin && $ticket->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    // 5. Update Status (Khusus Admin)
    public function updateStatus(Request $request, Ticket $ticket)
    {
        // Validasi: hanya admin yang boleh
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $ticket->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status tiket berhasil diperbarui!');
    }
}