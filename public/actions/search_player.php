<?php

use App\Impl\DB;
use App\Impl\SearchPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance()->getPdo();

$search = $_POST['search'];

$searchPlayer = new SearchPlayer($db);
$retorno = $searchPlayer->searchPlayer($search);

//if (count($retorno) > 1) {
//
//}

echo json_encode($retorno);