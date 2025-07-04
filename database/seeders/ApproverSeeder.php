<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ApproverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create approver user
        User::create([
            'name' => 'Approver 1',
            'phone' => '08111111112',
            'password' => bcrypt('approver123'),
            'role' => 'approver'
        ]);

        User::create([
            'name' => 'Approver 2',
            'phone' => '08111111113',
            'password' => bcrypt('approver123'),
            'role' => 'approver'
        ]);

        echo "Approver users created successfully!\n";
    }
}
