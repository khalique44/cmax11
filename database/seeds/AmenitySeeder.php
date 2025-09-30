<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity; // Make sure you have the Amenity model
use Illuminate\Support\Facades\DB;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            // House & Apartment
            ['name' => 'Garage', 'property_type' => 'house'],
            ['name' => 'Garden', 'property_type' => 'house'],
            ['name' => 'Swimming Pool', 'property_type' => 'house'],
            ['name' => 'Terrace', 'property_type' => 'house'],
            ['name' => 'Basement', 'property_type' => 'house'],
            ['name' => 'Servant Quarters', 'property_type' => 'house'],
            ['name' => 'Security System', 'property_type' => 'house'],
            ['name' => 'Central Heating', 'property_type' => 'house'],
            ['name' => 'Air Conditioning', 'property_type' => 'house'],

            // Plot
            ['name' => 'Corner Plot', 'property_type' => 'plot'],
            ['name' => 'Park Facing', 'property_type' => 'plot'],
            ['name' => 'Main Boulevard', 'property_type' => 'plot'],
            ['name' => 'Sewerage', 'property_type' => 'plot'],
            ['name' => 'Electricity', 'property_type' => 'plot'],
            ['name' => 'Boundary Wall', 'property_type' => 'plot'],
        ];

        DB::table('amenities')->insert($amenities);
    }
}
