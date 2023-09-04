<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory(20)->create()->each(function($project){
            //attach admin first
            $project->members()->sync(['1']);

            //because we are gen random numbers for is_active, hemce bug here (inaccurate data)
            // // 1-5 members in a project
            // $len = fake()->numberBetween($min = 1, $max = 5);
            // for ($i = 0; $i < $len; $i++) {
            //     //attach any random user id except admin
            //     $project->members()->attach(fake()->numberBetween($min = 2, $max = 11));
            // }

        });
    }
}
