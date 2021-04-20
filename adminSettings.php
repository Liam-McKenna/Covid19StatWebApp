<?php
require_once "./partials/header.php";
include_once "./components/navbar.php";
?>

<body>
    <div class="admin-container">

        <h1>Administrator Settings</h1>
        <!-- <form class="adminform" method="post">
            <input id=updateCountries type="submit" name="btnCountryUpdate" value="Update Countries">
        </form> -->

        <form class="adminform" method="post">
            <input id=updateData type="submit" name="btnDataUpdate" value="Update All Country Data">
        </form>

        <div id="outputWindow" class="output-window">
            <?PHP
            include_once "./API/request.php";
            ?>
        </div>
    </div>



</body>

<Script>
    // let updateCountries = document.getElementById("updateCountries");
    let updateData = document.getElementById("updateData");

    // updateCountries.addEventListener('click', function() {
    //     document.getElementById("outputWindow").innerHTML = "<p>loading, Do Not Close. <br>  Please wait...</p>";
    // })
    updateData.addEventListener('click', function() {
        document.getElementById("outputWindow").innerHTML = "<p>loading, Do Not Close. <br> Please wait...</p>";
    })
</Script>