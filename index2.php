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
            chart: {
                type: 'area',
                animations: {
                    enabled: false
                },
            },
            series: [{
                name: 'Dados',
            }],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: label
            },
            yaxis: {
                min: 0,
                max: 10000
            }
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

            axios.post('script.php')
                .then(function(response) {
                    //var obj = jQuery.parseJSON(' {"name" : "John"} ');
                    //alert ( obj.name );
                    console.log(response['data']['label']);
                    //dados = response.data;
                    chart.updateSeries(
                        [{
                            data: response['data']['dados']
                        }]
                    );
                    chart.updateOptions({
                        xaxis: {
                            categories: response['data']['label'],
                            title: {
                                style: {
                                    fontWeight: 600
                                }
                            }
                        },
                    });
                })
                .catch(function(error) {
                    console.log('Erro: ' + error);
                })
        }
    </script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>