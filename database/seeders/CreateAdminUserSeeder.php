<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'profile_image' => 'default/mishaM.png',
            'contact_mobile' => '1234567890',
            'password' => Hash::make('123456'),
            'is_active'=> '1',
        ]);

        // $role = Role::create(['name' => 'Admin']);
        $role = Role::where('name', 'Admin')->get()->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);

        User::factory(10)->create()->each(function ($user) {
            $role = Role::where('name', 'User')->get()->first();
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        });
    }
}
