<?php

namespace App\Services;

class YandexWeatherClient
{
    private $apiKey;

    /**
     * YandexWeatherService constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return float
     * @throws \Exception
     */
    public function getTemp(float $latitude, float $longitude): float {
        if ($this->apiKey == '') {
            throw new \Exception("Не задан ключ API");
        }
        $url = "https://api.weather.yandex.ru/v1/forecast?lat=${latitude}&lon=${longitude}";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-Yandex-API-Key: " . $this->apiKey]);
        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl)['http_code'];
        $errno = curl_errno($curl);
        if ($errno != 0) {
            $error = curl_error($curl);
            throw new \Exception($error);
        }
        if ($httpCode != 200) {
            throw new \Exception("Код ответа сервера отличается от 200: " . $httpCode . "; ответ: " . $result);
        }
        $data = json_decode($result, true);
        $jsonError = json_last_error();
        if ($jsonError != JSON_ERROR_NONE) {
            throw new \Exception("Ошибка разбора JSON: " . json_last_error_msg());
        }
        if (!isset($data['fact']['temp'])) {
            throw new \Exception("Некорректный ответ сервера");
        }

        return (float) $data['fact']['temp'];
    }
}