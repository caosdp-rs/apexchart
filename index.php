<?php

// Ligação a base de dados
$ligacao = mysqli_connect('localhost', 'root', '', 'classicmodels');
$ligacao->set_charset('utf8');

// Vai buscar dados da base de dados
$resultados = mysqli_query($ligacao, "SELECT * FROM products order by quantityInStock desc LIMIT 10");
$nomes = [];
$quantidades = [];

while ($linha = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
    $nomes[] = "'{$linha['productName']}'";
    $quantidades[] = $linha['quantityInStock'];
}

$nomes = implode(',', $nomes);
$quantidades = implode(',', $quantidades);
echo '</pre>';
print_r($quantidades);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Apex</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <script src="dist/apexcharts.min.js"></script>
</head>

<body>
    <div id="chart"></div>
    <script>
        var options = {
            series: [<?php echo $quantidades; ?>],
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

            labels: [<?php echo $nomes; ?>],
            fill: {
                type: 'gradient',
                colors: ['#F44336', '#E91E63', '#9C27B0']
            },
            legend: {
                formatter: function(val, opts) {
                    return val + " - " + opts.w.globals.series[opts.seriesIndex]
                }
            },
            theme: {

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

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>


</body>

</html>