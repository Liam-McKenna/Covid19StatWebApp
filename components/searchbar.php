<!-- <input type="text" name="searchBar" id="searchBar" placeholder="search for country" />

<script>
    const searchbar = document.getElementById('searchBar');

    searchbar.addEventListener('keyup', (e) => {
        console.log(e.target.value);

    });
</script> -->


<form action="" method="POST">
    <p>Enter Country Name: </p>
    <input type="text" name="search" value="">
    <input type="submit" name="SearchSubmit" value="Search">
</form>

<?php


if (isset($_POST['SearchSubmit'])) {
    $country =  $_POST['search'];
    $_POST = array();

    //header()

    echo "
    <script>
    parent.self.location = \"singleCountry.php?countryCode=ie&countryName=" . $country . "\";
    </script>
    ";
}
?>