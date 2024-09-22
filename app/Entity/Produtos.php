<?php

namespace App\Entity;

use App\DB\Database;
use PDO;

class Produtos
{
    public $id_produto;
    public $nome;
    public $quantidade;
    public $valor;
    public $imagem;
    public $descricao;

    public function Cadastrar()
    {
        $obsDatabase = new Database('produtos');
        $this->id_produto = $obsDatabase->insert([
            'nome' => $this->nome,
            'quantidade' => $this->quantidade,
            'valor' => $this->valor,
            'imagem' => $this->imagem,
            'descricao' => $this->descricao
        ]);
        return true;
    }

    // Método para editar Produto

    public function Editar()
    {
        return (new Database('produtos'))->update('id_produto = ' . $this->id_produto, [
            'nome' => $this->nome,
            'quantidade' => $this->quantidade,
            'valor' => $this->valor,
            'imagem' => $this->imagem,
            'descricao' => $this->descricao,
        ]);
    }

    // Método que pega os produtos do banco de dados 
    public static function getProdutos($where = null, $order = null, $limit = null)
    {
        return (new Database('produtos'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Pega a vaga pelo ID
    public static function getProduto($id_produto)
    {
        return (new Database('produtos'))->select('id_produto = ' . $id_produto)->fetchObject(self::class);
    }

    public function excluir()
    {
        return (new Database('produtos'))->delete('id_produto = ' . $this->id_produto);
    }
}
