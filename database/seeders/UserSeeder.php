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
        $admin = User::updateOrCreate(
            ['email' => 'admin@iaspig.org'],
            [
                'name' => 'Admin IASPIG',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_verified' => true,
            ]
        );
        if (!$admin->alumniProfile) {
            $admin->alumniProfile()->create();
        }

        // Sample Alumni 1 (Bandung)
        $alumni1 = User::updateOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Setiawan',
                'password' => Hash::make('password'),
                'role' => 'alumni',
                'is_verified' => true,
            ]
        );
        $alumni1->alumniProfile()->updateOrCreate(
            ['user_id' => $alumni1->id],
            [
                'current_job' => 'GIS Analyst',
                'company' => 'Esri Indonesia',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'skills' => ['GIS', 'Remote Sensing'],
                'bio' => 'Berpengalaman dalam pengolahan data spasial untuk mitigasi bencana.',
            ]
        );

        // Sample Alumni 2 (Jakarta)
        $alumni2 = User::updateOrCreate(
            ['email' => 'siti@example.com'],
            [
                'name' => 'Siti Aminah',
                'password' => Hash::make('password'),
                'role' => 'alumni',
                'is_verified' => true,
            ]
        );
        $alumni2->alumniProfile()->updateOrCreate(
            ['user_id' => $alumni2->id],
            [
                'current_job' => 'Surveyor',
                'company' => 'Waskita Karya',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'skills' => ['Land Survey', 'Drone Survey'],
                'bio' => 'Fokus pada pengukuran infrastruktur jalan tol.',
            ]
        );

        // Sample Alumni 3 (Yogyakarta)
        $alumni3 = User::updateOrCreate(
            ['email' => 'andi@example.com'],
            [
                'name' => 'Andi Pratama',
                'password' => Hash::make('password'),
                'role' => 'alumni',
                'is_verified' => true,
            ]
        );
        $alumni3->alumniProfile()->updateOrCreate(
            ['user_id' => $alumni3->id],
            [
                'current_job' => 'Remote Sensing Specialist',
                'company' => 'LAPAN',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'skills' => ['Remote Sensing', 'Photogrammetry'],
                'bio' => 'Peneliti penginderaan jauh untuk klasifikasi tutupan lahan.',
            ]
        );
    }
}
