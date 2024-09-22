<?php

namespace App\Entity;

use App\DB\Database;

use PDO;

class itensPedido
{
    public $id;
    public $pedido_id;
    public $produto_id;
    public $quantidade;
    public $valor;


    public function cadastrarItens()
    {
        $obsDatabase = new Database('itens_pedido');
        $this->id = $obsDatabase->insert([
            'pedido_id' => $this->pedido_id,
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'valor' => $this->valor
        ]);
        return true;
    }

    // Método que pega os pedidos do banco de dados 
    public static function getItens($where = null, $order = null, $limit = null)
    {
        return (new Database('itens_pedido'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Pega a vaga pelo ID
    public static function getItemPedido($pedido_id)
    {
        return (new Database('itens_pedido'))->select('pedido_id = ' . $pedido_id)->fetchObject(self::class);
    }

    public function excluir()
    {
        return (new Database('itens_pedido'))->delete('id = ' . $this->id);
    }
}