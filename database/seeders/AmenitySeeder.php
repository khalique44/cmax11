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
            // home & Apartment
            ['name' => 'Garage', 'property_type' => 'home'],
            ['name' => 'Garden', 'property_type' => 'home'],
            ['name' => 'Swimming Pool', 'property_type' => 'home'],
            ['name' => 'Terrace', 'property_type' => 'home'],
            ['name' => 'Basement', 'property_type' => 'home'],
            ['name' => 'Servant Quarters', 'property_type' => 'home'],
            ['name' => 'Security System', 'property_type' => 'home'],
            ['name' => 'Central Heating', 'property_type' => 'home'],
            ['name' => 'Air Conditioning', 'property_type' => 'home'],

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
