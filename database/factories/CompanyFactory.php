<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = [
            'Surveying & Mapping' => ['PT. Geospasial Utama', 'CV. Pemetaan Presisi', 'Survei Nusantara Geodetik', 'Mitra Survey Indonesia'],
            'Engineering & Construction' => ['PT. Bangun Negeri Spasial', 'Konstruksi Mandiri Jaya', 'Rancang Bangun Teritorial', 'Pilar Utama Engineering'],
            'IT & Software Development' => ['Solusi Digital Geodetik', 'Peta Pintar Indonesia', 'GeoTech Solutions Asia', 'Aplikasi Spasial Mandiri'],
            'Creative & Photography' => ['Lensa Spasial', 'Fotografi Udara Kreatif', 'Visual Mapping Co.', 'Drone Kreatif Nusantara'],
            'Agriculture & Forestry' => ['Agro GIS Indonesia', 'Hutan Lestari Maps', 'Pemetaan Kebun Makmur', 'Sawit Digital Survey'],
        ];

        $industry = $this->faker->randomElement(array_keys($industries));
        $name = $this->faker->randomElement($industries[$industry]);
        
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $name . ' ' . $this->faker->unique()->numberBetween(1, 100),
            'slug' => \Illuminate\Support\Str::slug($name) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => "Perusahaan yang bergerak di bidang {$industry} dengan komitmen memberikan hasil terbaik bagi klien.",
            'address' => "Jl. Raya " . $this->faker->streetName() . " No. " . $this->faker->buildingNumber() . ", Bandung, Jawa Barat",
            'latitude' => $this->faker->latitude(-7.0, -6.8), // Fokus Bandung area
            'longitude' => $this->faker->longitude(107.5, 107.7),
            'whatsapp_number' => '62812' . $this->faker->numerify('########'),
            'website' => 'https://' . \Illuminate\Support\Str::slug($name) . '.co.id',
            'industry_type' => $industry,
            'settings' => [
                'show_rental' => ($industry === 'Surveying & Mapping' || $industry === 'Engineering & Construction'),
                'show_portfolio' => true,
            ],
            'status' => 'approved',
            'is_verified' => true,
        ];
    }
}
