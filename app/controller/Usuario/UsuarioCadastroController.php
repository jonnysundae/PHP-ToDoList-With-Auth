<?php

session_start();

require_once __DIR__ . '/../../service/UsuarioService.php';
require_once __DIR__ . '/../../model/Usuario.php';
require_once __DIR__ . '/../../exceptions/CamposObrigatoriosNaoPreenchidosException.php';
require_once __DIR__ . '/../../exceptions/EmailJaCadastradoException.php';
require_once __DIR__ . '/../../exceptions/SenhaDiferenteAoCadastrarException.php';

$service = new UsuarioService;

function verificarSeSenhaEstaDiferente($senha, $confirmarSenha)
{
    if ($senha != $confirmarSenha) {
        throw new SenhaDiferenteAoCadastrarException();
    }
}

function verificarSeTodosCamposObrigadoriosEstaoPreenchidos()
{
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmarsenha'])) {
        throw new CamposObrigatoriosNaoPreenchidosException();
    }
}

try {

    $usuario = new Usuario($_POST['nome'], $_POST['email'], '', $_POST['senha']);

    verificarSeTodosCamposObrigadoriosEstaoPreenchidos();
    verificarSeSenhaEstaDiferente($_POST['senha'], $_POST['confirmarsenha']);

    
    try {
            
        $service->criarUsuario($usuario);
        
        $_SESSION["contaCriada"] = true;
        
        header("Location: ../../../novaconta/contacriada.php");
    } catch (\Throwable $th) {
        throw new $th;
    }
    

} catch (SenhaDiferenteAoCadastrarException | EmailJaCadastradoException | CamposObrigatoriosNaoPreenchidosException $e) {
    $_SESSION["errosAoCriarConta"][] = $e->getMessage();
    header("Location: ../../../novaconta/criarconta.php");
}
