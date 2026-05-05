<?php

namespace Database\Factories;

use App\Models\JobPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Surveying & Mapping' => ['Surveyor Topografi', 'GIS Specialist', 'UAV Pilot', 'Cartographer', 'Geodetic Engineer'],
            'Engineering & Construction' => ['Site Engineer', 'Estimator Proyek', 'Drafter CAD', 'Project Manager', 'Quantity Surveyor'],
            'IT & Software Development' => ['Fullstack Developer', 'Backend Engineer', 'Data Analyst', 'UI/UX Designer', 'Product Manager'],
            'Creative & Photography' => ['Photographer', 'Video Editor', 'Graphic Designer', 'Content Creator', 'Drone Pilot'],
            'Agriculture & Forestry' => ['Forestry Surveyor', 'Agro Analyst', 'Remote Sensing Expert', 'Kebun Mapping Officer'],
        ];

        $industry = $this->faker->randomElement(array_keys($titles));
        $title = $this->faker->randomElement($titles[$industry]);

        return [
            'user_id' => \App\Models\User::factory(),
            'company_id' => \App\Models\Company::factory(),
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => "Kami sedang mencari {$title} yang berdedikasi dan memiliki passion di bidangnya untuk bergabung bersama tim profesional kami.",
            'requirements' => "- Pendidikan minimal D3/S1 sesuai bidang\n- Pengalaman minimal 1-2 tahun\n- Mampu bekerja di bawah tekanan dan target\n- Komunikatif dan mampu bekerja sama dalam tim",
            'location' => $this->faker->randomElement(['Bandung', 'Jakarta', 'Surabaya', 'Semarang', 'Yogyakarta', 'Balikpapan', 'Medan']),
            'job_type' => $this->faker->randomElement(['Full-time', 'Kontrak', 'Freelance', 'Magang']),
            'salary_range' => $this->faker->randomElement(['Rp 5.000.000 - Rp 8.000.000', 'Nego', 'Kompetitif', 'Rp 10.000.000+']),
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'status' => 'open',
        ];
    }
}
