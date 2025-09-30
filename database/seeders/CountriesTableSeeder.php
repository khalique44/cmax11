<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        // Use File instead of Storage for public/ files
        $json = File::get(public_path('backups/countries.json'));
        $countries = json_decode($json);

        foreach ($countries as $country) {
            // Check manually if ID exists
            $exists = DB::table('countries')->where('id', $country->id)->exists();

            if (!$exists) {
                DB::table('countries')->insert([
                    'id' => $country->id,
                    'short_name' => $country->short_name,
                    'name' => $country->name,
                    'phone_code' => $country->phone_code,
                ]);
            }
        }
    }
}
