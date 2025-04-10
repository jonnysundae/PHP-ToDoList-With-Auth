<?php

class ItemNaoPertenceAoUsuarioInformadoException extends Exception
{
    public function __construct($message = "O item que você está tentando alterar/excluir não pertence a este usuário!")
    {
        parent::__construct($message);
    }
}
