<?php
// Conexão com o banco de dados

namespace App\DB;

use PDO;
use PDOException;


class Database
{
    //Host de conexão com o DB
    const HOST = 'localhost';
    // Nome do banco de Dados
    const NAME = 'sistemalogin';
    const USER = 'root';
    const PASS = '';

    // nome da tabela a ser manipulada
    private $table;

    public $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    //método que cria conexão com banco de dados
    public function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            if (!$statement->execute($params)) {
                die('Erro na execução da query: ' . print_r($statement->errorInfo(), true));
            }
            return $statement;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->execute($query, array_values($values));
        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = null, $limit = null)
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        // Monta a Query
        $query = 'SELECT * FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        try {
            $result = $this->execute($query);
            return $result;
        } catch (PDOException $e) {
            die('Erro ao executar a query: ' . $e->getMessage());
        }
    }
}