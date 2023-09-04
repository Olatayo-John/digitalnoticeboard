<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Designation::factory(10)->create();

        $designations = [ "CEO","Project Manager","Reporting Manager","Sr. Software Engineer","Software Engineer","Jr. Software Engineer","Sr. Software Developer","Software Developer","Jr. Software Developer","Sr .Net Developer",".Net Developer","Jr. Net Developer","Graphic Desinger","UI Designer","Flutter Developer","UI/UX Designer","PHP Developer","Java Developer","React Developer","Node Developer","Shopify Developer","Wordpress Developer","IT"];
        
        foreach ($designations as $key => $value) {
            Designation::create([
                'name' => $value
            ]);
        }
    }
}
