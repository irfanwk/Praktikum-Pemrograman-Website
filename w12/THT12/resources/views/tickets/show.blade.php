<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">{{ $ticket->title }}</h1>
                <!-- Tampilan Badge Status -->
                <span class="px-3 py-1 rounded text-white {{ $ticket->status == 'pending' ? 'bg-red-500' : ($ticket->status == 'in_progress' ? 'bg-yellow-500 text-black' : 'bg-green-500') }}">
                    {{ strtoupper($ticket->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="{{ asset('storage/' . $ticket->image_path) }}" class="w-full rounded-lg shadow">
                </div>
                <div>
                    <p class="text-gray-600 mb-2"><strong>Pelapor:</strong> {{ $ticket->user->name }}</p>
                    <p class="text-gray-600 mb-2"><strong>Lokasi:</strong> {{ $ticket->location }}</p>
                    <p class="text-gray-600 mb-2"><strong>Kategori:</strong> {{ $ticket->category->name }}</p>
                    <p class="mt-4 text-gray-800 italic">"{{ $ticket->description }}"</p>
                </div>
            </div>

            <!-- FITUR UPDATE STATUS (HANYA UNTUK ADMIN) -->
            @if(auth()->user()->is_admin)
            <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded">
                <h3 class="font-bold mb-2">Admin Action: Ubah Status</h3>
                <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="border-gray-300 rounded">
                        <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Update Status</button>
                </form>
            </div>
            @endif
        </div>

        <!-- SEKSI DISKUSI / KOMENTAR -->
        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Diskusi / Tanggapan</h2>
            
            <div class="space-y-4 mb-6">
                @foreach($ticket->comments as $comment)
                <div class="p-4 rounded-lg {{ $comment->user->is_admin ? 'bg-blue-100 ml-10' : 'bg-gray-100 mr-10' }}">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-sm">{{ $comment->user->name }} {{ $comment->user->is_admin ? '(Admin)' : '' }}</span>
                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700">{{ $comment->message }}</p>
                </div>
                @endforeach
            </div>

            <!-- Form Balas Komentar -->
            <form action="{{ route('comments.store', $ticket->id) }}" method="POST" class="bg-white p-4 shadow rounded">
                @csrf
                <textarea name="message" rows="3" class="w-full border-gray-300 rounded mb-2" placeholder="Tulis tanggapan..."></textarea>
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Kirim Balasan</button>
            </form>
        </div>
    </div>
</x-app-layout>