<?php
//METODO ANTIGO DE ACESSAR O BANCO DE DADOS

class BancoDeDados
{
    private static $conexao;

    protected static function conectar()
    {
        if (!isset(self::$conexao)) {
            self::$conexao = new mysqli("localhost", "root", "", "lista");
            if (self::$conexao->connect_error) {
                die("Falha na conexão: " . self::$conexao->connect_error);
            }
        }

    }

    public static function enviarQuery($sql)
    {
        self::conectar();
        self::$conexao->query($sql);
    }
      
    public static function receberQuery($sql)
    {
        self::conectar();
        $resultado = self::$conexao->query($sql);
          
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public static function fecharConexao()
    {
        if (isset(self::$conexao)) {
            self::$conexao->close();
            self::$conexao = null;
        }
    }
}
