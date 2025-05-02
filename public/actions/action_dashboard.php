<?php

require '../../vendor/autoload.php';

$chartData = [
    ['label' => 'Categoria 1', 'value' => 35],
    ['label' => 'Categoria 2', 'value' => 28],
    ['label' => 'Categoria 3', 'value' => 15],
    ['label' => 'Categoria 4', 'value' => 22],
];

$totalJogadores = 1250;
$totalColaboradores = 35;
$acessosHoje = 287;

$jsonDataChart = json_encode($chartData);

echo json_encode([
    'chartData' => $jsonDataChart,
    'totalJogadores' => $totalJogadores,
    'totalColaboradores' => $totalColaboradores,
    'acessosHoje' => $acessosHoje,
]);

?>