<?php
require_once "./partials/header.php";
include_once "./database/dbConnection.php";
?>

<body>
    <?php include_once "./components/navbar.php"; ?>
    <main>
        <div class="globalcontainer">
            <h1>Global Data</h1>
            <div class="chartContainer">
                <canvas class="chart" id="myChart"></canvas>
            </div>
            <?php
            $ChartsGlobalQuery = "SELECT * FROM globalcovid ORDER BY globaldate DESC";
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
            ?>
        </div>

        <div class="todayGlobal">
            <h1>Today</h1>
            <div class="globalDataToday">
                <h2 id="cases">Cases: </h2>
                <h2 id="deaths">Deaths: </h2>
                <h2 id="recovered">Recovered: </h2>
            </div>
        </div>

    </main>
</body>

<script>
    let dateArray = <?php echo json_encode($DateArray); ?>;
    let casesArray = <?php echo json_encode($CasesArray); ?>;
    let deathsArray = <?php echo json_encode($DeathsArray); ?>;
    let RecoveryArray = <?php echo json_encode($RecoveryArray); ?>;

    document.getElementById('cases').innerHTML = `Cases: ${casesArray[0]}`;
    document.getElementById('deaths').innerHTML = `Cases: ${deathsArray[0]}`;
    document.getElementById('recovered').innerHTML = `Cases: ${RecoveryArray[0]}`;


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
                    text: 'gloval Data'
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