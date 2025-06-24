<?php

namespace App\Database\Impl;

use Exception;
use PDO;

class DeletePlayer
{
    /** @var DB  */
    private DB $db;

    /** @var PDO  */
    private PDO $pdo;

    public function __construct(DB $db, PDO $pdo)
    {
        $this->db = $db;
        $this->pdo = $pdo;
    }

    /**
     * @throws Exception
     */
    public function deletePlayer($playerId, $userData): ?bool
    {
        $this->validateToDeletePlayer($playerId, $userData);
        $this->db->deletePlayer($playerId);

        return true;
    }

    /**
     * @throws Exception
     */
    private function validateToDeletePlayer($playerId, $userData)
    {
        if (empty($playerId)) {
            throw new Exception('Preencha o ID do jogador!');
        }

        if (empty($userData)) {
            throw new Exception('Você não tem permissão para deletar jogadores!');
        }
    }
}