<?php

class OpenWeatherClient {

    private $ch;
    private $baseUrl;
    private $appID;

    function __construct(string $appID) {
        $this->ch = curl_init(); // Does HTTP Requests.
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true); // Setting Option to return the request body. 
        $this->baseUrl = "api.openweathermap.org/data/2.5/weather"; // Assigning URL(string) to the variable.
        $this->appID = $appID; // Assgning value to appID var. 
    }

    public function getWeatherByCity(string $city): Weather {
        curl_setopt($this->ch, CURLOPT_URL, $this->baseUrl . "?q=$city&units=metric&appid=" . $this->appID); // Tell CURL what url to call.
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, ["Accept: application/json", "Content-Type: application/json"]); // Tells CURL the expcted headers. 

        $response = curl_exec($this->ch); // Executing the HTTP request and returns (in this case) JSON String.
        $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE); // Gets the HTTP Status code ( Error codes etc... ).

        switch ($httpcode) {
            case 404: throw new Exception("No such city in database"); // Handling 404 error code.
            case 400: throw new Exception("No city entered in search field"); // Handling 400 error code.
            case 401: throw new Exception("API Error, please try again later"); // Handling 401 error code.
        }
        return $this->parseResponse($response); // Returns a Weather object.
    }

    private function parseResponse(string $response): Weather {
        $response_obj = json_decode($response); // Creates an object from JSON data.
        //var_dump($response_obj);
       // $weather = array_shift($response_obj->weather); // Gets the first index of the weather array.
        $weather1 = (new Weather())
                ->setName($response_obj->name)
                ->setDescription($response_obj->weather[0]->description) // $weather->description
                ->setLat($response_obj->coord->lat)
                ->setLon($response_obj->coord->lon)
                ->setPressure($response_obj->main->pressure)
                ->setTemp($response_obj->main->temp)
                ->setHumidity($response_obj->main->humidity)
                ->setWind($response_obj->wind->speed)
                ->setIcon($response_obj->weather[0]->icon); // $weather->icon // Initializes a new Weather object.
        // print_r($response);
        return $weather1; // Returns initialized weather object. 
    }

    public function printData(Weather $weather) {
        echo "<table border='1'>
            <tr>
                <td>
                    City
                </td>
                <td>
                   Description
                </td>
                <td>
                    Location
                </td>
                <td>
                    Temperature
                </td>
                <td>
                    Pressure
                </td>
                <td>
                    Humidity
                </td>
                <td>
                    Wind
                </td>
            </tr>
            <tr>
                <td>
                    ".$weather->getName()."
                </td>
                <td>
                    ".$weather->getDescription()."
                    <img src='http://openweathermap.org/img/w/".$weather->getIcon().".png' align='middle'>
                </td>
                <td>
                     Latitude:  ". $weather->getLat()."
                     <br>
                     Longitude:  ". $weather->getLon()."
                </td>
                <td>
                  ".$weather->getTemp() ."  Celsius
                </td>
                <td>
                    ".$weather->getPressure() ."  Psa
                </td>
                <td>
                   ".$weather->getHumidity() ."  Percent
                </td>
                <td>
                    ".$weather->getWind() ."  Km/h
                </td>

            </tr>
        </table>";
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
//  ["name"]=> string(7) "Beograd" 
//  ["cod"]=> int(200) } 
