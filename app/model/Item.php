<?php

class Item
{
    private $id;
    private $descricao;
    private $concluido;
    private $userId;

    public function __construct($descricao, $userId, $id = null, $concluido = 0)
    {
        $this->setId($id);
        $this->setDescricao($descricao);
        $this->setConcluido($concluido);
        $this->setUserId($userId);
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    public function getConcluido()
    {
        return $this->concluido;
    }


    public function setConcluido($concluido)
    {
        $this->concluido = $concluido;
    }


    public function getUserId()
    {
        return $this->userId;
    }


    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
