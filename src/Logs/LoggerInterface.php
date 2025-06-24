<?php

declare(strict_types=1);

namespace App\Logs;

use App\Database\Impl\DB;

interface LoggerInterface {
    public function __construct(DB $db);

    public function getLogs(): array;
}




