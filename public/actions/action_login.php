<?php

use App\Database\Impl\DB;
use App\Register\Login;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$login = new Login($db);
try {
    $userData = $login->doLogin($_POST['email'], $_POST['senha']);

    if ($userData['erro']) {
        header('Location: ../login-screen.html?msg=' . urlencode($userData['erro']));
        return;
    }

    if ($userData && ! isset($userData['erro'])) {
        session_start();
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['nome'];
        $_SESSION['type_user'] = $userData['type_user'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['auth'] = true;
        header('Location: ../index.php');
    } else {
        header('Location: ../login-screen.html?msg=' . urlencode('Opss... Usuário não encontrado!'));
    }
} catch (Exception $e) {
    header('Location: ../login-screen.html?msg=' . urlencode($e->getMessage()));
}



