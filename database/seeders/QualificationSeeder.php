<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualifications = ["B.Tech", "BCA", "M.Tech", "B.Pharm", "MCA"];

        foreach ($qualifications as $key => $value) {
            Qualification::create([
                'name' => $value
            ]);
        }
    }
}
