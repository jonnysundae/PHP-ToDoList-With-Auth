<?php

class SenhaIncorretaException extends Exception
{
    public function __construct($message = "A senha está incorreta!")
    {
        parent::__construct($message);
    }
}
