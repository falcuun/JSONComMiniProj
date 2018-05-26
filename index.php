<?php
include "Weather.php"; // Including external class.
include "Client.php"; // Including external class.

$city = "";
if (isset($_GET["cityInput"])) {
    $city = $_GET["cityInput"];
    $client = new OpenWeatherClient("63517466dcd2284276d4da5d4e897dd5"); // Creating a new Client object giving it a unique appID.
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="GET">
            <input name="cityInput" type="text" value="<?php echo $city; ?>">
        </form>
        <?php
        if ($city != "") {
            try {
                $weather = $client->getWeatherByCity($city); // Creats a Weather object and passing it a name of the city as a parameter;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        if (isset($weather)) {

            $client->printData($weather);
        }
        ?>


    </body>
</html>
