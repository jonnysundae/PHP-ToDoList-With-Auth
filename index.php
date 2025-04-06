<?php
session_start();
unset($_SESSION["usuario"]);

if (!empty($_SESSION["errosAoFazerLogin"])) {
    echo "<ul>";
    foreach ($_SESSION["errosAoFazerLogin"] as $erroAoFazerLogin) {
        echo "<li>".$erroAoFazerLogin."</li>";
    }
    echo "</ul>";
}

unset($_SESSION["errosAoFazerLogin"]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
</head>

<body>
    <h1>Faça login</h1>
    <form action="app/controller/Usuario/UsuarioLoginController.php" method="post">
        <fieldset>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email">
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
            <br>
            <button type="submit">Entrar</button>
        </fieldset>
    </form>
    <p>
        <a href="novaconta/criarconta.php">Criar uma conta</a>
    </p>
</body>

</html>