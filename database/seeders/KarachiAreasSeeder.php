<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KarachiAreasSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Gulshan-e-Iqbal',
                'sub_areas' => [
                    'Block 1', 'Block 2', 'Block 3', 'Block 4', 'Block 5',
                    'Block 6', 'Block 7', 'Block 8', 'Block 9', 'Block 10',
                    'Block 11', 'Block 13-A', 'Block 13-B', 'Block 13-C', 'Block 14'
                ]
            ],
            [
                'name' => 'Gulistan-e-Johar',
                'sub_areas' => [
                    'Block 1', 'Block 2', 'Block 3', 'Block 4', 'Block 5',
                    'Block 6', 'Block 7', 'Block 8', 'Block 9', 'Block 10',
                    'Block 11', 'Block 12', 'Block 13', 'Block 14', 'Block 15', 'Block 16'
                ]
            ],
            [
                'name' => 'Clifton',
                'sub_areas' => [
                    'Block 1', 'Block 2', 'Block 3', 'Block 4', 'Block 5',
                    'Block 6', 'Block 7', 'Block 8', 'Block 9'
                ]
            ],
            [
                'name' => 'DHA',
                'sub_areas' => [
                    'Phase 1', 'Phase 2', 'Phase 3', 'Phase 4', 'Phase 5',
                    'Phase 6', 'Phase 7', 'Phase 8'
                ]
            ],
            [
                'name' => 'North Nazimabad',
                'sub_areas' => [
                    'Block A', 'Block B', 'Block C', 'Block D', 'Block E',
                    'Block F', 'Block G', 'Block H', 'Block I', 'Block J',
                    'Block K', 'Block L', 'Block M', 'Block N'
                ]
            ],
            [
                'name' => 'Nazimabad',
                'sub_areas' => [
                    'Block 1', 'Block 2', 'Block 3', 'Block 4', 'Block 5', 'Block 6'
                ]
            ],
            [
                'name' => 'Malir',
                'sub_areas' => [
                    'Kalaboard', 'Model Colony', 'Saudabad', 'Jinnah Avenue'
                ]
            ],
            [
                'name' => 'Korangi',
                'sub_areas' => [
                    'Korangi 1', 'Korangi 2', 'Korangi 3', 'Korangi 4', 'Korangi Industrial Area'
                ]
            ],
            [
                'name' => 'Orangi Town',
                'sub_areas' => [
                    'Sector 1', 'Sector 2', 'Sector 3', 'Sector 4', 'Sector 5',
                    'Sector 6', 'Sector 7', 'Sector 8', 'Sector 9', 'Sector 10',
                    'Sector 11', 'Sector 12', 'Sector 13', 'Sector 14', 'Sector 15'
                ]
            ]
        ];

        foreach ($areas as $area) {
            $areaId = DB::table('areas')->insertGetId([
                'city_id' => '31594',
                'name' => $area['name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach ($area['sub_areas'] as $subArea) {
                DB::table('sub_areas')->insert([
                    'area_id' => $areaId,
                    'name' => $subArea,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
