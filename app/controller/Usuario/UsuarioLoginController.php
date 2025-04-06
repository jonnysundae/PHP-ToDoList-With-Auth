<?php

session_start();

require_once __DIR__ . '/../../service/UsuarioService.php';
require_once __DIR__ . '/../../model/Usuario.php';
require_once __DIR__ . '/../../exceptions/CamposObrigatoriosNaoPreenchidosException.php';

$service = new UsuarioService;

try {
    if (isset($_POST['email']) || isset($_POST['senha'])) {
        $usuario = $service->autenticar($_POST['email'], $_POST['senha']);

        $_SESSION["usuario"]["id"] = $usuario->getId();
        $_SESSION["usuario"]["nome"] = $usuario->getNome();
        $_SESSION["usuario"]["email"] = $usuario->getEmail();
        header("Location: ../../../minhaLista.php");
    } else {
        throw new CamposObrigatoriosNaoPreenchidosException();
    }
} catch (EmailNaoEncontradoException | SenhaIncorretaException | CamposObrigatoriosNaoPreenchidosException $e) {
    $_SESSION["errosAoFazerLogin"][] = $e->getMessage();
    header("Location: ../../../index.php");
}
