<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoan</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .alert { padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; }
        .alert-error { color: #a94442; background-color: #f2dede; border-color: #ebccd1; }
        button { cursor: pointer; padding: 5px 10px; }
    </style>
</head>
<body>

    <h1>Daftar Inventaris Lab</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->total_stock }}</td>
                    <td>
                        @if($item->total_stock > 0)
                            <form action="{{ route('loans.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit">Pinjam</button>
                            </form>
                        @else
                            <button disabled>Habis</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
