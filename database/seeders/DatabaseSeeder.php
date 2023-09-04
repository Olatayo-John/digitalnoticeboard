<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TechnologySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            PermissionTableSeeder::class,
            SettingSeeder::class,
            CreateAdminUserSeeder::class,
            DesignationSeeder::class,
            // QualificationSeeder::class,
            BloodGroupSeeder::class,
            TechnologySeeder::class,
            UserTechnologySeeder::class,
            ClientTypeSeeder::class,
            ClientSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
