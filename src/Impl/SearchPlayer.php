<?php

declare(strict_types=1);

namespace App\Impl;

use Exception;
use PDO;

class SearchPlayer
{
    /** @var DB  */
    private $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function searchPlayer(string $search): ?array
    {
        try {
            if (empty($search)) {
                return $this->db->queryAndFetch("select * from players order by nome asc");
            }
            return $this->db->queryAndFetch("select * from players where nome like '%$search%'");
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao retornar a busca: ' . $e->getMessage());
        }
    }
}