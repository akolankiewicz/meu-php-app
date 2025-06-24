<?php

declare(strict_types=1);

namespace App\Logs\Impl;

use App\Database\Impl\DB;
use PDO;

final class ActivityLogger extends Logger
{
    public function __construct(DB $db, PDO $pdo)
    {
        parent::__construct($db, $pdo);
    }

    public function insertActivity($name, $date, $type, $operator)
    {
        $sql = "INSERT INTO atividade (nome, data, tipo, operador) VALUES (:name, :date, :type, :operator)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':operator', $operator);
        $result = $stmt->execute();

        if (! $result) {
            throw new \Exception("Erro ao inserir os dados");
        }
    }
}