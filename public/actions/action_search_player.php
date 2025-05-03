<?php

use App\Impl\DB;
use App\Impl\SearchPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$search = $_POST['search'];

$searchPlayer = new SearchPlayer($db);
$retorno = $searchPlayer->searchPlayer($search);

if (! $retorno) {
    echo json_encode(['erro' => 'Não existem jogadores para essa busca!']);
    return;
}

echo json_encode($retorno);