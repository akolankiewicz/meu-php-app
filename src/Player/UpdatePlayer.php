<?php

declare(strict_types=1);

namespace App\Player;

use App\Database\Impl\DB;
use App\Logs\Impl\ActivityLogger;
use Exception;
use PDO;

final class UpdatePlayer
{
    private DB $db;
    private PDO $pdo;
    private ActivityLogger $logger;

    public function __construct($db, $pdo)
    {
        $this->db = $db;
        $this->pdo = $pdo;
        $this->logger = new ActivityLogger($db, $pdo);
    }

    /**
     * @throws Exception
     */
    public function updatePlayer($id, $data): bool
    {
        $changes = $this->compareDatasAndReturnDifferences($data, $id);
        if ($changes['qtt'] == 0) {
            return true;
        }

        try {
            $this->pdo->query("UPDATE players SET " . $changes['fields'] . " WHERE id = " . $id);
            $this->logger->insertActivity('Jogador ' . $data['nome'], date('d-m-Y H:i'), 'editado', $_SESSION['user_id']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return true;
    }

    private function compareDatasAndReturnDifferences($data, $id): array
    {
        $actualData = $this->db->queryAndFetch("SELECT * FROM players WHERE id =" . $id)[0];
        $changes = [
            'qtt' => 0,
            'fields' => ''
        ];
        foreach ($data as $key => $value) {
            if ($value != $actualData[$key]) {
                $changes['qtt'] += 1;
                $changes['fields'] .= "$key = '$value', ";
            }
        }

        if ($changes['fields'] !== '') {
            $changes['fields'] = substr($changes['fields'], 0, -2);
        }

        return $changes;
    }
}