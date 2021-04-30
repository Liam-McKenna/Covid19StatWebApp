<?php
function errorHandler($n, $m, $f, $l)
{
    header('Location: index.php');
}
set_error_handler('errorHandler');
require_once "./partials/header.php";
include_once "./database/dbConnection.php";

$countryCode = $_GET['countryCode'];
$countryName = $_GET['countryName'];
?>

<body>
    <?php include_once "./components/navbar.php"; ?>
    <main>
        <h1>Data Hub: <?php echo $countryName ?> </h1>
        <div class="AllDataContainer">
            <div class="chartContainer">
                <canvas class="chart" id="myChart"></canvas>
            </div>
            <?php
            //$country = $_COOKIE['selectedCountry'];
            $sqlCountryQuery = "SELECT * FROM covid19Stats WHERE countryID = '$countryCode' ORDER BY reportDate DESC ";
            $ChartsCountryQuery = "SELECT * FROM covid19Stats WHERE countryID = '$countryCode' ORDER BY reportDate";
            $SelectCountryData = mysqli_query($conn, $sqlCountryQuery);
            $CountryDataCharts = mysqli_query($conn, $ChartsCountryQuery);
            $DateArray = [];
            $CasesArray = [];
            $DeathsArray = [];
            while ($data = $CountryDataCharts->fetch_assoc()) {
                array_push($DateArray,  $data['reportDate']);
                array_push($CasesArray,  $data['cases']);
                array_push($DeathsArray,  $data['deaths']);
            };
            if ($SelectCountryData->num_rows > 0) {
                // output data of each row
                echo "<div class='countryContainer'>" . "<div class='focus-country'>" . '<h3>', $countryName, '</h3>';
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
                        while ($rowData = $SelectCountryData->fetch_assoc()) {
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
                echo "0 results";
            };

            echo "</div> </div> </div> ";
            ?>
    </main>
</body>
<script>
    let dateArray = <?php echo json_encode($DateArray); ?>;
    let casesArray = <?php echo json_encode($CasesArray); ?>;
    let deathsArray = <?php echo json_encode($DeathsArray); ?>;
    let countryName = "<?php echo $countryName; ?>";

    let myChart = document.getElementById('myChart').getContext('2d');
    let dataChart = new Chart(myChart, {
        type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data: {
            labels: [].concat(dateArray),
            datasets: [{
                    label: 'Cases',
                    data: [].concat(casesArray),
                    fill: false,
                    backgroundColor: '#ffb259',
                    borderWidth: 1,
                    borderColor: '#ffb259',
                    hoverBorderWidth: '10',
                    hoverBorderColor: 'white',
                    pointRadius: 1,
                    pointHoverRadius: 1
                },
                {
                    label: 'Deaths',
                    data: [].concat(deathsArray),
                    fill: false,
                    backgroundColor: 'red',
                    borderWidth: 1,
                    borderColor: 'red',
                    hoverBorderWidth: '10',
                    hoverBorderColor: 'white',
                    pointRadius: 1,
                    pointHoverRadius: 1
                }
            ]
        },

        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: countryName
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                    },
                    gridLines: {
                        display: true,
                        color: '#3B3F41',
                        lineWidth: 2
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: false
                    },
                    gridLines: {
                        display: true,
                        lineWidth: 5
                    }
                }]
            }
        }
    });
</script>