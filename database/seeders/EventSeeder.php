<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Event::create([
            'title' => 'Webinar: Masa Depan Geospasial 4.0',
            'description' => 'Diskusi panel mengenai implementasi AI dan Big Data dalam industri pemetaan di Indonesia.',
            'event_date' => now()->addDays(7)->setTime(14, 0),
            'location' => 'Zoom Meeting',
            'type' => 'webinar',
            'registration_link' => 'https://zoom.us/j/example',
        ]);

        \App\Models\Event::create([
            'title' => 'Workshop: Pemrosesan Data Lidar',
            'description' => 'Pelatihan intensif pemrosesan data Lidar untuk pemetaan topografi skala besar.',
            'event_date' => now()->addDays(14)->setTime(9, 0),
            'location' => 'Kampus UPI Bandung',
            'type' => 'workshop',
            'registration_link' => '#',
        ]);

        \App\Models\Event::create([
            'title' => 'Reuni Akbar IASPIG 2026',
            'description' => 'Malam keakraban dan temu kangen seluruh angkatan alumni SPIG UPI.',
            'event_date' => now()->addDays(30)->setTime(18, 0),
            'location' => 'Hotel Savoy Homann, Bandung',
            'type' => 'reuni',
            'registration_link' => '#',
        ]);
    }
}
