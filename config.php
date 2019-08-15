<?php 
    $dsn = "mysql:dbname=projeto_permissoes; host=localhost";
    $dbuser = "root";
    $dbpass = "";

    try {
        $pdo = new PDO($dsn, $dbuser, $dbpass);
    } catch(PDOException $e) {
        die($e->getMessage());
    }
?>