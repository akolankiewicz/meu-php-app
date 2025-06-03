<?php

declare(strict_types=1);

namespace App\Impl;

use App\RegisterInterface;
use DateTime;
use Exception;

class RegisterUser implements RegisterInterface
{
    private DB $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function registerAndReturnYourId($userData): array
    {
        return $this->db->insertNewUserAndReturnYourId($userData);
    }

    public function validateFieldsToInsert($dataUser)
    {
        $errors = [];

        if (! preg_match('/^[a-zA-Z\s]+$/', $dataUser['nome'])) {
            $errors['nome'] = "O nome deve conter apenas letras e espa�os.";
        }

        if (strpos($dataUser['email'], '@') === false || strlen($dataUser['email']) < 10) {
            $errors['email'] = "O email deve conter '@' e ter no m�nimo 10 caracteres.";
        } elseif (! filter_var($dataUser['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "O formato do email � inv�lido.";
        }

        if (! ctype_digit($dataUser['telefone'])) {
            $errors['telefone'] = "O telefone deve conter apenas n�meros.";
        }

        $dataNascimentoObj = DateTime::createFromFormat('Y-m-d', $dataUser['data_nascimento']);
        if (! $dataNascimentoObj || $dataNascimentoObj->format('Y-m-d') !== $dataUser['data_nascimento']) {
            $errors['data_nascimento'] = "A data de nascimento deve ser uma data v�lida no formato YYYY-MM-DD.";
        }

        if (empty(trim($dataUser['cidade']))) {
            $errors['cidade'] = "A cidade n�o pode estar vazia.";
        }

        if (! preg_match('/^[A-Z]{2}$/', $dataUser['estado'])) {
            $errors['estado'] = "O estado deve ser uma sigla de 2 letras mai�sculas.";
        }

        if (strlen(trim($dataUser['endereco'])) < 5) {
            $errors['endereco'] = "O endere�o deve ter no m�nimo 5 caracteres.";
        }

        if (empty($errors)) {
            return true;
        }

        $stringErrors = '';
        foreach ($errors as $field => $message) {
            $stringErrors .= "- " . htmlspecialchars($message) . " | ";
        }
        return $stringErrors;
    }
}




