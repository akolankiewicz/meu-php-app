<?php

declare(strict_types=1);

namespace App\Logs;

use App\Database\Impl\DB;
use PDO;

interface LoggerInterface {
    public function __construct(DB $db, PDO $pdo);

    public function getLogs(): array;
}




