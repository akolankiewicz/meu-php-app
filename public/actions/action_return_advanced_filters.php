<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Search\SearchPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$filters = $_POST;
$searchPlayer = new SearchPlayer($db, $pdo);
list($sql, $params) = $searchPlayer->buildAdvancedFilterQuery($filters);
$retorno = $searchPlayer->prepareAndExecuteQuery($sql, $params);

if (! $retorno) {
    echo json_encode(['erro' => 'Não existem jogadores para essa busca!']);
    return;
}

echo json_encode($retorno);

