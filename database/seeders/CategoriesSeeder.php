<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity; // Make sure you have the Amenity model
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // House & Apartment
            ['name' => 'House', 'property_type' => 'home'],
            ['name' => 'Flat', 'property_type' => 'home'],
            ['name' => 'Upper Portion', 'property_type' => 'home'],
            ['name' => 'Lower Portion', 'property_type' => 'home'],
            ['name' => 'Form House', 'property_type' => 'home'],
            ['name' => 'Room', 'property_type' => 'home'],
            ['name' => 'Penthouse', 'property_type' => 'home'],
            

            // Plot
            ['name' => 'Resedential Plot', 'property_type' => 'plot'],
            ['name' => 'Commercial Plot', 'property_type' => 'plot'],
            ['name' => 'Agricultural Land', 'property_type' => 'plot'],
            ['name' => 'Industrial Land', 'property_type' => 'plot'],
            ['name' => 'Plot FIle', 'property_type' => 'plot'],
            ['name' => 'Plot Form', 'property_type' => 'plot'],

            // Commercial
            ['name' => 'Office', 'property_type' => 'commercial'],
            ['name' => 'Shop', 'property_type' => 'commercial'],
            ['name' => 'Warehouse', 'property_type' => 'commercial'],
            ['name' => 'Factory', 'property_type' => 'commercial'],
            ['name' => 'Bulding', 'property_type' => 'commercial'],
            ['name' => 'Other', 'property_type' => 'commercial'],
        ];

        DB::table('categories')->insert($categories);
    }
}
