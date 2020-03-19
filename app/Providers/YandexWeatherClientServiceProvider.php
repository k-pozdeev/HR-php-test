<?php

namespace App\Providers;

use App\Services\YandexWeatherClient;
use Illuminate\Support\ServiceProvider;

class YandexWeatherClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(YandexWeatherClient::class, function () {
            return new YandexWeatherClient(\Config::get('services.yandexWeather.apiKey'));
        });
    }
}
