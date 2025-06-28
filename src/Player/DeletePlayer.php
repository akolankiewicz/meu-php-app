<?php

namespace App\Player;

use App\Database\Impl\DB;
use App\Logs\Impl\ActivityLogger;
use Exception;
use PDO;

class DeletePlayer
{
    /** @var DB  */
    private DB $db;

    /** @var PDO  */
    private PDO $pdo;
    private ActivityLogger $logger;

    public function __construct(DB $db, PDO $pdo)
    {
        $this->db = $db;
        $this->pdo = $pdo;
        $this->logger = new ActivityLogger($db,  $pdo);
    }

    /**
     * @throws Exception
     */
    public function deletePlayer($playerId, $userData): ?bool
    {
        $this->validateToDeletePlayer($playerId, $userData);
        $player = $this->db->queryAndFetch("SELECT nome, imagem FROM players WHERE id = " . $playerId)[0];
        $status = $this->db->deletePlayer($playerId);

        if (! $status) {
            throw new Exception("Erro ao deletar os dados");
        }

        if ($player['imagem'] && file_exists('/opt/project/public/' . $player['imagem'])) {
            unlink('/opt/project/public/' . $player['imagem']);
        }

        $this->logger->insertActivity('Jogador ' . $player['nome'], date('d-m-Y H:i'), 'deletado', $_SESSION['user_id']);

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