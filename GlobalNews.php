<?php
require_once "./partials/header.php";
include_once "./database/dbConnection.php";

$ChartsGlobalQuery = "SELECT * FROM globalcovid ORDER BY globaldate;";
$SelectGlobalData = mysqli_query($conn, $ChartsGlobalQuery);
$DateArray = [];
$CasesArray = [];
$DeathsArray = [];
$RecoveryArray = [];
while ($data = $SelectGlobalData->fetch_assoc()) {
    array_push($DateArray,  $data['globalDate']);
    array_push($CasesArray,  $data['cases']);
    array_push($DeathsArray,  $data['deaths']);
    array_push($RecoveryArray,  $data['recovered']);
};
$TopGlobalQuery = "SELECT countries.countryName, covid19stats.reportDate, covid19stats.cases, covid19stats.deaths FROM covid19stats
INNER JOIN countries ON covid19stats.countryID=countries.countryCode WHERE reportDate = (SELECT MAX(reportDate) FROM covid19stats) ORDER BY cases desc limit 5;";
$SelectTopGlobal = mysqli_query($conn, $TopGlobalQuery);
$CountryName = [];
$DateTop = [];
$CasesTop = [];
$DeathsTop = [];
while ($data = $SelectTopGlobal->fetch_assoc()) {
    array_push($CountryName,  $data['countryName']);
    array_push($DateTop,  $data['reportDate']);
    array_push($CasesTop,  $data['cases']);
    array_push($DeathsTop,  $data['deaths']);
};
?>

<body>
    <?php include_once "./components/navbar.php"; ?>
    <main>

        <div class="todayContainer">
            <div class="globalTables">
                <h1>Global Data For Today</h1>
                <table class="todayGlobal">
                    <tr>
                        <th>Cases</th>
                        <th>Deaths</th>
                        <th>Recovery</th>
                    </tr>
                    <tr>
                        <td id="cases" class="left-td">Cases: </td>
                        <td id="deaths">Deaths: </td>
                        <td id="recovered" class="right-td">Recovered: </td>
                    </tr>
                </table>
                <h1>highest 5 countries Today</h1>
                <table class="todayGlobal">
                    <tr>
                        <th>Country</th>
                        <th>Cases</th>
                        <th>Deaths</th>
                    </tr>
                    <?php
                    for ($x = 0; $x <= 4; $x++) {
                        echo "    <tr><td class='left-td'>" . $CountryName[$x] . "</td> <td>" . $CasesTop[$x] . " </td> <td class='right-td'> " . $DeathsTop[$x] . " </td> </tr>";
                    } ?>
                </table>
            </div>


            <div class="global-chart-container">
                <h1>Global Graph</h1>
                <div class="chartContainer-global">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </div>

        </div>
    </main>
</body>

<script>
    let dateArray = <?php echo json_encode($DateArray); ?>;
    let casesArray = <?php echo json_encode($CasesArray); ?>;
    let deathsArray = <?php echo json_encode($DeathsArray); ?>;
    let RecoveryArray = <?php echo json_encode($RecoveryArray); ?>;

    document.getElementById('cases').innerHTML = `${casesArray.slice(-1)}`;
    document.getElementById('deaths').innerHTML = `${deathsArray.slice(-1)}`;
    document.getElementById('recovered').innerHTML = `${RecoveryArray.slice(-1)}`;


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
                },
                {
                    label: 'Recovery',
                    data: [].concat(RecoveryArray),
                    fill: false,
                    backgroundColor: 'lightblue',
                    borderWidth: 1,
                    borderColor: 'lightblue',
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
                    text: 'global Data'
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