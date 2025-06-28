<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Collaborators\Impl\GetUser;
use App\Database\Impl\DB;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$id = $_GET['id'];
if ($id) {
    $getUser = new GetUser($db);
    $userData = $getUser->getUsersDataById($id);
} else {
    echo json_encode(['erro' => 'Erro ao buscar dados']);
    return;
}

echo json_encode($userData);
return;