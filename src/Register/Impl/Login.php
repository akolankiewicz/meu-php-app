<?php

declare(strict_types=1);

namespace App\Register\Impl;

use App\Database\Impl\DB;
use Exception;

final class Login
{
    private DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function doLogin(string $email, string $password): ?array
    {
        $userData = $this->verifyIfExistsEmail($email)[0];
        if (! $userData) {
            return null;
        }

        if (password_verify($password, $userData['senha'])) {
            return $userData;
        } else {
            return ['erro' => 'Senha incorreta!'];
        }
    }

    private function verifyIfExistsEmail(string $email): ?array
    {
        return $this->db->queryAndFetch("SELECT id, nome, email, senha, type_user FROM users WHERE email = '" . $email . "'" );
    }
}