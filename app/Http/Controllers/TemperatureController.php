<?php

namespace App\Http\Controllers;

use App\Services\YandexWeatherService;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function temp(YandexWeatherService $yandexWeatherService) {
        $temperature = $yandexWeatherService->getTempInBryansk();
        $data = [
            'menu_active' => 'temperature',
            'title' => 'Температура в Брянске',
            'temperature' => $temperature,
        ];
        return view('temperature', $data);
    }
}
