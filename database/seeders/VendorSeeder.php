<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Vendor::create([
            'nama_vendor' => 'PT. Teknologi Maju',
            'email' => 'info@teknologimaju.com',
            'phone' => '021-12345678',
            'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'contact_person' => 'Budi Santoso',
            'status' => 'active'
        ]);

        \App\Models\Vendor::create([
            'nama_vendor' => 'CV. Solusi Digital',
            'email' => 'contact@solusidigital.com',
            'phone' => '021-87654321',
            'alamat' => 'Jl. Gatot Subroto No. 456, Jakarta Selatan',
            'contact_person' => 'Sari Dewi',
            'status' => 'active'
        ]);

        \App\Models\Vendor::create([
            'nama_vendor' => 'PT. Inovasi Kreatif',
            'email' => 'hello@inovasikreatif.com',
            'phone' => '021-11223344',
            'alamat' => 'Jl. Thamrin No. 789, Jakarta Pusat',
            'contact_person' => 'Ahmad Rahman',
            'status' => 'active'
        ]);
    }
}
