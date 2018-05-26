<?php
include "Weather.php";
include "Client.php";

$client = new OpenWeatherClient("63517466dcd2284276d4da5d4e897dd5");
try {
    $weather = $client->getWeatherByCity("Paracin");
} catch (Exception $e) {
    echo $e->getMessage();
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
        <table border="1">
            <tr>
                <td>
                    <?php
                    echo "City";
                    ?>
                </td>
                <td>
                    <?php
                    echo "Description";
                    ?>
                </td>
                <td>
                    <?php
                    print_r("Location");
                    ?>
                </td>
                <td>
                    <?php
                    print_r("Pressure");
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo $weather->getName();
                    ?>
                </td>
                <td>
                    <?php
                    echo $weather->getDescription();
                    ?>
                </td>
                <td>
                    <?php
                    print_r("Latitude: " . $weather->getLat());
                    echo "<br>";
                    print_r("Longitude: " . $weather->getLon());
                    ?>
                </td>
                <td>
                    <?php
                    print_r($weather->getPressure());
                    ?>
                </td>

            </tr>
        </table>
    </body>
</html>
