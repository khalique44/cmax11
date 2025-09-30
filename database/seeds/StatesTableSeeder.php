<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Storage::get('backups/states.json');
        $data = json_decode($data);
        foreach ($data as $d)
            if (!DB::table('states')->find($d->id))
                DB::table('states')->insert([
                    'id' => $d->id,
                    'country_id' => $d->country_id,
                    'name' => $d->name
                ]);
    }
}
