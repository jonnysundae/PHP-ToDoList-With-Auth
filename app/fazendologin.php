<?php
    session_start();
    require_once "bancoDeDados/BancoDeDados.php";

    unset($_SESSION["usuario"]);
    $_SESSION["errosAoFazerLogin"] = [];


    function verificarCampoVazio($valor,$nomeDoCampo){
        if ($valor == null){
            $_SESSION["errosAoFazerLogin"][] =  "O campo '".$nomeDoCampo."' não pode estar vazio!";
        }
    }

    function verificarSeContaExiste($email){
        $sql = "SELECT COUNT(*) AS contar FROM usuarios WHERE email = '".$email."';";
        $resultado = BancoDeDados::receberQuery($sql);

        if ($resultado[0]["contar"] > 0){
            return true;
            //retorna true se a conta existe
        } else{
            $_SESSION["errosAoFazerLogin"][] =  "Não existe uma conta com este e-mail!";
        }
        
    }

    function verificarSenha($senha, $email){
        $sql = "SELECT senha FROM usuarios WHERE email = '".$email."' LIMIT 1;";
        $resultado = BancoDeDados::receberQuery($sql);

        if (password_verify($senha, $resultado[0]["senha"])) {
            return true;
            //retorna true se a senha for correta
        } else {
            $_SESSION["errosAoFazerLogin"][] =  "Senha Incorreta!";
        }
    }

    function criarSessaoComUsuario($email){

        $sql = "SELECT id, nome, email FROM usuarios WHERE email = '".$email."' LIMIT 1;";
        $resultado = BancoDeDados::receberQuery($sql);
    
        
        $_SESSION["usuario"]["id"] = $resultado[0]["id"];
        $_SESSION["usuario"]["nome"] = $resultado[0]["nome"];
        $_SESSION["usuario"]["email"] = $resultado[0]["email"];
    }
        

    function fazerLogin($email,$senha){

        verificarCampoVazio($email,"E-mail");
        verificarCampoVazio($senha,"Senha");

        if(verificarSeContaExiste($email)){
            verificarSenha($senha, $email);
        }

        if(count($_SESSION["errosAoFazerLogin"]) == 0){
            criarSessaoComUsuario($email);
            header("Location: ../minhaLista.php");
        } else{
            header("Location: ../index.php");
            exit();
        }
        
    }

    fazerLogin($_POST["email"],$_POST["senha"]);
    
?>
