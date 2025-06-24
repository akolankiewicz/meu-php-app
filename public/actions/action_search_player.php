<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Search\SearchPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$search = $_POST['search'] ?? null;
$nome = $_POST['nome'] ?? '';
$posicao = $_POST['posicao'] ?? '';
$clube = $_POST['clube'] ?? '';

$searchPlayer = new SearchPlayer($db, $pdo);
if ($search === null) {
    $retorno = $searchPlayer->searchPlayerByNamePositionClub($nome, $posicao, $clube);
} else {
    $retorno = $searchPlayer->searchPlayer($search);
}

if (! $retorno) {
    echo json_encode(['erro' => 'Não existem jogadores para essa busca!']);
    return;
}

echo json_encode($retorno);