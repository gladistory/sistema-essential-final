<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\User;

if (isset($_POST['btn-continuar'])) {
    $email = $_POST['email'];
    $senha =  sha1($_POST['senha']);
    $obUser = new User();
    $obUser->Login($email, $senha);
};
