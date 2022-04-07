<?php

namespace App\Providers;

use App\Services\Parsers\SystemInfo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        config([ 'app.timezone' => SystemInfo::getTimezone() ]);
    }
}
