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
        ]);

        // Initial Stats
        Stat::create(['label' => 'Total Alumni', 'value' => '1,500+', 'sort_order' => 1]);
        Stat::create(['label' => 'Angkatan', 'value' => '25+', 'sort_order' => 2]);
        Stat::create(['label' => 'Perusahaan', 'value' => '300+', 'sort_order' => 3]);
        Stat::create(['label' => 'Provinsi', 'value' => '34', 'sort_order' => 4]);

        // Initial Projects
        Project::create([
            'title' => 'Smart City Dashboard',
            'category' => 'GIS & Analysis',
            'description' => 'Integrasi data spasial untuk monitoring infrastruktur perkotaan secara real-time.',
            'image_path' => 'assets/img/portfolio_1.png',
            'sort_order' => 1
        ]);

        Project::create([
            'title' => 'High-Res Orthophoto',
            'category' => 'Photogrammetry',
            'description' => 'Pemetaan koridor pesisir menggunakan teknologi UAV untuk mitigasi bencana.',
            'image_path' => 'assets/img/portfolio_2.png',
            'sort_order' => 2
        ]);

        Project::create([
            'title' => 'Topographic Mapping',
            'category' => 'Terrestrial Survey',
            'description' => 'Pengukuran presisi tinggi untuk perencanaan area tambang dan infrastruktur pendukung.',
            'image_path' => 'assets/img/portfolio_3.png',
            'sort_order' => 3
        ]);
    }
}
