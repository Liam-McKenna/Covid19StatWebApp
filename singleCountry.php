<?php

function errorHandler($n, $m, $f, $l)
{
    header('Location: index.php');
}
set_error_handler('errorHandler');

require_once "./partials/header.php";
include_once "./database/dbConnection.php";


?>


<body>
    <?php include_once "./components/navbar.php"; ?>
    <main>
        <?php
        //$country = $_COOKIE['selectedCountry'];
        $country = $_GET['country'];

        $sqlCountryQuery = "SELECT * FROM $country ORDER BY date";
        $SelectCountryData = $conn->query($sqlCountryQuery);



        if ($SelectCountryData->num_rows > 0) {
            // output data of each row

            echo "<div class='countryContainer'>" . "<div class='focus-country'>" . '<h3>', $country, '</h3>';
            while ($rowData = $SelectCountryData->fetch_assoc()) {
                echo "<div class='row'>" . "cases " . $rowData["cases"] . " -- deaths: " . $rowData["deaths"] . " -- date: " . $rowData["date"] . "<br>" . "</div>";
            }
        } else {
            echo "0 results";
        };

        echo "</div>" . "</div>";
        ?>
    </main>
</body>