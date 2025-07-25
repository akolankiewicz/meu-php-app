<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\Dashboard;
use App\Database\Impl\DB;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$dashboard = new Dashboard($db);

$cardsData = $dashboard->getCardsData();
$pizzaChartData = $dashboard->getPizzaChartData();
$barChartData = $dashboard->getBarChartData();
$activityData = $dashboard->getActivityData();

echo json_encode([
    'cardsData' => $cardsData,
    'barChartData' => $barChartData,
    'pizzaChartData' => $pizzaChartData,
    'activityData' => $activityData
]);
