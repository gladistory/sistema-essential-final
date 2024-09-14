<?php

require __DIR__ . '/vendor/autoload.php';

use App\DB\Database;

$obDB = new Database();
$connect = $obDB->setConnection();

if (isset($_POST["nome"])) {
    $busca = $_POST["nome"];
    $query = "SELECT nome FROM clientes WHERE nome LIKE '%" . $busca . "%' ORDER BY nome";
} else {
    $query = "SELECT nome FROM clientes ORDER BY nome";
}

$statement = $obDB->execute($query);
$result = $statement->fetchAll();
$rowCount = $statement->rowCount();

$suggestions = [];

if ($rowCount > 0) {
    foreach ($result as $row) {
        $suggestions[] = $row["nome"];  // Adiciona o nome ao array de sugestões
    }
}

// Retorna um array de nomes como JSON
echo json_encode($suggestions);