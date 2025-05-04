<?php

declare(strict_types=1);

namespace App\Impl;

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
            throw new Exception('Email inexistente, verifique se escreveu corretamente ou faça seu cadastro!');
        }

        if (password_verify($password, $userData['senha'])) {
            return $userData;
        } else {
            header('Location: login-screen.html');
            return null;
        }
    }

    private function verifyIfExistsEmail(string $email): ?array
    {
        return $this->db->queryAndFetch("SELECT id, nome, email, senha FROM users WHERE email = '" . $email . "'" );
    }
}