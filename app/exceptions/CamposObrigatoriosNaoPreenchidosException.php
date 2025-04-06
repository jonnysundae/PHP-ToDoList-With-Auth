<?php

class CamposObrigatoriosNaoPreenchidosException extends Exception
{
    public function __construct($message = "Todos os campos obrigatórios devem estar preenchidos!")
    {
        parent::__construct($message);
    }
}
