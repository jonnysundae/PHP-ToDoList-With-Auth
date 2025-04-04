<?php
    session_start();
    $_SESSION["errosAoCriarConta"] = [];

    require_once "bancoDeDados/BancoDeDados.php";

    function verificarEmailExiste($email){
        $sql = "SELECT COUNT(*) AS contar FROM usuarios WHERE email = '".$email."';";
        $resultado = BancoDeDados::receberQuery($sql);

        if($resultado[0]["contar"] > 0){
            $_SESSION["errosAoCriarConta"][] =  "Este e-mail já tem uma conta!";
            print_r($_SESSION["errosAoCriarConta"]);
        }
    }

    function verificarSenha($senha, $confirmarSenha){
        if ($senha != $confirmarSenha){
            $_SESSION["errosAoCriarConta"][] =  "As senhas precisam ser iguais!";
        }
    }

    function verificarCampoVazio($valor,$nomeDoCampo){
        if ($valor == null){
            $_SESSION["errosAoCriarConta"][] =  "O campo '".$nomeDoCampo."' não pode estar vazio!";
        }
    }

    function criarConta($nome, $email, $senha, $confirmarSenha){

        verificarSenha($senha, $confirmarSenha);
        verificarEmailExiste($email);
        verificarCampoVazio($nome,"Nome");
        verificarCampoVazio($email,"E-mail");
        verificarCampoVazio($senha,"Senha");
        verificarCampoVazio($confirmarSenha,"Confirmar Senha");


        if(count($_SESSION["errosAoCriarConta"]) == 0){
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES
                    ('".$nome."', '".$email."', '".password_hash($senha, PASSWORD_DEFAULT)."')";
            BancoDeDados::enviarQuery($sql);

            $_SESSION["contaCriada"] = true;
            header("Location: ../novaconta/contacriada.php");
            exit();
        } else{
            header("Location: ../novaconta/criarconta.php");
            exit();
        }

    }
    
    criarConta($_POST["nome"],$_POST["email"],$_POST["senha"],$_POST["confirmarsenha"]);
?>
