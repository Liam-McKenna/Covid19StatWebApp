<?php
require_once "../partials/header.php";
include_once "../database/dbConnection.php";
if (!$_GET['page']) {
    header("location: ../pages/index.php?page=1");
}
?>



<body>
    <?php include_once "../components/navbar.php"; ?>
    <main>


        <h1>Covid19 Data Tracker</h1>
        <?php include_once "../components/searchbar.php"; ?>

        <?php
        $paginator = 0;
        $resultsPerPage = 6;
        ?>
        <div class=countryContainer>
            <?php
            // $query = "SHOW TABLES";
            $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'coviddatadb'; ";
            $sqlQ1 = mysqli_query($conn, $query);

            $numberResults  = $sqlQ1->num_rows;
            #for each table in the database
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            $numberPages = ceil($numberResults / $resultsPerPage);
            $this_page_first_result = ($page - 1) * $resultsPerPage;

            $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'coviddatadb' LIMIT $this_page_first_result, $resultsPerPage; ";
            $perPage = mysqli_query($conn, $query);


            while ($tableName = mysqli_fetch_row($perPage)) {

                $countryName = $tableName[0];
                if ($countryName != "users") {
                    include "../components/countries.php";
                }
            }
            ?>
        </div>
        <div class="paginator">
            <button class="pageback" id="back" onclick="window.location.href='index.php?page=<?php echo $_GET['page'] - 1; ?>'">
                < </button>
                    <div class=" currentPageRange" id="currentpage">
                        <?php
                        for ($page = 1; $page <= $numberPages; $page++) {
                            echo '<a class="page-numbers" id="page' . $page . '" href="index.php?page=' . $page . '"> ' . $page . '</a>';
                        } ?>
                    </div>
                    <button class="pageforward" id="forward" onclick="window.location.href='index.php?page=<?php if ($_GET['page'] < $numberPages) {
                                                                                                                echo $_GET['page'] + 1;
                                                                                                            } else {
                                                                                                                echo $numberPages;
                                                                                                            }    ?>'">></button>

        </div>
    </main>
    <script>
        let pageNumber = <?php echo $_GET['page'] ?>;
        console.log(pageNumber);
        document.getElementById("page" + pageNumber).style.color = "#ea80fc";
    </script>
</body>

</html>