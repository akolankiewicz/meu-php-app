<?php

declare(strict_types=1);

namespace App\Logs\Impl;

use App\Database\Impl\DB;
use App\Logs\LoggerInterface;

abstract class Logger implements LoggerInterface
{
    private DB $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getLogs(): array
    {
        return $this->db->queryAndFetch("SELECT * FROM atividade");
    }
}