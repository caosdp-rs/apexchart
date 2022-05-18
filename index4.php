<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApexCharts - PHP - AJAX - MySQL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-6 offset-3">
                <div id="grafico"></div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" onclick="start()">Start</button>
            <button class="btn btn-secondary" onclick="stop()">Stop</button>
        </div>
    </div>
    <script>
        let dados2 = [];
        let label = [];
        let interval = null;
        let el = document.getElementById('grafico');
        let options = {
            series: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            chart: {
                width: 1000,
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 270
                }
            },
            labels: ['A', 'B', 'C', '4', '5', 'A', 'B', 'C', '4', '5'],
            fill: {
                type: 'gradient',
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800','#F44336', '#E91E63', '#9C27B0']
            },
            legend: {
                formatter: function(val, opts) {
                    return val + " - " + opts.w.globals.series[opts.seriesIndex]
                }
            },
            title: {
                text: 'Gradient Donut with custom Start-angle'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        let chart = new ApexCharts(el, options);
        chart.render();
        // =============================================
        function start() {
            interval = setInterval(myFunction, 3000);
        }
        // =============================================
        function stop() {
            clearInterval(interval);
        }


        function myFunction() {
            $.ajax({
                type: 'POST',
                url: 'script.php',
                success: function(response) {
                    var obj = JSON.parse(response)
                    //alert ( obj.name );
                    console.log(obj['dados']);
                    //dados = response.data;


                    chart.updateOptions({
                        series: obj['dados'],
                        labels: obj['label'],
                    });
                },
                error: function() {
                    console.log('Erro: ' + error);
                }
            });

        }
    </script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>