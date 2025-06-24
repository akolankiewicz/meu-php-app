<?php

declare(strict_types=1);

namespace App\Register;

use App\Database\Impl\DB;

interface RegisterInterface {
    public function __construct(DB $db);

    public function registerAndReturnYourId($userData): array;

    public function validateFieldsToInsert($dataUser);
}




