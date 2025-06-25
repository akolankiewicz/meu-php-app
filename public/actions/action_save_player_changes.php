<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Player\UpdatePlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405 );
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);
$playerId = $data['id'] ?? null;

if (! $playerId) {
    http_response_code(400 );
    echo json_encode(['error' => 'ID do jogador é obrigatório']);
    exit;
}

$updatePlayer = new UpdatePlayer($db, $pdo);
try {
    $returned = $updatePlayer->updatePlayer($playerId, $data);
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

if ($returned) {
    echo json_encode(['success' => "Jogador ID $playerId atualizado com sucesso!"]);
} else {
    echo json_encode(['error' => "Erro ao atualizar jogador!"]);
}


