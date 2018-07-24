<?php

namespace App;

class Weather
{
    const UNITS_IMPERIAL = 'imperial';
    const UNITS_METRIC = 'metric';

    const REQUEST_TYPE_WEATHER = 'weather';
    const REQUEST_TYPE_FORECAST = 'forecast';

    private static $API_URL = 'http://api.openweathermap.org/data/2.5/';

    private $units;
    private $lang;
    private $query;
    private $requestType;

    private function __construct($query, $units = self::UNITS_METRIC, $lang = 'en', $requestType = self::REQUEST_TYPE_WEATHER)
    {
        $this->query = $query;
        $this->units = $units;
        $this->lang = $lang;
        $this->requestType = $requestType;
    }

    private function buildCurrentRequestURL()
    {
        return self::$API_URL.$this->requestType.'?'.$this->query.'&units='.$this->units.'&lang='.$this->lang.'&appid='.env('OPENWEATHER_API_KEY');
    }

    public function get()
    {
        return json_decode(file_get_contents($this->buildCurrentRequestURL()));
    }

    public function units($unitsType)
    {
        return new self($this->query, $unitsType, $this->lang, $this->requestType);
    }

    public function lang($lang)
    {
        return new self($this->query, $this->units, $lang, $this->requestType);
    }

    public function requestType($requestType)
    {
        return new self($this->query, $this->units, $this->lang, $requestType);
    }

    public static function byCityName($cityName)
    {
        return new self('q=' . $cityName);
    }

    public static function byCityId($cityId)
    {
        return new self('id=' . $cityId);
    }

    public static function byCoordinates($lat, $lon)
    {
        return new self("lat=$lat&lon=$lon");
    }
}
