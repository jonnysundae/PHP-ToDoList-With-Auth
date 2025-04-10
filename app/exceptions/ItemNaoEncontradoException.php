<?php

class ItemNaoEncontradoException extends Exception
{
    public function __construct($message = "A confirmação de senha está diferente da senha definida!")
    {
        parent::__construct($message);
    }
}
