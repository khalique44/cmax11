<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Storage::get('backups/cities.json');
        $data = json_decode($data);
        foreach ($data as $d)
            if (!DB::table('cities')->find($d->id))
                DB::table('cities')->insert([
                    'id' => $d->id,
                    'state_id' => $d->state_id,
                    'name' => $d->name
                ]);
    }
}
