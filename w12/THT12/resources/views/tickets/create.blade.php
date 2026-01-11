<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-5">Buat Laporan Keluhan</h1>

        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow rounded">
            @csrf
            <div class="mb-4">
                <label>Judul Keluhan</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label>Kategori Divisi</label>
                <select name="category_id" class="w-full border-gray-300 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Lokasi (Gedung/Lantai/Ruang)</label>
                <input type="text" name="location" class="w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label>Deskripsi Detail</label>
                <textarea name="description" class="w-full border-gray-300 rounded" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label>Bukti Foto (Max 2MB, JPG/PNG)</label>
                <input type="file" name="image" class="w-full" accept="image/*" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim Laporan</button>
        </form>
    </div>
</x-app-layout>