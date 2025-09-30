<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        // Use File instead of Storage for public/ files
        $json = File::get(public_path('backups/states.json'));
        $states = json_decode($json);

        foreach ($states as $state) {
            // Check manually if ID exists
            $exists = DB::table('states')->where('id', $state->id)->exists();

            if (!$exists) {
                DB::table('states')->insert([
                    'id' => $state->id,
                    'country_id' => $state->country_id,
                    'name' => $state->name,
                    
                ]);
            }
        }
    }
}
