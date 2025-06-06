<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test jobseeker
        \App\Models\User::create([
            'first_name' => 'Test',
            'last_name' => 'Jobseeker',
            'email' => 'jobseeker@test.com',
            'password' => \Hash::make('password'),
            'user_type' => 'jobseeker',
            'status' => 'active',
            'phone' => '090-1234-5678',
            'email_verified_at' => now(),
        ]);

        // Create a test company
        \App\Models\User::create([
            'first_name' => 'Test',
            'last_name' => 'Company',
            'email' => 'company@test.com',
            'password' => \Hash::make('password'),
            'user_type' => 'company',
            'status' => 'active',
            'phone' => '03-1234-5678',
            'email_verified_at' => now(),
        ]);
    }
}
