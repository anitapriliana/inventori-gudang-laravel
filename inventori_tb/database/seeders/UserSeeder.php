<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 akun user (staff gudang)
        User::create([
            'name' => 'Staff Gudang',
            'username' => 'staffgudang',
            'email' => 'staff@gudang.com',
            'password' => Hash::make('staff123'),
        ]);
    }
}
