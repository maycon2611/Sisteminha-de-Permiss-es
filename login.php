<?php 
    session_start();
    require "config.php";
    require "Classes/Usuarios.php";

    if(!empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = addslashes($_POST['email']);
        $senha = addslashes(md5($_POST['senha']));

        $usuarios = new Usuarios($pdo);

        if($usuarios->Login($email, $senha)) {
            header('Location: index.php');
        } else {
            echo "Usuário ou senha invalidos";
        }
    }

?>
<h1>Login</h1>
<hr>
<form method="POST">
    E-mail<br><br>
    <input type="email" name="email"><br><br>
    Senha<br><br>
    <input type="password" name="senha"><br><br>

    <input type="submit" value="entrar">
</form>