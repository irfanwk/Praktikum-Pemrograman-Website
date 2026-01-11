<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Laporan') }} #{{ $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">{{ $ticket->title }}</h3>
                            <div class="mb-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $ticket->category->name }}
                                </span>
                                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($ticket->status == 'pending') bg-red-100 text-red-800 
                                    @elseif($ticket->status == 'in_progress') bg-yellow-100 text-yellow-800 
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-gray-500 mb-1">Pelapor: {{ $ticket->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-1">Lokasi: {{ $ticket->location }}</p>
                            <p class="text-sm text-gray-500 mb-4">Waktu: {{ $ticket->created_at->format('d M Y H:i') }}</p>

                            <h4 class="font-semibold mb-1">Deskripsi:</h4>
                            <p class="mb-6 whitespace-pre-wrap">{{ $ticket->description }}</p>

                            @if(Auth::user()->is_admin)
                                <div class="bg-gray-100 p-4 rounded mb-4 text-black">
                                    <h4 class="font-semibold mb-2">Update Status (Admin)</h4>
                                    <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select rounded border-gray-300">
                                            <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                        </select>
                                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-semibold mb-2">Bukti Foto:</h4>
                            @if($ticket->image_path)
                                <img src="{{ asset('storage/' . $ticket->image_path) }}" alt="Bukti Foto" class="max-w-full rounded shadow">
                            @else
                                <p class="text-gray-500 italic">Tidak ada foto.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Diskusi & Komentar</h3>

                    <div class="space-y-4 mb-6">
                        @forelse($ticket->comments as $comment)
                            <div class="border-b pb-4 {{ $comment->user->is_admin ? 'bg-blue-50 p-2 rounded' : '' }}">
                                <div class="flex justify-between items-start mb-1">
                                    <span class="font-semibold {{ $comment->user->is_admin ? 'text-blue-700' : '' }}">
                                        {{ $comment->user->name }} {{ $comment->user->is_admin ? '(Admin)' : '' }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">{{ $comment->message }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">Belum ada komentar.</p>
                        @endforelse
                    </div>

                    <form action="{{ route('comments.store', $ticket) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tulis Komentar</label>
                            <textarea name="message" id="message" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black" required></textarea>
                        </div>
                        <button type="submit" class="bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 font-semibold py-2 px-4 rounded hover:opacity-75">
                            Kirim Komentar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
