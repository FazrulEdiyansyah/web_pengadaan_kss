<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class TestVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test vendors
        Vendor::create([
            'nama_vendor' => 'PT Supplier Utama',
            'email' => 'supplier.utama@mail.com',
            'phone' => '081234567890',
            'alamat' => 'Jl. Supplier No. 1, Jakarta',
            'contact_person' => 'John Doe',
            'status' => 'active'
        ]);

        Vendor::create([
            'nama_vendor' => 'CV Mitra Sejati',
            'email' => 'mitra.sejati@mail.com',
            'phone' => '081234567891',
            'alamat' => 'Jl. Mitra No. 2, Jakarta',
            'contact_person' => 'Jane Smith',
            'status' => 'active'
        ]);

        echo "Test vendors created successfully!\n";
    }
}
