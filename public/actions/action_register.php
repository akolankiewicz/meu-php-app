<?php

use App\Database\Impl\DB;
use App\Register\Impl\RegisterUser;
use App\Register\Login;

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

$msg = 'Houve um erro ao tentar registrar seu usuário no sistema!';

$stringErrors = $register->validateFieldsToInsert($dataUser);
if ($stringErrors === true) {
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
    } catch (PDOException $e) {
        if ($e->getCode() === '23505' || (isset($e->errorInfo[0]) && $e->errorInfo[0] === '23505')) {
            $msg = 'Este e-mail já está cadastrado no sistema. Por favor, utilize outro.';
        }

        header('Location: ../register-screen.html?msg=' . urlencode($msg));
        return;
    } catch (Exception $e) {
        if ($e->getMessage() === 'Erro ao autenticar após o cadastro.') {
            $msg = 'Erro ao autenticar após o cadastro.';
        }

        header('Location: ../register-screen.html?msg=' . urlencode($msg));
        return;
    }
} else {
    header('Location: ../register-screen.html?msg=' . urlencode($stringErrors));
}
