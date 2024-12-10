<?php

    $env = parse_ini_file(".env");

    $servidor = $env['SERVIDOR'];
    $dbname = $env['DBNAME'];
    $usuario = $env['USUARIO'];
    $senha = $env['SENHA'];

    try {
        $pdo = new PDO("$servidor; $dbname", $usuario, $senha);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    
?>


