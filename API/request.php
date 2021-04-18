<?php
include_once "./database/dbConnection.php";

// this script will call the API for a list of all the countries that are available with data, it then adds the country identifier to the database.






// if the button is clicked:
if (isset($_POST['btnCountryUpdate'])) {
    // ALL COUNTRIES NAME & ID UPDATE
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://corona-api.com/countries',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    $resJSON = json_decode($response, true);
    foreach ($resJSON['data'] as $item) {
        $countryName = $item['name'];
        $countryCode = $item['code'];
        $query = "INSERT INTO `countries`(countryName,countryCode) VALUES ('$countryName', '$countryCode');";
        $sqlQ1 = mysqli_query($conn, $query);
    }
    echo "<p>Countries Update Completed Successfully.</p>";
}

// this script will queery the database for all the countries entered, then for each country it will make an API call to get the covid19 dat for that country. Then for each row of data for that country it will post it to the database, repeats for each country. If there is a country without any timeline data, it will delete the country from the database.

// if the button is clicked
if (isset($_POST['btnDataUpdate'])) {

    // this script will call the API for a list of all the countries that are available with data, it then adds the country identifier to the database.

    // Call the API for All countries and add them to the database.
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://corona-api.com/countries',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    $resJSON = json_decode($response, true);
    foreach ($resJSON['data'] as $item) {
        $countryName = $item['name'];
        $countryCode = $item['code'];
        $query = "INSERT INTO `countries`(countryName,countryCode) VALUES ('$countryName', '$countryCode');";
        $sqlQ1 = mysqli_query($conn, $query);
        // echo "<p>" . $countryName . ' - ' . $countryCode . "</p>";

    }
    echo "<p>Countries Updated.</p>";

    //GLOBAL DATA
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://corona-api.com/timeline',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    $resJSON = json_decode($response, true);
    foreach ($resJSON['data'] as $item) {
        $globalDate = $item['date'];
        $globalConfirmed = $item['new_confirmed'];
        $globalDeath = $item['new_deaths'];
        $globalRecovered = $item['new_recovered'];
        $query = "INSERT INTO `globalCovid`(globalDate, cases, deaths, recovered) VALUES ('$globalDate', '$globalConfirmed', '$globalDeath', '$globalRecovered');";
        $sqlSubmit = mysqli_query($conn, $query);
    }
    echo "<p>Global Data Updated</p>";


    // this script will queery the database for all the countries entered, then for each country it will make an API call to get the covid19 dat for that country. Then for each row of data for that country it will post it to the database, repeats for each country. If there is a country without any timeline data, it will delete the country from the database.
    $query = "SELECT * FROM countries;";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // while loop for each country in the database.
        while ($countryRow = mysqli_fetch_assoc($result)) {
            //echo $countryRow['countryName'] . " - " . $countryRow['countryCode'] . "<br>";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://corona-api.com/countries/' . $countryRow["countryCode"],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            $resJSON = json_decode($response, true);
            if (empty($resJSON['data']['timeline'])) {
                // echo $countryRow["countryName"] . " Is empty.<br><br>";
                $queryDeleteCountry = "DELETE FROM countries WHERE countryName= '" . $countryRow['countryName'] . "';";
                mysqli_query($conn, $queryDeleteCountry);
            } else {
                foreach ($resJSON['data']['timeline'] as $entry) {
                    $queryAddData = "INSERT INTO `covid19Stats`(countryID, reportDate, cases, deaths) VALUES ('" . $countryRow['countryCode'] . "','" . $entry['date'] . "'," . $entry['new_confirmed'] . "," . $entry['new_deaths'] . ");";
                    $sqlQ1 = mysqli_query($conn, $queryAddData);
                }
            }
        }
    }
    echo "<p> Updated all data successfully.</p>";
}
