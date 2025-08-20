<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'business_name' => 'Green Earth Recyclers',
                'last_update_date' => '2023-11-04',
                'street_address' => '123 5th Ave',
                'city' => 'New York, NY 10001',
                'materials' => [1, 2, 3, 4] // Computers, Smartphones, Lithium-ion Batteries, AA Batteries
            ],
            [
                'business_name' => 'EcoTech Solutions',
                'last_update_date' => '2023-10-15',
                'street_address' => '456 Oak Street',
                'city' => 'Los Angeles, CA 90210',
                'materials' => [1, 9, 5] // Computers, Electronics, Paper
            ],
            [
                'business_name' => 'Sustainable Waste Management',
                'last_update_date' => '2023-12-01',
                'street_address' => '789 Pine Road',
                'city' => 'Chicago, IL 60601',
                'materials' => [5, 6, 7, 10] // Paper, Plastic, Glass, Cardboard
            ],
            [
                'business_name' => 'Metro Recycling Center',
                'last_update_date' => '2023-11-20',
                'street_address' => '321 Elm Avenue',
                'city' => 'Houston, TX 77001',
                'materials' => [8, 6, 7] // Metal, Plastic, Glass
            ],
            [
                'business_name' => 'Digital Waste Processors',
                'last_update_date' => '2023-09-30',
                'street_address' => '654 Maple Drive',
                'city' => 'Phoenix, AZ 85001',
                'materials' => [1, 2, 9] // Computers, Smartphones, Electronics
            ]
        ];

        foreach ($facilities as $facilityData) {
            $materials = $facilityData['materials'];
            unset($facilityData['materials']);
            
            $facility = \App\Models\Facility::create($facilityData);
            $facility->materials()->attach($materials);
        }
    }
}
