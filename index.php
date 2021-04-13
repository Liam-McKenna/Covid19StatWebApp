<?php
require_once "./partials/header.php";
include_once "./database/dbConnection.php";

if (!$_GET['page']) {
    header("location: ./index.php?page=1");
}
?>

<body>

    <?php include_once "./components/navbar.php"; ?>
    <main>

        <?php
        if (isset($_SESSION['userid'])) {
            echo "<h2> Hello " . $_SESSION['username'] . "!</h2>";
        }
        ?>
        <h1>Covid19 Data Tracker</h1>
        <?php include_once "./components/searchbar.php";
        ?>


</body>