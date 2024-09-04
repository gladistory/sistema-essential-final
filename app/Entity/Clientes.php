<?php

namespace App\Entity;

use App\DB\Database;
use PDO;

class Clientes
{
    public $id_cliente;
    public $nome;
    public $email;
    public $cpf;
    public $telefone;

    public function Cadastrar()
    {
        $obsDatabase = new Database('clientes');
        $this->id_cliente = $obsDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone
        ]);
        return true;
    }

    // Método que pega as vagas do banco de dados 
    public static function getClientes($where = null, $order = null, $limit = null)
    {
        return (new Database('clientes'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}