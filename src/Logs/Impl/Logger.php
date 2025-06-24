<?php

declare(strict_types=1);

namespace App\Logs\Impl;

use App\Database\Impl\DB;
use App\Logs\LoggerInterface;
use PDO;

abstract class Logger implements LoggerInterface
{
    private DB $db;
    /**
     * @var mixed
     */
    protected $pdo;

    public function __construct(DB $db, PDO $pdo)
    {
        $this->db = $db;
        $this->pdo = $pdo;
    }

    public function getLogs(): array
    {
        return $this->db->queryAndFetch("SELECT * FROM atividade");
    }
}