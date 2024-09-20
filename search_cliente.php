<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\DB\Database;



$obDB = new Database();
$connect = $obDB->setConnection();

if (isset($_POST["nome"])) {
    $busca = $_POST["nome"];
    $query = "SELECT nome, id_cliente FROM clientes WHERE nome LIKE '%" . $busca . "%' ORDER BY nome";
} else {
    $query = "SELECT nome, id_cliente FROM clientes ORDER BY nome";
}

$statement = $obDB->execute($query);
$result = $statement->fetchAll();
$rowCount = $statement->rowCount();

$suggestions = [];

if ($rowCount > 0) {
    foreach ($result as $row) {
        $suggestions[] = [
            'id' => $row['id_cliente'],  // Inclui o ID do produto
            'value' => $row['nome']  // 'value' é usado pelo autocomplete para exibir o nome
        ];
    }
}

// Retorna um array de nomes como JSON
echo json_encode($suggestions);