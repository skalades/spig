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
        $admin = \App\Models\User::create([
            'name' => 'Admin IASPIG',
            'email' => 'admin@iaspig.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'is_verified' => true,
        ]);
        $admin->alumniProfile()->create();

        $alumni = \App\Models\User::create([
            'name' => 'Alumni IASPIG',
            'email' => 'alumni@iaspig.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'alumni',
            'is_verified' => false,
        ]);
        $alumni->alumniProfile()->create();
    }
}
