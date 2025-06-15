<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Impl\DB;
use App\Impl\RegisterUser;
use App\Impl\Login;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$dataUser = [
    "nome" => $_POST['nome'] ?? '',
    "email" => $_POST['email'] ?? '',
    "senha" => $_POST['senha'] ?? '',
    "telefone" => $_POST['telefone'] ?? '',
    "data_nascimento" => $_POST['data_nascimento'] ?? '',
    "cidade" => $_POST['cidade'] ?? '',
    "estado" => $_POST['estado'] ?? '',
    "endereco" => $_POST['endereco'] ?? '',
];

$register = new RegisterUser($db);
$login = new Login($db);

if ($register->validateFieldsToInsert($dataUser) === true) {
    try {
        $user = $register->registerAndReturnYourId($dataUser);
        $userData = $login->doLogin($dataUser['email'], $dataUser['senha']);

        if ($userData) {
            session_start();
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['nome'];
            $_SESSION['type_user'] = $userData['type_user'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['auth'] = true;

            header('Location: ../index.php');
        } else {
            throw new Exception("Erro ao autenticar após o cadastro.");
        }
    } catch (Exception $e) {
        header('Location: ../register-screen.php?error=' .  urlencode('Email já cadastrado'));
    }
} else {
    header('Location: ../register-screen.php?error=' . urlencode('Dados inválidos!'));
}
