<?php

use App\Impl\DB;
use App\Impl\RegisterUser;

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
if ($register->validateFieldsToInsert($dataUser) === true) {
    try {
        $loginIdAndName = $register->registerAndReturnYourId($dataUser);
    } catch (Exception $e) {
        throw new \Exception("Erro ao inserir os dados: " . $e->getMessage());
    }
    header('Location: ../action/action_set_user_data.php?id=' . $loginIdAndName['id'] . '&nome=' . $loginIdAndName['nome']);
} else {
    header('Location: ../register-screen.php?error=' . 'erro');
}