<?php

use App\Impl\DB;
use App\Impl\RegisterPlayer;

require_once __DIR__ . "/../../vendor/autoload.php";
$db = DB::getInstance();


$player_data = $_POST;
$imagem = $_FILES['imagem'] ?? null;

if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
    $caminhoDestino = __DIR__ . '/../img-players/' . uniqid() . '_' . basename($imagem['name']);
    if (move_uploaded_file($imagem['tmp_name'], $caminhoDestino)) {
        $caminhoRelativo = 'img-players/' . basename($caminhoDestino);
        $player_data['imagem'] = $caminhoRelativo;
    }
}

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
