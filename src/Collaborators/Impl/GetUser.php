<?php

declare(strict_types=1);

namespace App\Collaborators\Impl;

use App\Collaborators\GetUsersInterface;
use App\Database\Impl\DB;

final class GetUser implements GetUsersInterface
{
    private DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getUsersData(): ?array
    {
        return $this->db->queryAndFetch("SELECT * FROM users");
    }

    public function getUsersDataById(int $id): ?array
    {
        return $this->db->queryAndFetch("SELECT * FROM users WHERE id =" . $id)[0];
    }
}