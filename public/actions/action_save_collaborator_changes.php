<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use \App\Collaborators\Impl\UpdateUser;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método não permitido']);
    return;
}

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (! $data['id']) {
    echo json_encode(['error' => 'ID do jogador é obrigatório']);
    return;
}

$updateUser = new UpdateUser($db);
try {
    $returned = $updateUser->updateUser($data);
} catch (Exception $e) {
    echo json_encode(['erro' => $e->getMessage()]);
    return;
}

echo json_encode($returned);
return;