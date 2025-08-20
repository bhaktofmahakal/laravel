<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            'Computers',
            'Smartphones',
            'Lithium-ion Batteries',
            'AA Batteries',
            'Paper',
            'Plastic',
            'Glass',
            'Metal',
            'Electronics',
            'Cardboard'
        ];

        foreach ($materials as $material) {
            \App\Models\Material::create(['name' => $material]);
        }
    }
}
