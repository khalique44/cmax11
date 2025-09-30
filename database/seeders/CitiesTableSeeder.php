<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
         ini_set('memory_limit', '-1');
        set_time_limit(300);
        // Use File instead of Storage for public/ files
       

        $path = public_path('backups/cities.json');

        $handle = fopen($path, "r");
        $contents = fread($handle, filesize($path));
        fclose($handle);

        $cities = json_decode($contents);

        foreach ($cities as $city) {
            // Check manually if ID exists
            $exists = DB::table('cities')->where('id', $city->id)->exists();

            if (!$exists) {
                DB::table('cities')->insert([
                    'id' => $city->id,
                    'state_id' => $city->state_id,
                    'name' => $city->name,
                    
                ]);
            }
        }
    }
}
