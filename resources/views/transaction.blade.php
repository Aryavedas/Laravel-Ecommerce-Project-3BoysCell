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
            <div class="container mx-auto px-4 lg:px-10">
                <div class="bg-white rounded-xl shadow-sm w-full p-5 lg:p-10 border border-gray-100">
                    
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0 pb-6 border-b border-gray-100">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800">Daftar Transaksi</h1>
                        
                        <div class="w-full md:w-auto">
                            <a class="text-white font-bold px-5 py-3 bg-sky-950 rounded-lg text-sm block w-full md:w-auto text-center hover:bg-sky-900 transition"
                                href="{{ route('dashboard') }}">
                                ← Kembali ke List Produk
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6 mt-6 lg:mt-8">
                        @forelse ($transactions as $transaction)
                            <div class="border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition duration-300 flex flex-col h-full bg-white">
                                
                                <div class="mb-4 space-y-3 flex-grow">
                                    <div>
                                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Order ID</span>
                                        <h2 class="text-md md:text-lg font-bold text-gray-800 break-all leading-tight">
                                            {{ $transaction->order_id }}
                                        </h2>
                                    </div>

                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="text-xs text-gray-500 block">Tanggal</span>
                                            <p class="text-xs md:text-sm text-gray-700 font-medium">
                                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="text-xs text-gray-500 block">Items ID</span>
                                        <p class="text-xs md:text-sm text-gray-600 truncate bg-gray-50 p-1 rounded">
                                            {{ $transaction->barang_ids }}
                                        </p>
                                    </div>

                                    <div class="pt-2">
                                        <span class="text-xs text-gray-500 block">Total Tagihan</span>
                                        <p class="text-lg md:text-xl font-bold text-sky-700">
                                            Rp. {{ number_format($transaction->total_harga, 2) }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-gray-500">Status:</span>
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-slate-100 text-slate-700 border border-slate-200 uppercase">
                                            {{ $transaction->status }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 border-t border-dashed border-gray-200">
                                    <form action="{{ route('token.generate') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $transaction->id }}" name="transaction_id">
                                        
                                        <button type="submit"
                                            class="w-full bg-blue-600 text-white px-4 py-2.5 rounded-lg font-bold text-sm hover:bg-blue-700 active:bg-blue-800 transition shadow-sm flex justify-center items-center gap-2">
                                            <span>Bayar Sekarang</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-10">
                                <div class="text-gray-400 font-bold text-xl">Belum ada transaksi</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>