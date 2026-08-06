<?php

namespace Database\Seeders;

use App\Models\karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        karyawan::updateOrCreate(
            [
                'nama' => 'Asministrator',
                'ruangan' => 'admin', // Admin tidak punya karyawan_id
                'nip' => '000',
                'jabatan' => 'null',
                'bidang_id' => NULL,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@rsmz.com'],
            [
                'name' => 'Admin RSMZ',
                'karyawan_id' => 1, // Admin tidak punya karyawan_id
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => 1,
            ]
        );
    }
}