<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipas.test'],
            [
                'name'     => 'Pengurus KKN',
                'password' => Hash::make('pajaten2026'), // ⚠️ GANTI setelah login pertama!
                'is_admin' => true,
            ]
        );
    }
}
