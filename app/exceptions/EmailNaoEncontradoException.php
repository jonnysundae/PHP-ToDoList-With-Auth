<?php

class EmailNaoEncontradoException extends Exception
{
    public function __construct($message = "Não existe uma conta com este e-mail!")
    {
        parent::__construct($message);
    }
}
