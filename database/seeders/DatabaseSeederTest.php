<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TechnologySeeder;

class DatabaseSeederTest extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){

        $this->call([
            SettingSeeder::class,
            DesignationSeeder::class,
            BloodGroupSeeder::class,
            ClientTypeSeeder::class,
        ]);
    }
}
