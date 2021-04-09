<?php

// function errorHandler($n, $m, $f, $l)
// {
//     header('Location: index.php');
// }
// set_error_handler('errorHandler');

require_once "./partials/header.php";
include_once "./database/dbConnection.php";


?>


<body>
    <?php include_once "./components/navbar.php"; ?>
    <main>
        <?php
        //$country = $_COOKIE['selectedCountry'];
        $countryCode = $_GET['countryCode'];
        $countryName = $_GET['countryName'];

        $sqlCountryQuery = "SELECT * FROM covid19Stats WHERE countryID = '$countryCode' ORDER BY reportDate ";
        $SelectCountryData = mysqli_query($conn, $sqlCountryQuery);



        if ($SelectCountryData->num_rows > 0) {
            // output data of each row

            echo "<div class='countryContainer'>" . "<div class='focus-country'>" . '<h3>', $countryName, '</h3>';
            while ($rowData = $SelectCountryData->fetch_assoc()) {
                echo "<div class='row'>" . "cases " . $rowData["cases"] . " -- deaths: " . $rowData["deaths"] . " -- date: " . $rowData["reportDate"] . "<br>" . "</div>";
            }
        } else {
            echo "0 results";
        };

        echo "</div>" . "</div>";
        ?>
    </main>
</body>