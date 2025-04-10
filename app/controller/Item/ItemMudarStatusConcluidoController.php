<?php

session_start();
require_once __DIR__ . '/../../model/Item.php';
require_once __DIR__ . '/../../service/ItemService.php';



try {
    $itemService = new ItemService();
        
    $item = $itemService->BuscarItemPorId($_POST['botaoMudarStatus']);
        
    if ($item->getUserId() == $_SESSION['usuario']['id']) {
        $itemService->mudarStatusItem($item);
        header("Location: ../../../minhaLista.php");
    } else {
        throw new ItemNaoPertenceAoUsuarioInformadoException();
    }
} catch (\Throwable $th) {
    $_SESSION["errosAoCriarItem"][] = $th->getMessage();
    header("Location: ../../../minhaLista.php");
}
