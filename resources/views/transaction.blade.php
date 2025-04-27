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
      <div class="container flex flex-col bg-white rounded-md shadow-sm mx-auto w-full p-10">
        <div class="flex justify-between px-5">
          <h1 class="text-2xl font-medium">Daftar Transaksi</h1>
          <button class="block">
            <a class="text-white font-bold px-4 py-3 bg-sky-950 rounded-md block text-sm"
              href="{{ route('dashboard') }}">Kembali ke List Produk</a>
          </button>
        </div>

        <div class="px-5 grid gap-5 grid-cols-4 mt-10">
          @foreach ($transactions as $transaction)
          <div class="border rounded-xl p-4 shadow-md space-y-2">
            <h2 class="text-lg font-semibold text-gray-800">{{ $transaction->order_id }}</h2>
            <p class="text-sm text-gray-600">{{ $transaction->created_at }}</p>
            <p class="text-sm text-gray-600">{{ $transaction->barang_ids }}</p>
            <p class="text-sm text-gray-600">Total: <span
                class="font-semibold text-blue-600">{{ number_format($transaction->total_harga, 2) }}</span>
            </p>
            <p class="text-sm pb-6 font-medium">Status: {{ $transaction->status }}</p>

            <form action="{{ route('token.generate') }}" method="POST">
              @csrf
              <button type="submit"
                class="bg-blue-600 w-full text-white px-4 py-2 font-bold rounded-md hover:bg-blue-700 transition">
                <input type="text" value="{{ $transaction->id }}" name="transaction_id" hidden>
                Bayar Sekarang
              </button>
            </form>
          </div>
          @endforeach


        </div>
      </div>
    </main>

  </div>
</body>

</html>