<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin/penyetuju users
        \App\Models\User::create([
            'name' => 'Manager Pengadaan',
            'phone' => '081234567890',
            'password' => bcrypt('password123')
        ]);

        \App\Models\User::create([
            'name' => 'Direktur Operasional',
            'phone' => '081234567891',
            'password' => bcrypt('password123')
        ]);

        \App\Models\User::create([
            'name' => 'Kepala Divisi Procurement',
            'phone' => '081234567892',
            'password' => bcrypt('password123')
        ]);

        // Create regular user for testing
        \App\Models\User::create([
            'name' => 'Staff Pengadaan',
            'phone' => '081234567893',
            'password' => bcrypt('password123')
        ]);
    }
}
