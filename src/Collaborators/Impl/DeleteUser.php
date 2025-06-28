<?php

declare(strict_types=1);

namespace App\Collaborators\Impl;

use App\Collaborators\DeleteUserInterface;
use App\Database\Impl\DB;
use App\Logs\Impl\ActivityLogger;
use PDO;

final class DeleteUser implements DeleteUserInterface
{
    private DB $db;
    private PDO $pdo;
    private ActivityLogger $logger;

    public function __construct(DB $db)
    {
        $this->db = $db;
        $this->pdo = $db->getPdo();
        $this->logger = new ActivityLogger($this->db, $this->pdo);
    }

    public function deleteUser(int $collaboratorId): ?array
    {
        $valid = $this->validateDelete($collaboratorId);

        if (! $valid) {
            return null;
        }

        try {
            $this->db->queryAndFetch("DELETE FROM users WHERE id = " . $collaboratorId);
            $this->logger->insertActivity('Colaborador ID ' . $collaboratorId, date('d-m-Y H:i'), 'deletado', $_SESSION['user_id']);
        } catch (\PDOException|\Exception $e) {
            return null;
        }

        return ['success' => 'deu boa'];
    }

    private function validateDelete($collaboratorId): bool
    {
        if ($_SESSION['type_user'] != 1) {
            return false;
        }

        if (! (int) $collaboratorId) {
            return false;
        }

        return true;
    }
}