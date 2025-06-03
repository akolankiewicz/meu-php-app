<?php

use App\Impl\DB;
use App\Impl\Login;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$login = new Login($db);
try {
    if ($userData = $login->doLogin($_POST['email'], $_POST['senha'])) {
        session_start();
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['nome'];
        $_SESSION['type_user'] = $userData['type_user'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['auth'] = true;
        header('Location: ../index.php');
    }
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}



