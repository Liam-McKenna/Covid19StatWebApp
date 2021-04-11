<?php


echo "<div class='country'>" . '<h3>', $countryName, ' - ', $countryCode, '</h3>';
$sqlQ2 = "SELECT * FROM covid19Stats WHERE countryID = '$countryCode' ORDER BY reportDate DESC LIMIT 6;";
$CountryResult = mysqli_query($conn, $sqlQ2);
$countryCheck = mysqli_num_rows($CountryResult);

if ($countryCheck > 0) {
    // output data of each row
    while ($rowData = mysqli_fetch_assoc($CountryResult)) {
        echo "<div class='row'>" . "cases " . $rowData["cases"] . " -- deaths: " . $rowData["deaths"] . " -- date: " . $rowData["reportDate"] . "<br>" . "</div>";
    }
} else {
    echo "<div class='row'> No Historical Data available for this country </div>";
};

$_SESSION[$countryName] = [$countryName];
?>



<button id='<?php echo $countryName; ?>' onClick="loadCountry('<?php echo $countryCode; ?>' , '<?php echo $countryName; ?>' )">See More.</button>
</div>