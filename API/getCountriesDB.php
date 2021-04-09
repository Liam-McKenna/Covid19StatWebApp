<?PHP
include_once "../database/herokuDBConnect.php";
?>

<div id="countriesin">
    <?php


    $query = "SELECT * FROM countries;";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['countryName'] . " - " . $row['countryCode'] . "<br>";
        }
    }
    ?>
</div>