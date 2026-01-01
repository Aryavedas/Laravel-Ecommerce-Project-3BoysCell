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
        <main class="bg-gray-100 min-h-screen py-10">
            <div class="container mx-auto px-4 w-full md:w-[70%] lg:w-[40%] mt-20 lg:mt-56">
                
                <div class="bg-white w-full rounded-xl shadow-sm border border-gray-200 p-6 md:p-10">
                    <h1 class="text-center text-xl md:text-2xl font-semibold text-gray-800">Data Berhasil Tersimpan</h1>

                    <div class="text-center mt-8 md:mt-10">
                        <a href="{{ route('dashboard') }}"
                            class="block w-full sm:inline-block sm:w-auto bg-slate-800 text-white text-sm font-medium px-5 py-3 rounded-lg hover:bg-slate-700 transition text-center">
                            ← Kembali ke List Produk
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>