<?php

use App\Database\Impl\DB;
use App\Logs\Impl\ActivityLogger;

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$logger = new ActivityLogger($db, $pdo);
try {
    $logs = $logger->getLogs();
} catch (PDOException $e) {
    throw new PDOException('Erro ao obter logs: ' . $e->getMessage());
}

echo json_encode($logs);
