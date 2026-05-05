<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 15 companies with different industries
        $companies = \App\Models\Company::factory(15)->create();

        foreach ($companies as $company) {
            // Create 1-3 job posts for each company
            \App\Models\JobPost::factory(rand(1, 3))->create([
                'company_id' => $company->id,
                'user_id' => $company->user_id,
            ]);

            // Add rental inventory if the company industry supports it
            if ($company->settings['show_rental']) {
                \App\Models\RentalInventory::factory(rand(3, 8))->create([
                    'company_id' => $company->id,
                ]);
            }
        }

        // Create independent job posts
        \App\Models\JobPost::factory(5)->create([
            'company_id' => null,
        ]);
    }
}
