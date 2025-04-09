<?php

class EmailJaCadastradoException extends Exception
{
    public function __construct($message = "Já existe um cadastro no sistema com esse e-mail!")
    {
        parent::__construct($message);
    }
}
