<?php

require __DIR__ . '/vendor/autoload.php';

use App\DB\Database;
use App\Entity\Produtos;

$obDB = new Database();
$connect = $obDB->setConnection();

if (isset($_POST["nome"])) {
    $busca = $_POST["nome"];
    $query = "SELECT id_produto, nome FROM produtos WHERE nome LIKE :nome ORDER BY nome";
    $statement = $obDB->execute($query, ['nome' => '%' . $busca . '%']);
} else {
    $query = "SELECT id_produto, nome FROM produtos ORDER BY nome";
    $statement = $obDB->execute($query);
}

$result = $statement->fetchAll();
$rowCount = $statement->rowCount();

$suggestions = [];

if ($rowCount > 0) {
    foreach ($result as $row) {
        $suggestions[] = [
            'id' => $row['id_produto'],  // Inclui o ID do produto
            'value' => $row['nome']  // 'value' é usado pelo autocomplete para exibir o nome
        ];
    }
}

// Retorna um array de nomes como JSON
echo json_encode($suggestions);