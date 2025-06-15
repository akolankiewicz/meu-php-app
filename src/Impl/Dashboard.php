<?php

declare(strict_types=1);

namespace App\Impl;

final class Dashboard {
    private DB $db;
    private array $players;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function getCardsData(): array
    {
        $totalPlayers = $this->db->queryAndFetch("SELECT count(*) FROM players")[0]['count'];
        $totalColaborators = 123;
        $totalPlanosDeTreino = 15;

        return [
            'totalJogadores' => $totalPlayers,
            'totalColaboradores' => $totalColaborators,
            'totalPlanosDeTreino' => $totalPlanosDeTreino];
    }

    public function getPizzaChartData(): array
    {
        $ATA = 0;
        $MEI = 0;
        $ZAG = 0;
        $GOL = 0;

        $this->players = $this->db->queryAndFetch("SELECT * FROM players");
        foreach ($this->players as $player) {
            if ($player['posicao'] == 'ATA') {
                $ATA++;
            } elseif ($player['posicao'] == 'MEI') {
                $MEI++;
            } elseif ($player['posicao'] == 'ZAG') {
                $ZAG++;
            } elseif ($player['posicao'] == 'GOL') {
                $GOL++;
            }
        }

        return [
            'totalATA' => $ATA,
            'totalMEI' => $MEI,
            'totalZAG' => $ZAG,
            'totalGOL' => $GOL,
        ];
    }

    public function getBarChartData(): array
    {
        $nationalities = [];
        foreach ($this->players as $player) {
            if (! isset($nationalities[$player['nacionalidade']])) {
                $nationalities[$player['nacionalidade']] = 1;
                continue;
            }
            $nationalities[$player['nacionalidade']] += 1;
        }

        return $nationalities;
    }

    public function getActivityData(): array
    {
        return $this->db->queryAndFetch("
            SELECT DISTINCT ON (tipo) *
            FROM atividade
            WHERE tipo IN ('cadastrado', 'deletado', 'colaborador')
            ORDER BY tipo, id DESC;
        ");
    }
}




