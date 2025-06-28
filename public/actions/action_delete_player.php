<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Player\DeletePlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$id = (int)$_GET['player_id'];

$deletePlayer = new DeletePlayer($db, $pdo);
try {
    $playerDeleted = $deletePlayer->deletePlayer($id, 'true');
} catch (Exception $e) {
    echo json_encode(['erro' => htmlspecialchars($e->getMessage())]);
    return;
}

if ($playerDeleted) {
    echo json_encode(['success' => 'Jogador ID ' . $id . ' deletado com sucesso!']);
    return;
}

echo json_encode(['erro' => 'Algo deu errado!']);
