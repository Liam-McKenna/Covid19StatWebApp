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


        <h1>Covid19 Data Tracker</h1>
        <?php include_once "./components/searchbar.php";
        ?>


</body>

</html>