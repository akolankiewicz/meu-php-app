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
        $stmt = $this->pdo->prepare('INSERT INTO users (type_user, nome, senha, email, telefone, data_nascimento, cidade, 
            estado, endereco) VALUES(:type_user, :nome, :senha, :email, :telefone, :data_nascimento, :cidade, :estado, :endereco)');
        $stmt->bindValue(':type_user', 2);
        $stmt->bindValue(':nome', $userData['nome']);
        $stmt->bindValue(':senha', password_hash($userData['senha'], PASSWORD_DEFAULT));
        $stmt->bindValue(':email',$userData['email']);
        $stmt->bindValue(':telefone', $userData['telefone']);
        $stmt->bindValue(':data_nascimento', $userData['data_nascimento']);
        $stmt->bindValue(':cidade', $userData['cidade']);
        $stmt->bindValue(':estado', $userData['estado']);
        $stmt->bindValue(':endereco', $userData['endereco']);
        $result = $stmt->execute();

        if (! $result) {
            throw new \Exception("Erro ao inserir os dados");
        }

        $id = $this->queryAndFetch("SELECT currval('users_id_seq');")['currval'];
        $nome = $this->queryAndFetch("SELECT nome FROM users WHERE id = " . $id);

        return [
        'id' => $id,
        'nome' => $nome['nome'],
    ];
    }

    private function __clone() { }

    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }
}