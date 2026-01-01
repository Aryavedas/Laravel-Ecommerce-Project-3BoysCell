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

        {{-- @php
            dd($barangs)
        @endphp --}}

        <main>
            {{-- {{ $slot }} --}}
            <div class="container border bg-white py-7 mx-auto rounded-lg shadow-sm my-6 lg:my-10 px-3 md:px-6 lg:px-10">
                
                <div class="w-full flex flex-col md:flex-row justify-between items-center pb-7 gap-4 md:gap-0">
                    <h1 class="font-extrabold text-lg md:text-xl lg:text-2xl text-center md:text-left">Selamat Datang Ditoko Kami</h1>

                    <div class="flex gap-2 lg:gap-4 w-full md:w-auto justify-center md:justify-end">
                        <a href="{{ route('keranjang') }}"
                            class="text-white bg-slate-800 px-4 py-3 rounded-lg font-bold text-xs md:text-sm text-center flex-1 md:flex-none">
                            Lihat Keranjang
                        </a>
                        <a href="{{ route('transaction') }}"
                            class="text-white bg-sky-700 px-4 py-3 rounded-lg font-bold text-xs md:text-sm text-center flex-1 md:flex-none">
                            Lihat Transaksi
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-5">

                    {{-- Card befor foreach --}}
                    @forelse ($barangs as $barang)
                        <div class="card bg-white border shadow-sm p-2 md:p-3 rounded-lg flex flex-col h-full">
                            
                            <div class="card-img w-full h-[150px] md:h-[220px] lg:h-[300px] overflow-hidden rounded-md">
                                <img class="object-cover object-center h-full w-full hover:scale-105 transition-transform duration-300"
                                    src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama }}"></div>

                            <div class="card-body flex flex-grow flex-col p-1.5 md:p-2.5">

                                <div class="card-title my-2">
                                    <h1 class="font-extrabold text-sm md:text-xl lg:text-2xl text-sky-700 leading-tight">{{ $barang->nama }}</h1>
                                    </div>

                                <div class="card-description my-1 md:my-3">
                                    <p class="line-clamp-2 md:line-clamp-3 text-slate-700 text-xs md:text-base">{{ $barang->deskripsi }}</p>
                                    </div>

                                <div class="card-footer mt-auto flex flex-col pt-3 md:pt-5 border-t gap-2">

                                    <div class="card-price text-xs md:text-sm font-bold w-full text-left">
                                        <p>Rp. {{ $barang->harga }}</p> </div>

                                    <div class="card-button-keranjang w-full">
                                        <a href="{{ route('keranjang.store', $barang->id) }}"
                                            class="text-white text-[10px] md:text-sm font-bold bg-slate-800 px-2 py-2 md:px-4 md:py-3 rounded-lg block text-center w-full hover:bg-slate-700 transition">
                                            Masukkan Keranjang
                                        </a> </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 md:col-span-3 lg:col-span-4 text-center py-10">
                            <div class="text-center font-bold text-xl md:text-3xl text-gray-400">Barang Kosong</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>

</html>