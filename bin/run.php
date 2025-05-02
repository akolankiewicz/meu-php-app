<?php

require __DIR__ . '/vendor/autoload.php';

use App\Impl\Example;
$example = new Example();

$name = $argv[1] ?? 'mundo via console';

$message = $example->greet($name);

echo $message . "\n";
echo 'Script executado viaCLI em' . date('Y-m-d H:i:s') . "\n";