<?php

declare(strict_types=1);

namespace App\Collaborators;

use App\Database\Impl\DB;

interface GetUsersInterface
{
    public function __construct(DB $db);
    public function getUsersData(): ?array;
    public function getUsersDataById(int $id): ?array;
}