<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="bg-gray-100 min-h-screen py-6 lg:py-10">
            <div class="container relative flex flex-col lg:flex-row mx-auto gap-5 px-4 lg:px-10">
                
                <div class="p-5 lg:p-10 w-full lg:w-[60%] bg-white rounded-lg border shadow-sm">
                    
                    <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-0">
                        <a href="{{ route('dashboard') }}"
                            class="text-sm font-bold bg-slate-800 px-4 py-3 rounded-lg text-white text-center sm:text-left">
                            ← List Produk
                        </a>
                        <a href="{{ route('keranjang.delete') }}"
                            class="bg-red-500 text-white text-sm font-bold px-4 py-3 rounded-lg text-center sm:text-left">
                            Hapus Semua Barang Keranjang
                        </a>
                    </div>

                    <div class="mt-8 lg:mt-10">
                        <h1 class="text-xl lg:text-2xl font-bold mb-6">Keranjang</h1>

                        <div class="flex flex-col gap-4 lg:gap-5">
                            @forelse ($keranjangs as $keranjang)
                                <div class="flex w-full items-start sm:items-center gap-3 sm:gap-4 border rounded-md shadow-md p-3 sm:p-5">
                                    
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $keranjang->barang->gambar) }}" alt="Produk"
                                            class="w-full h-full object-center object-cover rounded-md">
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h2 class="text-base sm:text-lg font-semibold leading-tight">{{ $keranjang->barang->nama }}</h2>
                                        
                                        <p class="text-xs sm:text-sm text-gray-500 line-clamp-2 sm:line-clamp-none mt-1">
                                            {{ $keranjang->barang->deskripsi }}
                                        </p>
                                        
                                        <p class="text-sm sm:text-md font-bold mt-2 text-sky-700">Rp. {{ $keranjang->barang->harga }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 text-gray-400 font-bold">Keranjang Kosong</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="p-5 lg:p-10 w-full lg:w-[40%] h-fit lg:sticky lg:top-10 bg-white rounded-lg border shadow-sm">
                    <h1 class="text-lg lg:text-xl font-bold mb-4 lg:mb-6">Buat Pesanan</h1>

                    <div class="space-y-4">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp. {{ number_format($total_harga, 2) }}</span>
                        </div>

                        <hr class="my-2">

                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span>Rp. {{ number_format($total_harga, 2) }}</span>
                        </div>

                        <button
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold mt-4 shadow-md">
                            <a href="{{ route('order.create') }}" class="w-full h-full block">Buat Pesanan</a>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>