<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumni = User::where('role', 'alumni')->get();

        if ($alumni->isEmpty()) return;

        $posts = [
            [
                'content' => "Alhamdulillah, baru saja menyelesaikan proyek pemetaan batas desa menggunakan Drone Lidar di area Kalimantan. Akurasinya luar biasa!",
                'type' => 'photo',
            ],
            [
                'content' => "Halo rekan-rekan alumni SPIG, di kantor kami (PT. Geospasial Indonesia) sedang membuka lowongan untuk posisi Senior GIS Analyst. Yang berminat silakan cek link berikut ya.",
                'type' => 'job',
                'metadata' => [
                    'url' => 'https://example.com/job/gis-analyst',
                    'title' => 'Senior GIS Analyst',
                ],
            ],
            [
                'content' => "Reuni angkatan 2015 minggu depan jadi ya? Titik kumpul di kampus jam 10 pagi.",
                'type' => 'status',
            ],
            [
                'content' => "Ada yang punya referensi standar terbaru untuk pemetaan skala 1:5000? Sedang butuh untuk asistensi proyek.",
                'type' => 'status',
            ],
        ];

        foreach ($posts as $index => $postData) {
            Post::create([
                'user_id' => $alumni->random()->id,
                'content' => $postData['content'],
                'type' => $postData['type'],
                'metadata' => $postData['metadata'] ?? [],
            ]);
        }
    }
}
