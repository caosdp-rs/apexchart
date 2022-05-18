<?php

use EasyPDO\EasyPDO;

require "EasyPDO.php";

$bd = new EasyPDO();
$resultados = $bd->select("SELECT * FROM (SELECT * FROM products ORDER BY quantityInStock DESC LIMIT 10) alias ORDER BY quantityInStock");
$dados = [];

if ($bd->affectedRows < 10) {
    // Cria um array com um numero de dados para completar os 10
    $dados = array_fill(0, 10 - $bd->affectedRows, 0);
}
$result_array = array();
// Cria o array de dados
foreach ($resultados as $resultado) {
    $dados[] = intval($resultado->quantityInStock);
    $result_array['dados'][] = intval($resultado->quantityInStock);
    $labels[] = $resultado->productName;
    $result_array['label'][] = $resultado->productName;
}
//echo json_encode($dados);
echo json_encode($result_array);