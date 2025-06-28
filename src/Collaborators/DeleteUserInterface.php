<?php

declare(strict_types=1);

namespace App\Collaborators;

use App\Database\Impl\DB;

interface DeleteUserInterface
{
    public function __construct(DB $db);
    public function deleteUser(int $collaboratorId): ?array;
}