<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">📚 Katalog Buku</h1>

            <div>
                @auth
                    <span class="mr-3">Halo, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="bg-blue-500 text-white px-3 py-1 rounded">
                        Login
                    </a>
                @endauth
            </div>
        </div>

        <!-- List Buku -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @forelse($books as $book)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-xl font-semibold mb-2">
                        {{ $book->judul }}
                    </h3>

                    <p class="text-gray-600 mb-1">
                        Penulis: {{ $book->penulis }}
                    </p>

                    <p class="text-gray-600 mb-3">
                        Stok: {{ $book->stok }}
                    </p>

                    @auth
                        <form action="/pinjam/{{ $book->id }}" method="POST">
                            @csrf
                            <button 
                                class="bg-green-500 text-white px-3 py-1 rounded w-full">
                                Pinjam Buku
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="block text-center bg-gray-400 text-white px-3 py-1 rounded">
                            Login untuk Pinjam
                        </a>
                    @endauth
                </div>
            @empty
                <p>Tidak ada buku tersedia.</p>
            @endforelse

        </div>

    </div>

</body>
</html>