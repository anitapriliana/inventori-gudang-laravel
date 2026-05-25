<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User admin_gudang
        User::updateOrCreate(
            ['username' => 'staffgudang'],
            [
                'name' => 'Staff Gudang',
                'password' => Hash::make('staff123'),
                'role' => 'admin_gudang',
            ]
        );

        // User owner
        User::updateOrCreate(
            ['username' => 'owner'],
            [
                'name' => 'Owner',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
            ]
        );

        // User kepala_gudang
        User::updateOrCreate(
            ['username' => 'kepalagudang'],
            [
                'name' => 'Kepala Gudang',
                'password' => Hash::make('kepala123'),
                'role' => 'kepala_gudang',
            ]
        );
    }
}
