<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'mumbai',
            'nashik',
            'jalgaon',
            'pune',
            'Dhule',
        ];

        foreach ($cities as $city) {
            DB::table('cities')->updateOrInsert(
                ['slug' => Str::slug($city)],
                [
                    'name' => $city,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
