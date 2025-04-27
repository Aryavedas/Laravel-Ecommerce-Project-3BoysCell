<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
    rel="stylesheet" />

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

    <!-- Page Content -->
    <main class="bg-gray-100 min-h-screen py-10">
      <div class="container relative flex mx-auto gap-5">
        <!-- Bagian Kiri: Keranjang -->
        <div class="p-10 w-[60%] bg-white rounded-lg border shadow-sm">
          <div class="flex justify-between">
            <a href="{{ route('dashboard') }}"
              class="text-sm font-bold bg-slate-800 px-4 py-3 rounded-lg text-white">← Kembali ke
              List
              Produk</a>
            <a href="{{ route('keranjang.delete') }}"
              class="bg-red-500 text-white text-sm font-bold px-4 py-3 rounded-lg">Hapus Semua
              Barang</a>
          </div>

          <div class="mt-10">
            <h1 class="text-2xl font-bold mb-6">Keranjang</h1>

            <div class="flex flex-col gap-5">
              @forelse ($keranjangs as $keranjang)
              <div class="flex w-full items-center gap-4 border rounded-md shadow-md p-5">
                <div class="w-20 h-20">
                  <img src="{{ asset('storage/' . $keranjang->barang->gambar) }}" alt="Produk"
                    class="w-full h-full object-center object-cover rounded-md">
                </div>
                <div class="flex-1">
                  <h2 class="text-lg font-semibold">{{ $keranjang->barang->nama }}</h2>
                  <p class="text-sm text-gray-500">{{ $keranjang->barang->deskripsi }}</p>
                  <p class="text-md font-bold mt-2">Rp. {{ $keranjang->barang->harga }}</p>
                </div>
              </div>
              @empty
              @endforelse
            </div>


          </div>
        </div>

        <!-- Bagian Kanan: Checkout -->
        <div class="p-10 w-[40%] h-[100%] sticky top-0 bg-white rounded-lg border shadow-sm">
          <h1 class="text-xl font-bold mb-6">Buat Pesanan</h1>

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
              class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold mt-4">
              <a href="" class="w-full h-full block">Buat Pesanan</a>
            </button>
          </div>
        </div>
      </div>
    </main>

  </div>
</body>

</html>