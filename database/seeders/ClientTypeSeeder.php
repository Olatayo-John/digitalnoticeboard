<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client_types = ['Company', 'Individual'];

        foreach ($client_types as $key => $value) {
            ClientType::create([
                'name' => $value
            ]);
        }
    }
}
