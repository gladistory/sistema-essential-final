<?php

namespace App\Entity;

use App\DB\Database;

use PDO;

class novoPedido
{
    public $id;
    public $cliente_id;
    public $data_pedido;
    public $valorTotal;

    public function cadastrarPedido()
    {
        $this->data_pedido = date('Y-m-d H:m:s');
        $obsDatabase = new Database('pedidos');
        $this->id = $obsDatabase->insert([
            'cliente_id' => $this->cliente_id,
            'data_pedido' => $this->data_pedido,
            'valor_total' => $this->valorTotal
        ]);

        return $this->id; // Retorna o ID do pedido inserido
    }

    // Método que pega os pedidos do banco de dados 
    public static function getPedidos($where = null, $order = null, $limit = null)
    {
        return (new Database('pedidos'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Pega a vaga pelo ID
    public static function getPedido($id)
    {
        return (new Database('pedidos'))->select('id = ' . $id)->fetchObject(self::class);
    }

    public function excluir()
    {
        return (new Database('pedidos'))->delete('id = ' . $this->id);
    }
}