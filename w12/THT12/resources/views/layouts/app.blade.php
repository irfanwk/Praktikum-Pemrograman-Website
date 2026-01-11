<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Pak! - Campus Complaint System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold">🚨 Lapor Pak!</h1>
                    @auth
                    <a href="{{ route('tickets.index') }}" class="hover:text-blue-200">Daftar Laporan</a>
                    <a href="{{ route('tickets.create') }}" class="hover:text-blue-200">Buat Laporan</a>
                    @endauth
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm">
                            {{ auth()->user()->name }} 
                            @if(auth()->user()->is_admin)
                                <span class="bg-yellow-400 text-black px-2 py-1 rounded text-xs">Admin</span>
                            @endif
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-200">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-blue-200">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 py-2">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 py-2">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>&copy; 2026 Lapor Pak! - Campus Complaint System</p>
    </footer>
</body>
</html>
