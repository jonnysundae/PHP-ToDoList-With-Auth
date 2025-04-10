<?php

require_once __DIR__ . '/../config/BancoDeDados.php';
require_once __DIR__ . '/../model/Item.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../exceptions/ItemNaoEncontradoException.php';
require_once __DIR__ . '/UsuarioService.php';


$service = new ItemService;

class ItemService
{

    private $bancoDeDados;

    public function __construct()
    {
        $this->bancoDeDados = BancoDeDados::conectar();
    }

    public function listarItemPorUsuario($userId, $quantidadePorPagina = null, $pagina = null, $filtroConcluido = "todos")
    {

        $sql = "SELECT * FROM item
                WHERE user_id = :userId";

        switch ($filtroConcluido) {
            case 'concluido':
                $sql .= ' AND concluido = 1';
                break;

            case 'naoConcluido':
                $sql .= ' AND concluido = 0';
                break;
            
            default:
            case 'todos':
                break;
        }

        $sql .= ' ORDER BY id';

        if (!empty($quantidadePorPagina)) {
            $sql .= ' LIMIT :quantidadePorPagina';
        }
        
        if (!empty($pagina)) {
            $sql .= ' OFFSET :quantidadePulada';
        }

        $quantidadePulada = ($pagina <= 1) ? 0 : $quantidadePorPagina * ($pagina-1);
        
        $stmt = $this->bancoDeDados->prepare($sql);

        if (!empty($quantidadePorPagina)) {
            $stmt->bindValue(':quantidadePorPagina', $quantidadePorPagina, PDO::PARAM_INT);
        }

        if (!empty($pagina)) {
            $stmt->bindValue(':quantidadePulada', $quantidadePulada, PDO::PARAM_INT);
        }

        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function buscarItemPorId($id, $retornarException = true)
    {
        $sql = "SELECT * FROM item WHERE id = :id LIMIT 1";
        $stmt = $this->bancoDeDados->prepare($sql);
        $stmt->execute([':id' => $id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            return new Item($dados['descricao'], $dados['user_id'], $dados['id'], $dados['concluido']);
        } else {
            if ($retornarException) {
                throw new ItemNaoEncontradoException();
            }
        }
    }

    public function criarItem(Item $item)
    {
        $sql = "INSERT INTO item (descricao, concluido, user_id) VALUES (:descricao, :concluido, :user_id);";
        $stmt = $this->bancoDeDados->prepare($sql);
        $stmt->execute([
            ':descricao' => $item->getDescricao(),
            ':concluido' => $item->getConcluido(),
            ':user_id' => $item -> getUserId(),
        ]);
    }

    public function apagarItem(Item $item)
    {
        $sql = "DELETE FROM item WHERE id = :id;";
        $stmt = $this->bancoDeDados->prepare($sql);
        $stmt->execute(['id' => $item->getId()]);
    }

    public function editarDescricaoItem(Item $item, $novaDescricao)
    {
        $sql = "UPDATE item
                SET descricao = ':descricao',
                WHERE id = :id;";
        $stmt =  $this->bancoDeDados->prepare($sql);
        $stmt->execute([':descricao' => $novaDescricao]);
    }

    public function mudarStatusItem(Item $item)
    {
        $sql = "UPDATE item
                SET concluido = ':concluido',
                WHERE id = :id;";
        $stmt =  $this->bancoDeDados->prepare($sql);

        $novoStatus = ($item->getConcluido() == 0) ? 1 : 0;
        $stmt->bindValue(':concluido', $novoStatus, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function contarQuantidadeDeItemPorUsuario($userId)
    {
        $sql = "SELECT COUNT(*) AS contar
                FROM item WHERE user_id = :user_id";
        $stmt =  $this->bancoDeDados->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado["contar"];
    }
}
