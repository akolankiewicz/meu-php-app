<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Collaborators\Impl\GetUser;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$getUser = new GetUser($db);

$data = $getUser->getUsersData();

header('Content-Type: application/json');
echo json_encode($data);
return;

