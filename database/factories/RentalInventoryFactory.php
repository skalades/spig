<?php

namespace Database\Factories;

use App\Models\RentalInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RentalInventory>
 */
class RentalInventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = [
            'Total Station' => ['Topcon OS-101', 'Leica TS07', 'Sokkia iM-52', 'Nikon Nivo 2.M'],
            'GNSS Receiver' => ['Trimble R12 RTK', 'CHCNAV i73 GNSS', 'South G1 Galaxy', 'Hi-Target V30'],
            'Drone' => ['DJI Phantom 4 RTK', 'DJI Mavic 3 Enterprise', 'WingtraOne VTOL', 'eBee X'],
            'Theodolite' => ['Nikon NE-100', 'Topcon DT-200', 'Sokkia DT-610'],
            'Level/Waterpass' => ['Sokkia B40', 'Topcon AT-B4', 'Leica NA320'],
        ];

        $category = $this->faker->randomElement(array_keys($items));
        $itemName = $this->faker->randomElement($items[$category]);

        return [
            'company_id' => \App\Models\Company::factory(),
            'item_name' => $itemName,
            'category' => $category,
            'description' => "Alat {$category} dalam kondisi prima, sudah terkalibrasi, dan siap digunakan untuk pekerjaan survey presisi di lapangan.",
            'daily_rate' => $this->faker->randomElement([150000, 250000, 500000, 750000, 1500000, 2500000]),
            'status' => 'available',
        ];
    }
}
