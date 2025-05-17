<?php

declare(strict_types=1);

namespace App\Impl;

use DateTime;
use Exception;
use PDO;

final class SearchPlayer
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
    public function searchPlayer(string $search): ?array
    {
        try {
            if (empty($search)) {
                return $this->db->queryAndFetch("select * from players order by id desc");
            }
            return $this->db->queryAndFetch("select * from players where nome like '%$search%'");
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao retornar a busca: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function searchPlayerByNamePositionClub($name, $position, $club): ?array
    {
        try {
            $conditions = [];

            if (! empty($name)) {
                $conditions[] = "nome LIKE '%" . $name . "%'";
            }

            if (! empty($position) && $position !== 'POS') {
                $conditions[] = "posicao = '" . $position . "'";
            }

            if (! empty($club)) {
                $conditions[] = "clube LIKE '%" . $club . "%'";
            }

            $sql = "SELECT * FROM players";

            if (! empty($conditions)) {
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }

            return $this->db->queryAndFetch($sql);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao retornar a busca: ' . $e->getMessage());
        }
    }

    public function buildAdvancedFilterQuery($filters): array
    {
        $whereClauses = [];
        $params = [];

        if (! empty($filters['nome'])) {
            $whereClauses[] = "nome LIKE :nome";
            $params[':nome'] = "%" . $filters['nome'] . "%";
        }

        if (! empty($filters['posicao'])) {
            $whereClauses[] = "posicao = :posicao";
            $params[':posicao'] = $filters['posicao'];
        }

        if (! empty($filters['peso'])) {
            $whereClauses[] = "peso = :peso";
            $params[':peso'] = $filters['peso'];
        }

        if (! empty($filters['altura'])) {
            $whereClauses[] = "altura = :altura";
            $params[':altura'] = $filters['altura'];
        }

        if (! empty($filters['idade'])) {
            $idade_alvo = intval($filters['idade']);
            $whereClauses[] = "EXTRACT(YEAR FROM AGE(CURRENT_DATE, data_nascimento)) = :idade";
            $params[':idade'] = $idade_alvo;
        }

        if (! empty($filters['data_nascimento'])) {
            $whereClauses[] = "data_nascimento = :data_nascimento";
            $params[':data_nascimento'] = $this->dateInFormatToDateInDatabaseFormat($filters['data_nascimento']);
        }

        if (! empty($filters['clube'])) {
            $whereClauses[] = "clube LIKE :clube";
            $params[':clube'] = "%" . $filters['clube'] . "%";
        }

        if (! empty($filters['nacionalidade'])) {
            $whereClauses[] = "nacionalidade LIKE :nacionalidade";
            $params[':nacionalidade'] = "%" . $filters['nacionalidade'] . "%";
        }

        $attributes = [
            "aceleracao", "pique", "finalizacao", "forca_do_chute", "chute_de_longe", "penalti",
            "visao_de_jogo", "cruzamento", "passe_curto", "passe_longo", "curva", "agilidade",
            "equilibrio", "reacao", "controle_de_bola", "drible", "agressividade", "interceptacao",
            "precisao_no_cabeceio", "nocao_defensiva", "desarme", "carrinho", "impulsao", "folego", "forca"
        ];

        foreach ($attributes as $attribute) {
            $operatorKey = "filter_" . $attribute . "_operator";
            $valueKey = "filter_" . $attribute . "_value";

            if (isset($filters[$operatorKey]) && isset($filters[$valueKey]) && $filters[$valueKey] !== '') {
                $operator = $filters[$operatorKey];
                $value = $filters[$valueKey];

                switch ($operator) {
                    case 'eq':
                        $whereClauses[] = "$attribute = :$attribute";
                        $params[":$attribute"] = $value;
                        break;
                    case 'gt':
                        $whereClauses[] = "$attribute > :$attribute";
                        $params[":$attribute"] = $value;
                        break;
                    case 'lt':
                        $whereClauses[] = "$attribute < :$attribute";
                        $params[":$attribute"] = $value;
                        break;
                    case 'gte':
                        $whereClauses[] = "$attribute >= :$attribute";
                        $params[":$attribute"] = $value;
                        break;
                    case 'lte':
                        $whereClauses[] = "$attribute <= :$attribute";
                        $params[":$attribute"] = $value;
                        break;
                }
            }
        }

        $sql = "SELECT * FROM players";
        if (! empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        return [$sql, $params];
    }

    public function prepareAndExecuteQuery($sql, $params): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @throws Exception
     */
    private function dateInFormatToDateInDatabaseFormat($date): string
    {
        $data_objeto = DateTime::createFromFormat('d/m/Y', $date);

        if ($data_objeto) {
            return $data_objeto->format('Y-m-d');
        } else {
            throw new Exception("Formato de data inválido: " . $date);
        }
    }

    public function searchPlayerById(int $id): array
    {
        $sql = "SELECT * FROM players WHERE id = $id";
        return $this->db->queryAndFetch($sql);
    }
}