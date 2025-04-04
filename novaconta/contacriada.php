<?php
    session_start();
    unset($_SESSION["usuario"]);
    if($_SESSION["contaCriada"]){
        $_SESSION["contaCriada"] = false;
    }else{
        header("Location: criarconta.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
</head>
<body>
    <h1>Conta Criada!</h1>
    <p>
        <a href="../index.php">Ir fazer login</a>
    </p>
</body>
</html>
