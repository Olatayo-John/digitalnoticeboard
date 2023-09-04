<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloodGroups = ["A", "B", "O", "AB", "A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"];

        foreach ($bloodGroups as $key => $value) {
            BloodGroup::create([
                'name' => $value
            ]);
        }
    }
}
