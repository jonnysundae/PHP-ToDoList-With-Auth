<?php

require_once __DIR__ . '/../config/BancoDeDados.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../exceptions/EmailNaoEncontradoException.php';
require_once __DIR__ . '/../exceptions/SenhaIncorretaException.php';

class UsuarioService
{
    private $bancoDeDados;

    public function __construct()
    {
        $this->bancoDeDados = BancoDeDados::conectar();
    }

    public function buscarPorEmail($email, $retornarException = true)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->bancoDeDados->prepare($sql);
        $stmt->execute([':email' => $email]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($dados) {
            return new Usuario($dados['nome'], $dados['email'], $dados['id'], $dados['senha']);
        } else {
            if ($retornarException) {
                throw new EmailNaoEncontradoException();
            }
        }
        
    }

    public function autenticar($email, $senha)
    {
        try {
            $usuario = $this->buscarPorEmail($email);
            if (password_verify($senha, $usuario->getSenha())) {
                return $usuario;
            } else {
                throw new SenhaIncorretaException();
            }
        } catch (EmailNaoEncontradoException | SenhaIncorretaException $e) {
            throw $e;
        }

    }

    public function criarUsuario(Usuario $usuario)
    {
        if ($this->buscarPorEmail($usuario->getEmail(), false) instanceof Usuario) {
            throw new EmailJaCadastradoException();
        } else {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this ->bancoDeDados->prepare($sql);
            $stmt->execute([
                ':nome' => $usuario->getNome(),
                ':email' => $usuario->getEmail(),
                ':senha' => password_hash($usuario->getSenha(), PASSWORD_DEFAULT)
            ]);
        }
    }

}
