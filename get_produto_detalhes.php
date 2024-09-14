<?php

require __DIR__ . '/vendor/autoload.php';

use App\DB\Database;

$obDB = new Database();
$connect = $obDB->setConnection();

if (isset($_POST['id_produto'])) {
    $id_produto = $_POST['id_produto'];

    // Busca os detalhes do produto com base no ID
    $query = "SELECT valor FROM produtos WHERE id_produto = :id_produto";
    $statement = $obDB->execute($query, ['id_produto' => $id_produto]);
    $produto = $statement->fetch();

    // Retorna os detalhes do produto em JSON
    if ($produto) {
        echo json_encode($produto);
    } else {
        echo json_encode(['error' => 'Produto não encontrado']);
    }
}