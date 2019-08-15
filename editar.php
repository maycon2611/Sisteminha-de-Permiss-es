<?php 
    session_start();
    require "config.php";
    require "Classes/Usuarios.php";

    if(!isset($_SESSION['logado'])) {
        header('Location: login.php');
        exit;
    }

    $usuarios = new Usuarios($pdo);
    $usuarios->setUsuarios($_SESSION['logado']);

    if(!$usuarios->verificarPermissao('EDIT')) {
        header('Location: index.php');
    }
?>

<h1>Editar</h1>