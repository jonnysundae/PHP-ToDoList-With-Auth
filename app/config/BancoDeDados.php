<?php
class BancoDeDados
{

    private static $bd = 'mysql:host=localhost;dbname=lista';
    private static $usuario = 'root';
    private static $senha = '';

    public static function conectar()
    {
        return new PDO(self::$bd, self::$usuario, self::$senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}
