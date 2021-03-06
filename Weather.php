<?php

class Weather {

    private $name;
    private $description;
    private $lat;
    private $lon;
    private $temp;
    private $pressure;
    private $humidity;
    private $wind;
    private $icon;

    function getName(): string {
        return $this->name;
    }

    function setName($name): Weather {
        $this->name = $name;
        return $this;
    }

    function getDescription(): string {
        return $this->description;
    }

    function setDescription($description): Weather {
        $this->description = $description;
        return $this;
    }

    function getLat(): float {
        return $this->lat;
    }

    function setLat(float $lat): Weather {
        $this->lat = $lat;
        return $this;
    }

    function getLon(): float {
        return $this->lon;
    }

    function setLon(float $lon): Weather {
        $this->lon = $lon;
        return $this;
    }

    function getTemp() {
        return $this->temp;
    }

    function setTemp($tmp): Weather {
        $this->temp = $tmp;
        return $this;
    }

    function getPressure() {
        return $this->pressure;
    }

    function setPressure($pressure): Weather {
        $this->pressure = $pressure;
        return $this;
    }

    function getHumidity() {
        return $this->humidity;
    }

    function setHumidity($humidity) {
        $this->humidity = $humidity;
        return $this;
    }

    function getWind() {
        return $this->wind;
    }

    function setWind($wind) {
        $this->wind = $wind;
        return $this;
    }

    function getIcon() {
        return $this->icon;
    }

    function setIcon($icon) {
        $this->icon = $icon;
        return $this;
    }

}
