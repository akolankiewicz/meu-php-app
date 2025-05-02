<?php

declare(strict_types=1);

namespace App\Impl;

use Exception;
use PDO;

class SearchPlayer
{
    /** @var DB  */
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function searchPlayer(string $search): ?array
    {
        try {
            return $this->db->queryAndFetch("select * from players where name like '%$search%'");
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao retornar a busca: ' . $e->getMessage());
        }
    }
}