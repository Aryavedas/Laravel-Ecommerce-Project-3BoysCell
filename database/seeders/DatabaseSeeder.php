<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cara Aman (Cek dulu agar tidak error "Duplicate Entry" saat di-run berkali-kali)
        $user = User::where('email', 'admin@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('11111111'),
                'is_admin' => 1,
            ]);
        }
    }
}
