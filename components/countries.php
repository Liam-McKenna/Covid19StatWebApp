<?php


echo "<div class='country'>" . '<h3>', $countryName, '</h3>';
$sqlQ2 = "SELECT * FROM $countryName ORDER BY date DESC LIMIT 6 ";
$CountryData = $conn->query($sqlQ2);

if ($CountryData->num_rows > 0) {
    // output data of each row
    while ($rowData = $CountryData->fetch_assoc()) {
        echo "<div class='row'>" . "cases " . $rowData["cases"] . " -- deaths: " . $rowData["deaths"] . " -- date: " . $rowData["date"] . "<br>" . "</div>";
    }
} else {
    echo "0 results";
};

$_SESSION[$countryName] = [$countryName];
?>



<button id='<?php echo $countryName; ?>' onClick=loadCountry('<?php echo $countryName; ?>')>See More.</button>
</div>

<script>
    function loadCountry(countryID) {
        console.log(countryID);
        document.cookie = 'selectedCountry=' + countryID;
        window.location.href = `singleCountry.php?country=${countryID}`;
    }
</script>