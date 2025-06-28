<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Collaborators\Impl\DeleteUser;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);
$collaboratorId = $data['id'] ?? null;

if (! $collaboratorId) {
    echo json_encode(['erro' => 'ID não encontrado!']);
    return;
}

if ($_SESSION['type_user'] != 1) {
    echo json_encode(['erro' => 'Usuário sem permissão para realizar esta ação!']);
    return;
}

$deleteUser = new DeleteUser($db);
$returned = $deleteUser->deleteUser($collaboratorId);

if ($returned['success']) {
    echo json_encode(['success' => 'Colaborador ID ' . $collaboratorId . ' deletado com sucesso!']);
    return;
}

echo json_encode(['erro' => 'Algo deu errado ao deletar!']);
return;