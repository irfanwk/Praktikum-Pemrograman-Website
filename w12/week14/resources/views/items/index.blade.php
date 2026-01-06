<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h3 class="font-bold text-lg mb-4">Katalog Barang Lab</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            @foreach($items as $item)
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="font-bold text-xl">{{ $item->name }}</h4>
                    <p class="text-gray-600 mb-4">Sisa Stok: {{ $item->stock }}</p>
                    
                    @if($item->stock > 0)
                        <form action="{{ route('loans.store', $item) }}" method="POST">
                            @csrf
                            <x-primary-button>Pinjam Barang</x-primary-button>
                        </form>
                    @else
                        <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded cursor-not-allowed">
                            Habis
                        </button>
                    @endif
                </div>
            @endforeach
        </div>

        <h3 class="font-bold text-lg mb-4">Barang yang Saya Pinjam</h3>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium bg-gray-100">
                    <tr>
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Tgl Pinjam</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $loan->item->name }}</td>
                            <td class="px-6 py-4">{{ $loan->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs {{ $loan->status == 'borrowed' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($loan->status == 'borrowed')
                                    <form action="{{ route('loans.update', $loan) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="text-blue-600 hover:underline">Kembalikan</button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>