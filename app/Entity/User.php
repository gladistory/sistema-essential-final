<?php

namespace App\Entity;

use App\DB\Database;
use PDO;


class User
{
    public $id;
    public $nome;
    public $email;
    public $cpf;
    public $nascimento;
    public $senha;
    public $erro;

    public function Cadastrar()
    {
        $obsDatabase = new Database('usuarios');

        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);

        $this->id = $obsDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'nascimento' => $this->nascimento,
            'senha' => $this->senha
        ]);

        return true;
    }

    public function Editar()
    {
        return (new Database('usuarios'))->update('id = ' . $this->id, [
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'nascimento' => $this->nascimento,
            'senha' => $this->senha

        ]);
    }

    public function Login($email, $senha)
    {
        $obsDatabase = new Database('usuarios');

        // Buscar o usuário pelo email usando o novo método selectOne
        $user = $obsDatabase->selectOne('email = :email', ['email' => $email]);

        // Verificar se o usuário foi encontrado e se a senha é válida
        if ($user && password_verify($senha, $user['senha'])) {
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['name'] = $user['nome'];
            header('Location: dashboard.php');
            exit;
        } else {
            $this->erro = "<div class='alert alert-danger text-center' role='alert'>Senha ou email incorreto</div>";
        }
    }

    public static function getUsers($where = null, $order = null, $limit = null)
    {
        return (new Database('usuarios'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Pega a vaga pelo ID
    public static function getUser($id)
    {
        return (new Database('usuarios'))->select('id = ' . $id)->fetchObject(self::class);
    }

    public function excluir()
    {
        return (new Database('usuarios'))->delete('id = ' . $this->id);
    }
}