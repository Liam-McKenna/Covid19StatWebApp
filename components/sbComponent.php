<?PHP
include_once "../database/dbConnection.php";
if (isset($_POST['currentPage'])) {
    $currentPage = $_POST['currentPage'];
} else {
    $currentPage = 1;
}
//checks if there is a search. needed to stop null value breaking the page when first loaded.
if (!empty($searchEntry = $_POST['searchEntry'])) {

    $paginator = 0;
    $resultsPerPage = 6;
?>
    <!-- if search isnt active -->
    <div class=countryContainer>
        <?php
        $query = "SELECT countryName FROM countries WHERE countryName LIKE '$searchEntry%';";
        $sqlQ1 = mysqli_query($conn, $query);

        $numberResults  = $sqlQ1->num_rows;
        #for each table in the database
        if (!isset($currentPage)) {
            $page = 1;
        } else {
            $page = $currentPage;
        }
        $numberPages = ceil($numberResults / $resultsPerPage);
        $this_page_first_result = ($page - 1) * $resultsPerPage;
        $query = "SELECT * FROM countries WHERE countryName LIKE '$searchEntry%' LIMIT $this_page_first_result , $resultsPerPage; ";
        $countriesResult = mysqli_query($conn, $query);
        $countriesCheck = mysqli_num_rows($countriesResult);
        if ($countriesCheck > 0) {

            while ($countryData = mysqli_fetch_assoc($countriesResult)) {
                $countryName = $countryData['countryName'];
                $countryCode = $countryData['countryCode'];
                include "./countries.php";
            }
        }
        ?>
    </div>
<?PHP
    // IF THERE IS NOTHING ENTERED IN SEARCH BAR.
} else {
    $paginator = 0;
    $resultsPerPage = 6;
?>
    <!-- if search isnt active -->
    <div class=countryContainer>
        <?php
        $query = "SELECT countryName FROM countries; ";
        $sqlQ1 = mysqli_query($conn, $query);

        $numberResults  = $sqlQ1->num_rows;
        #for each table in the database
        if (!isset($currentPage)) {
            $page = 1;
        } else {
            $page = $currentPage;
        }
        $numberPages = ceil($numberResults / $resultsPerPage);
        $this_page_first_result = ($page - 1) * $resultsPerPage;

        $query = "SELECT * FROM countries LIMIT $this_page_first_result , $resultsPerPage; ";
        $countriesResult = mysqli_query($conn, $query);
        $countriesCheck = mysqli_num_rows($countriesResult);
        if ($countriesCheck > 0) {

            while ($countryData = mysqli_fetch_assoc($countriesResult)) {
                $countryName = $countryData['countryName'];
                $countryCode = $countryData['countryCode'];
                include "./countries.php";
            }
        } else {
            echo "<h3> There is currently no data available. Please signup/login & download the covid19 data from the Admin settings page or upload the CSV files in the 'database->testData' folder to the database.</h3>";
        }
        ?>
    </div>
    <div class="paginator">
        <button class="pageback" id="back" onclick="window.location.href='index.php?page=<?php echo $currentPage - 1; ?>'">
            < </button>

                <div class=" currentPageRange" id="currentpage">
                    <?php
                    for ($page = $currentPage - 1; $page <= $numberPages && $page <= $currentPage + 5; $page++) {

                        if ($page > 0) {
                            echo '<a class="page-numbers" id="page' . $page . '" href="index.php?page=' . $page . '"> ' . $page . '</a>';
                        }
                    } ?>
                </div>
                <button class="pageforward" id="forward" onclick="window.location.href='index.php?page=<?php if ($currentPage < $numberPages) {
                                                                                                            echo $currentPage + 1;
                                                                                                        } else {
                                                                                                            echo $numberPages;
                                                                                                        }    ?>'">></button>
    </div>
    </main>
<?PHP
}
?>