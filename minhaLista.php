<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}

if (!empty($_SESSION["errosAoCriarItem"])) {
    echo "<ul>";
    foreach ($_SESSION["errosAoCriarItem"] as $erroAoCriarConta) {
        echo "<li>".$erroAoCriarConta."</li>";
    }
    echo "</ul>";
}

unset($_SESSION["errosAoCriarItem"]);

require_once __DIR__ . '/app/controller/Item/ItemGerarListaController.php';
$lista = new ItemGerarListaController();

$CSSAvisoListaVazia = "";
$CSSTabelaLista = "";

$htmlLista = $lista->gerarTabelaComALista();

if (!empty($htmlLista)) {
    $CSSAvisoListaVazia = "class='oculto'";
} else {
    $CSSTabelaLista = "class='oculto'";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>To Do List</title>

	<style>
		.oculto {
			display: none;
		}
	</style>
</head>

<body>
	<h1>Olá
		<?php echo $_SESSION["usuario"]["nome"]; ?>!
	</h1>
	<a href="index.php">Fazer logout</a>

	<h4>Aqui está a sua ToDoList:</h4>

	<h5 <?php echo $CSSAvisoListaVazia;?>>
		Puxa, nenhum item na sua lista!
	</h5>

	<form <?php echo $CSSTabelaLista;?> action="app/mudarStatus.php"
		method="post">
		<table border="1px">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php echo $htmlLista ?>
			</tbody>
		</table>
	</form>

	<form action="app/controller/Item/ItemCriarController.php" method="POST">
		<label for="itemnovo">Informe o novo item que deseja adicionar na sua lista:</label>
		<input type="text" name="itemnovo" id="itemnovo">
		<button type="submit">Adicionar!</button>
	</form>
</body>

</html>