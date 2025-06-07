<?php

namespace App\Impl;
use http\Exception;
use PDO;
use PDOException;

final class DB {
    private static ?DB $instance = null;
    private PDO $pdo;

    private function __construct(){
        $db = 'pgsql:host=postgres;port=5432;dbname=db;';
        $user = 'admin';
        $password = 'admin';

        try {
            $this->pdo = new PDO($db, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function queryAndFetch(string $text): ?array
    {
        $query = $this->pdo->query($text);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @throws \Exception
     */
    public function insertNewUserAndReturnYourId(array $userData): array
    {
        $stmt = $this->pdo->prepare('
        INSERT INTO users (type_user, nome, senha, email, telefone, data_nascimento, cidade, estado, endereco)
        VALUES (:type_user, :nome, :senha, :email, :telefone, :data_nascimento, :cidade, :estado, :endereco)
        RETURNING id, nome
        ');

        $stmt->bindValue(':type_user', 2);
        $stmt->bindValue(':nome', $userData['nome']);
        $stmt->bindValue(':senha', password_hash($userData['senha'], PASSWORD_DEFAULT));
        $stmt->bindValue(':email', $userData['email']);
        $stmt->bindValue(':telefone', $userData['telefone']);
        $stmt->bindValue(':data_nascimento', $userData['data_nascimento']);
        $stmt->bindValue(':cidade', $userData['cidade']);
        $stmt->bindValue(':estado', $userData['estado']);
        $stmt->bindValue(':endereco', $userData['endereco']);

        if (! $stmt->execute()) {
            throw new \Exception("Erro ao inserir os dados");
        }

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return [
            'id' => $user['id'],
            'nome' => $user['nome']
        ];
    }


    /**
     * @throws \Exception
     */
    public function insertNewPlayerAndReturnYourIdName(array $userData): array
    {
        $nome = $userData['nome'];
        $posicao = $userData['posicao']; 
        $nacionalidade = $userData['nacionalidade'];
        $peso = $userData['peso'];
        $altura = $userData['altura'];
        $dataNascimento = $userData['dataNascimento'];
        $clube = $userData['clube'];
        $aceleracao = $userData['aceleracao'] ?? null;
        $pique = $userData['pique'] ?? null;
        $finalizacao = $userData['finalizacao'] ?? null;
        $forca_do_chute = $userData['forca_do_chute'] ?? null;
        $chute_de_longe = $userData['chute_de_longe'] ?? null;
        $penalti = $userData['penalti'] ?? null;
        $visao_de_jogo = $userData['visao_de_jogo'] ?? null;
        $cruzamento = $userData['cruzamento'] ?? null;
        $passe_curto = $userData['passe_curto'] ?? null;
        $passe_longo = $userData['passe_longo'] ?? null;
        $curva = $userData['curva'] ?? null;
        $agilidade = $userData['agilidade'] ?? null;
        $equilibrio = $userData['equilibrio'] ?? null;
        $reacao = $userData['reacao'] ?? null;
        $controle_de_bola = $userData['controle_de_bola'] ?? null;
        $drible = $userData['drible'] ?? null;
        $agressividade = $userData['agressividade'] ?? null;
        $interceptacao = $userData['interceptacao'] ?? null;
        $precisao_no_cabeceio = $userData['precisao_no_cabeceio'] ?? null;
        $nocao_defensiva = $userData['nocao_defensiva'] ?? null;
        $desarme = $userData['desarme'] ?? null;
        $carrinho = $userData['carrinho'] ?? null;
        $impulsao = $userData['impulsao'] ?? null;
        $folego = $userData['folego'] ?? null;
        $forca = $userData['forca'] ?? null;
        $imagem = $userData['imagem'] ?? null;
        
        $sql = "INSERT INTO players (
                    nome, posicao, nacionalidade, peso, altura, data_nascimento, clube,
                    aceleracao, pique, finalizacao, forca_do_chute, chute_de_longe, penalti,
                    visao_de_jogo, cruzamento, passe_curto, passe_longo, curva, agilidade,
                    equilibrio, reacao, controle_de_bola, drible, agressividade, interceptacao,
                    precisao_no_cabeceio, nocao_defensiva, desarme, carrinho, impulsao, folego,
                    forca, imagem
                ) VALUES (
                    :nome, :posicao, :nacionalidade, :peso, :altura, :dataNascimento, :clube,
                    :aceleracao, :pique, :finalizacao, :forca_do_chute, :chute_de_longe, :penalti,
                    :visao_de_jogo, :cruzamento, :passe_curto, :passe_longo, :curva, :agilidade,
                    :equilibrio, :reacao, :controle_de_bola, :drible, :agressividade, :interceptacao,
                    :precisao_no_cabeceio, :nocao_defensiva, :desarme, :carrinho, :impulsao, :folego,
                    :forca, :imagem
                )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':posicao', $posicao);
        $stmt->bindValue(':nacionalidade', $nacionalidade);
        $stmt->bindValue(':peso', $peso);
        $stmt->bindValue(':altura', $altura);
        $stmt->bindValue(':dataNascimento', $dataNascimento);
        $stmt->bindValue(':clube', $clube);
        $stmt->bindValue(':aceleracao', $aceleracao);
        $stmt->bindValue(':pique', $pique);
        $stmt->bindValue(':finalizacao', $finalizacao);
        $stmt->bindValue(':forca_do_chute', $forca_do_chute);
        $stmt->bindValue(':chute_de_longe', $chute_de_longe);
        $stmt->bindValue(':penalti', $penalti);
        $stmt->bindValue(':visao_de_jogo', $visao_de_jogo);
        $stmt->bindValue(':cruzamento', $cruzamento);
        $stmt->bindValue(':passe_curto', $passe_curto);
        $stmt->bindValue(':passe_longo', $passe_longo);
        $stmt->bindValue(':curva', $curva);
        $stmt->bindValue(':agilidade', $agilidade);
        $stmt->bindValue(':equilibrio', $equilibrio);
        $stmt->bindValue(':reacao', $reacao);
        $stmt->bindValue(':controle_de_bola', $controle_de_bola);
        $stmt->bindValue(':drible', $drible);
        $stmt->bindValue(':agressividade', $agressividade);
        $stmt->bindValue(':interceptacao', $interceptacao);
        $stmt->bindValue(':precisao_no_cabeceio', $precisao_no_cabeceio);
        $stmt->bindValue(':nocao_defensiva', $nocao_defensiva);
        $stmt->bindValue(':desarme', $desarme);
        $stmt->bindValue(':carrinho', $carrinho);
        $stmt->bindValue(':impulsao', $impulsao);
        $stmt->bindValue(':folego', $folego);
        $stmt->bindValue(':forca', $forca);
        $stmt->bindValue(':imagem', $imagem);
        $result = $stmt->execute();

        if (! $result) {
            throw new \Exception("Erro ao inserir os dados");
        }

        try {
            $id = $this->pdo->lastInsertId();
            $nome = $this->queryAndFetch("SELECT nome FROM players WHERE id = " . $id);

            return ['id' => $id, 'nome' => $nome];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['erro' => 'Erro ao inserir jogador no banco de dados: ' . $e->getMessage()];
        }
    }

    /**
     * @throws \Exception
     */
    public function deletePlayer($playerId): void
    {
        $sql = "DELETE FROM players WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $playerId);
        $result = $stmt->execute();
        if (! $result) {
            throw new \Exception("Erro ao deletar os dados");
        }
    }

    private function __clone() { }

    /**
     * @throws \Exception
     */
    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }
}