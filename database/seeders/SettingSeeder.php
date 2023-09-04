<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings=['site_name', 'site_keywords', 'site_logo', 'about_us', 'terms_condition', 'privacy_policy', 'mail_type', 'mail_host', 'mail_port', 'mail_username', 'mail_password'];
        
        foreach ($settings as $settings) {
            Setting::create([
                'meta_key' => $settings,
                'meta_value' => null,
            ]);
        }
    }
}
