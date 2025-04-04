<?php

    session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
    }

    require_once "bancoDeDados/BancoDeDados.php";

    function verificarCampoVazio($valor){
        if ($valor == null){
            $_SESSION["errosAoCriarItem"][] =  "Você não pode adicionar um item sem descrição na sua To Do List!";
            return true;
        } else{
            return false;
        }
    }

    function criarItem($idUsuario, $descricao){
        if(verificarCampoVazio($descricao)){
            header("Location: ../minhaLista.php");
        }else{
            $sql = "INSERT INTO item (descricao, concluido, user_id) VALUES
                    ('".$descricao."', 0, '".$idUsuario."')";
            BancoDeDados::enviarQuery($sql);
            header("Location: ../minhaLista.php");
        }
    }

    criarItem($_SESSION["usuario"]["id"],$_POST["itemnovo"]);
?>
