<?php

session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');

use App\Database\Impl\DB;
use App\Register\Impl\Login;
use App\Register\Impl\RegisterUser;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();
$pdo = $db->getPdo();

$dataUser = [
    "nome" => $_POST['nome'] ?? '',
    "email" => $_POST['email'] ?? '',
    "senha" => $_POST['senha'] ?? '',
    'type_user' => $_POST['nivel'] ?? '',
    "telefone" => $_POST['telefone'] ?? '',
    "data_nascimento" => $_POST['data_nascimento'] ?? '',
    "cidade" => $_POST['cidade'] ?? '',
    "estado" => $_POST['estado'] ?? '',
    "endereco" => $_POST['endereco'] ?? '',
];

$register = new RegisterUser($db);
$login = new Login($db);

$msg = 'Houve um erro ao tentar registrar o usuário no sistema!';

$stringErrors = $register->validateFieldsToInsert($dataUser);
if ($stringErrors === true) {
    try {
        $user = $register->registerAndReturnYourId($dataUser);
        header('Location: ../collaborators.php');
    } catch (PDOException $e) {
        if ($e->getCode() === '23505' || (isset($e->errorInfo[0]) && $e->errorInfo[0] === '23505')) {
            $msg = 'Este e-mail já está cadastrado no sistema. Por favor, utilize outro.';
        }

        header('Location: ../register-screen.php?msg=' . urlencode($msg));
        return;
    } catch (Exception $e) {
        if ($e->getMessage() === 'Erro ao autenticar após o cadastro.') {
            $msg = 'Erro ao autenticar após o cadastro.';
        }

        header('Location: ../register-screen.php?msg=' . urlencode($msg));
        return;
    }
} else {
    header('Location: ../register-screen.php?msg=' . urlencode($stringErrors));
}
