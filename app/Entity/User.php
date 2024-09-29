<?php

namespace App\Entity;

use App\DB\Database;
use PDO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class User
{
    public $id;
    public $nome;
    public $email;
    public $cpf;
    public $nascimento;
    public $senha;
    public $erro;
    public $sucesso;
    public $imagem;

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
            $sem_foto = "./assets/images/icon-feather-user.svg";

            $foto_perfil = $user["imagem"];
            if ($foto_perfil == NULL) {
                $foto_perfil = $sem_foto;
                $_SESSION['foto_perfil'] = $foto_perfil;
            }
            $_SESSION['foto_perfil'] = $foto_perfil;
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


    public function RecuperarSenha($email)
    {
        $obsDatabase = new Database('usuarios');

        // Buscar o usuário pelo email usando o novo método selectOne
        $user = $obsDatabase->selectOne('email = :email', ['email' => $email]);

        if ($user) {
            // Gera um token único para redefinição de senha
            $token = bin2hex(random_bytes(50));

            // Atualizar o token de redefinição no banco de dados
            $updateToken = $obsDatabase->update('id = ' . $user['id'], ['reset_token' => $token]);

            // URL para redefinir a senha
            $resetLink = "http://localhost/sistema-essential-final/redefinir_senha.php?token=" . $token;

            $mail = new PHPMailer(true);
            try {
                //Configurações do servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'essentialfarmatec@gmail.com';  // Troque pelo seu e-mail
                $mail->Password = 'kcrx tsur kupj isaa'; // Use App Password do Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configurações do e-mail
                $mail->setFrom('essentialfarmatec@gmail.com', 'Essential Farma Tec');
                $mail->addAddress($email, $user['nome']); // Destinatário

                // Conteúdo do e-mail
                $mail->isHTML(true);
                $mail->Subject = 'Redefinir Senha';
                $mail->Body    = 'Clique no link para redefinir sua senha: <a href="' . $resetLink . '">Redefinir Senha</a>';

                $mail->send();
                $this->sucesso = "<div class='alert alert-success text-center' role='alert'>Email de recuperação enviado com sucesso!</div>";
            } catch (Exception $e) {
                $this->erro = "<div class='alert alert-danger text-center' role='alert'>Email não encontrado</div>";
            }
        } else {
            $this->erro = "<div class='alert alert-danger text-center' role='alert'>Email não encontrado</div>";
        }
    }

    public function FotoPerfil()
    {
        return (new Database('usuarios'))->update('id = ' . $this->id, [
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'nascimento' => $this->nascimento,
            'senha' => $this->senha,
            'imagem' => $this->imagem

        ]);
    }
}