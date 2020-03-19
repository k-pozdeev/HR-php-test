<?php

namespace Tests\Unit;

use App\Services\YandexWeatherClient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class YandexWeatherClientTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $apiKey = config("services.yandexWeather.apiKey");
        $yandexWeatherService = new YandexWeatherClient($apiKey);
        $lat = config("services.yandexWeather.cities.Bryansk")[0];
        $long = config("services.yandexWeather.cities.Bryansk")[1];
        $result = $yandexWeatherService->getTemp($lat, $long);
        $this->assertTrue(is_float($result));
    }
}
