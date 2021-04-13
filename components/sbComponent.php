<?PHP
include_once "../database/dbConnection.php";

if (isset($_POST['currentPage'])) {
    $currentPage = $_POST['currentPage'];
} else {
    $currentPage = 1;
}


//checks if there is a search. needed to stop null value breaking the page when first loaded.
if (!empty($searchEntry = $_POST['searchEntry'])) {
    //echo $searchEntry = $_POST['searchEntry'];

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
    //echo "nothing entered";

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
        }
        ?>



    </div>
    <div class="paginator">




        <button class="pageback" id="back" onclick="window.location.href='index.php?page=<?php echo $currentPage - 1; ?>'">
            < </button>

                <div class=" currentPageRange" id="currentpage">
                    <?php
                    for ($page = $currentPage; $page <= $numberPages && $page <= $currentPage + 5; $page++) {
                        echo '<a class="page-numbers" id="page' . $page . '" href="index.php?page=' . $page . '"> ' . $page . '</a>';
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