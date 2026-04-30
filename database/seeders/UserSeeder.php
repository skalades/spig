<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin IASPIG',
            'email' => 'admin@iaspig.org',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_verified' => true,
        ]);
        $admin->alumniProfile()->create();

        // Sample Alumni 1 (Bandung)
        $alumni1 = User::create([
            'name' => 'Budi Setiawan',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
            'is_verified' => true,
        ]);
        $alumni1->alumniProfile()->create([
            'current_job' => 'GIS Analyst',
            'company' => 'Esri Indonesia',
            'latitude' => -6.9175,
            'longitude' => 107.6191,
            'skills' => ['GIS', 'Remote Sensing'],
            'bio' => 'Berpengalaman dalam pengolahan data spasial untuk mitigasi bencana.',
        ]);

        // Sample Alumni 2 (Jakarta)
        $alumni2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
            'is_verified' => true,
        ]);
        $alumni2->alumniProfile()->create([
            'current_job' => 'Surveyor',
            'company' => 'Waskita Karya',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'skills' => ['Land Survey', 'Drone Survey'],
            'bio' => 'Fokus pada pengukuran infrastruktur jalan tol.',
        ]);

        // Sample Alumni 3 (Yogyakarta)
        $alumni3 = User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@example.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
            'is_verified' => true,
        ]);
        $alumni3->alumniProfile()->create([
            'current_job' => 'Remote Sensing Specialist',
            'company' => 'LAPAN',
            'latitude' => -7.7956,
            'longitude' => 110.3695,
            'skills' => ['Remote Sensing', 'Photogrammetry'],
            'bio' => 'Peneliti penginderaan jauh untuk klasifikasi tutupan lahan.',
        ]);
    }
}
