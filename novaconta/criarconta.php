<?php
session_start();
unset($_SESSION["usuario"]);

if (!empty($_SESSION["errosAoCriarConta"])) {
    echo "<ul>";
    foreach ($_SESSION["errosAoCriarConta"] as $erroAoCriarConta) {
        echo "<li>".$erroAoCriarConta."</li>";
    }
    echo "</ul>";
}

unset($_SESSION["errosAoCriarConta"]);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>To Do List</title>
</head>

<body>
	<h1>Criar uma conta</h1>
	<form action="../app/controller/Usuario/UsuarioCadastroController.php" method="post">
		<fieldset>
			<label for="email">Nome:</label>
			<input type="text" name="nome" id="nome">
			<br>
			<label for="email">E-mail:</label>
			<input type="email" name="email" id="email">
			<br>
			<label for="senha">Senha:</label>
			<input type="password" name="senha" id="senha">
			<br>
			<label for="senha">Confirmar senha:</label>
			<input type="password" name="confirmarsenha" id="confirmarsenha">
			<br>
			<button type="submit">Criar conta!</button>
		</fieldset>
	</form>
	<p>
		<a href="../index.php">Voltar e fazer login</a>
	</p>
</body>

</html>