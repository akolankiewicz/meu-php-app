<?php

declare(strict_types=1);

namespace App\Collaborators\Impl;

use App\Database\Impl\DB;
use App\Logs\Impl\ActivityLogger;
use Exception;
use PDO;

final class UpdateUser
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

    /**
     * @throws Exception
     */
    public function updateUser($data): ?array
    {
        if (empty($data)) {
            return ['erro' => 'Dados do usuário não preenchidos'];
        }

        $changes = $this->compareDatasAndReturnDifferences($data, $data['id']);

        if ($changes['qtt'] == 0) {
            return ['success' => 'Não houve alterações'];
        }

        try {
            $this->pdo->query("UPDATE users SET " . $changes['fields'] . " WHERE id = " . $data['id']);
            $this->logger->insertActivity('Colaborador ' . $data['nome'], date('d-m-Y H:i'), 'editado', $_SESSION['user_id']);
            return ['success' => 'Colaborador editado com sucesso'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function compareDatasAndReturnDifferences($data, $id): array
    {
        $actualData = $this->db->queryAndFetch("SELECT * FROM users WHERE id =" . $id)[0];

        $submittedPassword = $data['senha'];
        $currentHash = $actualData['senha'];
        if ($submittedPassword !== $currentHash && ! password_verify($submittedPassword, $currentHash)) {
            $changes['senha'] = password_hash($submittedPassword, PASSWORD_DEFAULT);
        }

        $changes = [
            'fields' => '',
            'qtt' => 0
        ];

        foreach ($data as $key => $value) {
            if ($key === 'senha' || $key === 'id') {
                continue;
            }

            if ($value != $actualData[$key]) {
                $changes['fields'] .= "$key = '$value', ";
                $changes['qtt'] += 1;
            }
        }

        if ($changes['fields'] !== '') {
            $changes['fields'] = substr($changes['fields'], 0, -2);
        }

        return $changes;
    }
}