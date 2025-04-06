<?php

class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome, $email, $id = null, $senha = null)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setId($id);
        if ($senha) {
            $this->setSenha($senha);
        }
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha= $senha;
    }

}
