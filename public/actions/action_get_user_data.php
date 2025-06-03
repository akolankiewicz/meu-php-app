<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

require_once __DIR__ . "/../../vendor/autoload.php";

$data = [
    'id' => $_SESSION['user_id'],
    'nome' => $_SESSION['user_name'],
    'type_user' => $_SESSION['type_user'],
];

header('Content-Type: application/json');
echo json_encode($data);

