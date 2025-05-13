<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;  // Pastikan model User sudah ada

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin dengan data yang Anda inginkan
        User::create([
            'name' => 'Admin',  // Nama admin
            'email' => 'admin@pln.com',  // Email admin
            'password' => Hash::make('pln123'),  // Password yang di-hash
        ]);
    }
}
