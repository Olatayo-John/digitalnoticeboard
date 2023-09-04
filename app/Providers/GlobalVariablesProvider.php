<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class GlobalVariablesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Setting::all();
        $globalSettings = Arr::keyBy($settings, 'meta_key');

        view()->share('globalSettings', $globalSettings);
    }
}
