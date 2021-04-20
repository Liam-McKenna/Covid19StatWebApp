<?php


echo "<div class='country' onClick='loadCountry(`" . $countryCode . "`,`" . $countryName . "` )'>" . '<h3>', $countryName, ' - ', $countryCode, '</h3>';
$sqlQ2 = "SELECT * FROM covid19Stats WHERE countryID = '$countryCode' ORDER BY reportDate DESC LIMIT 6;";
$CountryResult = mysqli_query($conn, $sqlQ2);
$countryCheck = mysqli_num_rows($CountryResult);

if ($countryCheck > 0) {
    // output data of each row
?>




    <table id="' . $countryCode . 'Table" class="tableDisplay">

        <thead>
            <tr>
                <th>cases</th>
                <th>deaths</th>
                <th>reportDate</th>
            </tr>
        </thead>
        <tbody>
            <?PHP
            while ($rowData = mysqli_fetch_assoc($CountryResult)) {
                echo '
            <tr>
            <td class="left-td">' . $rowData["cases"] . '</td>
            <td class="center-td">' . $rowData["deaths"] . '</td>
            <td class="right-td">' . $rowData["reportDate"] . '</td>
            </tr>';
            }
            ?>
        </tbody>
    </table>
<?PHP
} else {
    echo "<div class='row'> No Historical Data available for this country </div>";
};

$_SESSION[$countryName] = [$countryName];
?>

<button id='<?php echo $countryName; ?>' onClick="loadCountry('<?php echo $countryCode; ?>' , '<?php echo $countryName; ?>' )">See More.</button>
</div>