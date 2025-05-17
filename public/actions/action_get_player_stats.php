<?php

use App\Impl\DB;
use App\Impl\SearchPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$id = $_GET['player_id'];


$searchPlayer = new SearchPlayer($db, $pdo);
try {
    $playerStats = $searchPlayer->searchPlayerById($id);
} catch (Exception $e) {
    echo json_encode(['erro' => $e->getMessage()]);
    return;
}

if (! empty($playerStats)) {
    echo json_encode(['' => $playerStats[0]], true);
    return;
}

echo json_encode(['erro' => 'Ocorreu um erro ao executar a busca!']);
return;

