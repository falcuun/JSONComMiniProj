<?php
class OpenWeatherClient {

    private $ch;
    private $baseUrl;
    private $appID;

    function __construct(string $appID) {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $this->baseUrl = "api.openweathermap.org/data/2.5/weather";
        $this->appID = $appID;
    }

    public function getWeatherByCity(string $city): Weather {
        curl_setopt($this->ch, CURLOPT_URL, $this->baseUrl . "?q=$city&appid=" . $this->appID);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, ["Accept: application-json", "Content-Type: application-json"]);

        $response = curl_exec($this->ch);
        $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        switch ($httpcode) {
            case 404: throw new Exception("No such city in database");
            case 400: throw new Exception("No city entered in search field");
            case 401: throw new Exception("API Error, please try again later");
        }
        return $this->parseResponse($response);
    }

    public function getWeatherDescription() {
        
    }

    private function parseResponse(string $response): Weather {
        $this->response = json_decode($response);
        var_dump($this->response);
        $weather = array_shift($this->response->weather);
        $weather1 = (new Weather())
                ->setName($this->response->name)
                ->setDescription($weather->main)
                ->setLat($this->response->coord->lat)
                ->setLon($this->response->coord->lon)
                ->setPressure($this->response->main->pressure);

        // print_r($response);
        return $weather1;
    }

}



//  { ["coord"]=> object(stdClass)#2 (2) 
//  { ["lon"]=> float(21.41) 
//  ["lat"]=> float(43.86) }
//  ["weather"]=> array(1) { [0]=> object(stdClass)#4 (4) 
//  { ["id"]=> int(701) 
//  ["main"]=> string(4) "Mist" 
//  ["description"]=> string(4) "mist"
//  ["icon"]=> string(3) "50n" } } 
//  ["base"]=> string(8) "stations" 
//  ["main"]=> object(stdClass)#5 (5)
//  { ["temp"]=> float(286.15) 
//  ["pressure"]=> int(1016)
//  ["humidity"]=> int(100) 
//  ["temp_min"]=> float(286.15) 
//  ["temp_max"]=> float(286.15) } 
//  ["visibility"]=> int(2000) 
//  ["wind"]=> object(stdClass)#6 (2) { 
//  ["speed"]=> float(1.5) 
//  ["deg"]=> int(60) } 
//  ["clouds"]=> object(stdClass)#7 (1) { 
//  ["all"]=> int(8) } 
//  ["dt"]=> int(1526941800)
//  ["sys"]=> object(stdClass)#8 (6) 
//  { ["type"]=> int(1) 
//  ["id"]=> int(5971) 
//  ["message"]=> float(0.0037)
//  ["country"]=> string(2) "RS" 
//  ["sunrise"]=> int(1526871731) 
//# ["sunset"]=> int(1526925626) } 
//  ["id"]=> int(787215)
//  ["name"]=> string(7) "Paracin" 
//  ["cod"]=> int(200) } 
