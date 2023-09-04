<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user) {
            $len = fake()->numberBetween($min = 1, $max = 5);
            for ($i = 0; $i < $len; $i++) {
                // $user->technologies()->attach();
                DB::table('technology_user')->insert([
                    'user_id' => $user->id,
                    'technology_id' => fake()->numberBetween($min = 1, $max = 10),
                    'experience' => fake()->numberBetween($min = 0, $max = 30),
                ]);
            }
        });
    }
}
