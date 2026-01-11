<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <div class="flex justify-between mb-5">
            <h1 class="text-2xl font-bold">Daftar Laporan Anda</h1>
            <a href="{{ route('tickets.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Laporan</a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr class="border-b">
                    <td class="p-3">{{ $ticket->title }}</td>
                    <td class="p-3">{{ $ticket->category->name }}</td>
                    <td class="p-3">
                        @if($ticket->status == 'pending')
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Pending</span>
                        @elseif($ticket->status == 'in_progress')
                            <span class="bg-yellow-500 text-black px-2 py-1 rounded text-xs">In Progress</span>
                        @else
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Resolved</span>
                        @endif
                    </td>
                    <td class="p-3">
                        <!-- Menampilkan Foto menggunakan Storage Link -->
                        <img src="{{ asset('storage/' . $ticket->image_path) }}" class="w-20 h-20 object-cover rounded">
                    </td>
                    <td class="p-3">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-500">Lihat Detail & Diskusi</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>