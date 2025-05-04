<?php

use App\Impl\DB;
use App\Impl\RegisterPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();

$json_data = file_get_contents("php://input");
$player_data = json_decode($json_data, true);

$register = new RegisterPlayer($db);
try {
    if ($register->validateFieldsToInsert($player_data)) {
        $player_data['data_nascimento'] = $register->dateInFormatToDateInDatabaseFormat($player_data['dataNascimento']);
        $playerData = $register->registerAndReturnYourId($player_data);
    } else {
        echo json_encode(['erro' => 'Erro ao inserir jogador!']);
        return;
    }
} catch (Exception $e) {
    echo json_encode(['erro' => 'Erro ao inserir jogador: ' . $e->getMessage()]);
    return;
}

if (isset($playerData['erro'])) {
    echo json_encode(['erro' => $playerData['erro']]);
    return;
}

$id = $playerData['id'];
$nome = $playerData['nome'][0];

echo json_encode(['id' => $id, 'nome' => $nome]);
return;
