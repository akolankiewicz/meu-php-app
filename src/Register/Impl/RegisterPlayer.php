<?php

declare(strict_types=1);

namespace App\Register\Impl;

use App\Database\Impl\DB;
use App\Register\RegisterInterface;
use DateTime;
use Exception;

class RegisterPlayer implements RegisterInterface
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
        return $this->db->insertNewPlayerAndReturnYourIdName($userData);
    }

    public function validateFieldsToInsert($dataUser)
    {
        if ($dataUser === null) {
            http_response_code(400);
            return ['erro' => 'Erro ao decodificar JSON: Dados inv�lidos.'];
        }
        
        $erros = [];
        if (empty($dataUser['nome'])) {
            $erros['nome'] = 'O nome do jogador � obrigat�rio.';
        }
        if (empty($dataUser['posicao'])) {
            $erros['posicao'] = 'A posi��o do jogador � obrigat�ria.';
        }
        if (empty($dataUser['nacionalidade'])) {
            $erros['nacionalidade'] = 'A nacionalidade do jogador � obrigat�ria.';
        }
        if (empty($dataUser['peso'])) {
            $erros['peso'] = 'O peso do jogador � obrigat�rio.';
        }
        if (empty($dataUser['altura'])) {
            $erros['altura'] = 'A altura do jogador � obrigat�ria.';
        }
        if (empty($dataUser['dataNascimento'])) {
            $erros['dataNascimento'] = 'A data de nascimento do jogador � obrigat�ria.';
        }
        if (empty($dataUser['clube'])) {
            $erros['clube'] = 'O clube do jogador � obrigat�rio.';
        }

        if (empty($erros)) {
            return true;
        }

        $stringErrors = '';
        foreach ($erros as $field => $message) {
            $stringErrors .= "- " . htmlspecialchars($message) . " | ";
        }
        return $stringErrors;
    }

    public function dateInFormatToDateInDatabaseFormat($date): string
    {
        $data_objeto = DateTime::createFromFormat('d/m/Y', $date);

        if ($data_objeto) {
            return $data_objeto->format('Y-m-d');
        } else {
            throw new Exception("Formato de data inv�lido: " . $date);
        }
    }
}




