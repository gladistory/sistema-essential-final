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

    public function Cadastrar()
    {
        $obsDatabase = new Database('usuarios');
        $this->senha = sha1($this->senha);
        $this->id = $obsDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'nascimento' => $this->nascimento,
            'senha' => $this->senha
        ]);
        return true;
    }

    public function Login($email = null, $senha = null)
    {
        $obsDatabase = new Database('usuarios');

        // Verificar se email e senha foram fornecidos
        if (empty($email) || empty($senha)) {
            echo "Email e senha precisam ser preenchidos";
            return false;
        }

        // Buscar o usuário pelo email
        $result = $obsDatabase->select("email = '$email'");
        $user = $result->fetch(PDO::FETCH_ASSOC);

        // Verificar se o usuário foi encontrado e se a senha é válida
        if ($user && sha1($senha, $user['senha'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['name'] = $user['nome'];
            header('Location: dashboard.php');
            exit;
        } else {
            // Usuário ou senha incorretos
            return false;
        }
    }
}