<?php 


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Storage::get('backups/countries.json');
        $data = json_decode($data);
        foreach ($data as $d)
            if (!DB::table('countries')->find($d->id))
                DB::table('countries')->insert([
                    'id' => $d->id,
                    'short_name' => $d->short_name,
                    'name' => $d->name,
                    'phone_code' => $d->phone_code
                ]);
    }
}
