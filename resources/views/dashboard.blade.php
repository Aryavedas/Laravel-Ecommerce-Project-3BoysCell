<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- @php
            dd($barangs)
        @endphp --}}

        <!-- Page Content -->
        <main>
            {{-- {{ $slot }} --}}
            <div class="container border bg-white py-7 mx-auto rounded-lg shadow-sm my-10 px-10">
                <div class="w-full flex justify-between items-center pb-7">
                    <h1 class="font-extrabold text-base lg:text-2xl">Selamat Datang Ditoko Kami</h1>
                    <a href="#" class="text-white bg-slate-800 px-4 py-3 rounded-lg font-bold text-sm">Lihat
                        Kerjang</a>
                </div>
                <div class="grid grid-cols-3 gap-5">

                    {{-- Card befor foreach --}}
                    @forelse ($barangs as $barang)
                        <div class="card bg-white border shadow-sm p-3 rounded-lg flex flex-col">
                            <div class="card-img w-full h-[300px] overflow-hidden rounded-md">
                                <img class="object-cover object-center h-full w-full"
                                    src="{{ asset('storage/' . $barang->gambar) }}" alt=""><!-- Foto Produk -->
                            </div>

                            <div class="card-body flex flex-grow flex-col p-2.5">

                                <div class="card-title my-2">
                                    <h1 class="font-extrabold text-2xl text-sky-700">{{ $barang->nama }}</h1>
                                    <!-- Nama Produk -->
                                </div>

                                <div class="card-description my-3">
                                    <p class="line-clamp-3 text-slate-700">{{ $barang->deskripsi }}</p>
                                    <!-- Deskripsi Produk -->
                                </div>

                                <div class="card-footer mt-auto flex justify-between pt-5 border-t">

                                    <div class="card-price text-sm font-bold">
                                        <p>Rp. {{ $barang->harga }}</p> <!-- Harga Produk -->
                                    </div>

                                    <div class="card-button-keranjang">
                                        <a href=""
                                            class="text-white text-sm font-bold bg-slate-800 px-4 py-3 rounded-lg">Masukkan
                                            Keranjang</a> <!-- Button Keranjang -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center font-bold text-3xl">Barang Kosong</div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>

</html>
