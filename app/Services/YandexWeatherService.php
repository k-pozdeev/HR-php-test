<?php

namespace App\Services;

class YandexWeatherService
{
    const CACHE_KEY = "yandex_weather_service_cache_key";
    const CACHE_MINUTES = 30;

    /**
     * @var YandexWeatherClient
     */
    private $client;

    /**
     * YandexWeatherService constructor.
     * @param $client
     */
    public function __construct(YandexWeatherClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return float|null
     */
    public function getTempInBryansk() {
        $lat = config("services.yandexWeather.cities.Bryansk")[0];
        $long = config("services.yandexWeather.cities.Bryansk")[1];

        $cached = \Cache::get(self::CACHE_KEY, null);
        if ($cached === null) {
            try {
                $value = $this->client->getTemp($lat, $long);
                \Cache::put(self::CACHE_KEY, $value, self::CACHE_MINUTES);
                return $value;
            } catch (\Exception $e) {
                \Log::error("Ошибка получения температуры в Брянске", ['exception' => $e, 'message' => $e->getMessage()]);
                return null;
            }
        } else {
            return $cached;
        }
    }
}