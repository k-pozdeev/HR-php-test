<?php

namespace App\Http\Controllers;

class HelloController extends Controller
{
    public function home() {
        $data = [
            'menu_active' => null,
            'title' => 'Привет!',
        ];
        return view('home', $data);
    }
}
