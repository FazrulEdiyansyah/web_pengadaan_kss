<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'phone' => '08111111111',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        echo "Admin user created successfully!\n";
        echo "Phone: 08111111111\n";
        echo "Password: admin123\n";
    }
}
