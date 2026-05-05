<?php

namespace Database\Seeders;

use App\Models\Stat;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            BusinessSeeder::class,
            EventSeeder::class,
        ]);

        // Initial Stats
        Stat::truncate();
        Stat::create(['label' => 'Total Alumni', 'value' => '1.842', 'sort_order' => 1]);
        Stat::create(['label' => 'Angkatan', 'value' => '27', 'sort_order' => 2]);
        Stat::create(['label' => 'Perusahaan', 'value' => '312', 'sort_order' => 3]);
        Stat::create(['label' => 'Provinsi', 'value' => '38', 'sort_order' => 4]);

        // Initial Projects
        Project::truncate();
        Project::create([
            'title' => 'IKN Geospatial Base',
            'category' => 'National Project',
            'description' => 'Penyediaan kerangka spasial dasar untuk pembangunan Ibu Kota Nusantara yang berkelanjutan.',
            'image_path' => 'assets/img/portfolio_1.png',
            'sort_order' => 1
        ]);

        Project::create([
            'title' => 'Bathy-Marine Expansion',
            'category' => 'Hydrography',
            'description' => 'Survei batimetri presisi tinggi untuk optimalisasi alur pelayaran pelabuhan internasional.',
            'image_path' => 'assets/img/portfolio_2.png',
            'sort_order' => 2
        ]);

        Project::create([
            'title' => 'Mine-Scan 3D Pro',
            'category' => 'Terrestrial Survey',
            'description' => 'Monitoring volume tambang secara periodik menggunakan teknologi Laser Scanning 3D.',
            'image_path' => 'assets/img/portfolio_3.png',
            'sort_order' => 3
        ]);

        Project::create([
            'title' => 'Precision Agri-Mapping',
            'category' => 'Remote Sensing',
            'description' => 'Analisis kesehatan tanaman perkebunan sawit menggunakan citra multispektral UAV.',
            'image_path' => 'assets/img/portfolio_1.png',
            'sort_order' => 4
        ]);

        Project::create([
            'title' => 'Smart Village GIS',
            'category' => 'Community Service',
            'description' => 'Digitalisasi administrasi desa berbasis peta untuk percepatan pelayanan publik.',
            'image_path' => 'assets/img/portfolio_2.png',
            'sort_order' => 5
        ]);
    }
}
