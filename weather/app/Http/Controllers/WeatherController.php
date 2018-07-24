<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weather;

class WeatherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['fiveDays']);
    }

    public function index()
    {
        return view('index');
    }

    public function today(Request $request)
    {
        $request->validate([
            'city' => 'required|max:100'
        ]);

        $weather = Weather::byCityName($request->input('city'))->get();
        return view('today', ['weather' => $weather, 'city' => $request->input('city')]);
    }

    public function fiveDays(Request $request)
    {
        $request->validate([
            'city' => 'required|max:100'
        ]);

        $forecast = Weather::byCityName($request->input('city'))->requestType(Weather::REQUEST_TYPE_FORECAST)->get();
        return view('fivedays', ['forecast' => $forecast, 'city' => $request->input('city')]);
    }
}
