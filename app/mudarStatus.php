<?php

    session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
    }

    require_once "bancoDeDados/BancoDeDados.php";

    echo $_POST["botaoMudarStatus"];
    

    function verificarCampoVazio($valor){
        if ($valor == null){
            $_SESSION["errosAoCriarItem"][] =  "Está faltando dados para fazer essa alteração!";
            return true;
        } else{
            return false;
        }
    }

    function alterarStatus($idUsuario, $idItem){
        if(verificarCampoVazio($idItem) OR verificarCampoVazio($idUsuario)){
            header("Location: ../minhaLista.php");
        }else{
            $sql = "UPDATE item SET concluido = 1 - concluido WHERE id = ".$idItem." AND user_id = ".$idUsuario.";";
            BancoDeDados::enviarQuery($sql);
            header("Location: ../minhaLista.php");
        }
    }

    alterarStatus($_SESSION["usuario"]["id"],$_POST["botaoMudarStatus"]);
?>
