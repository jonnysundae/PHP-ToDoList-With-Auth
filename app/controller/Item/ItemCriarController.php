<?php

session_start();
require_once __DIR__ . '/../../model/Item.php';
require_once __DIR__ . '/../../service/ItemService.php';
require_once __DIR__ . '/../../exceptions/CamposObrigatoriosNaoPreenchidosException.php';

try {
    if (!empty($_POST['itemnovo']) && !empty($_SESSION['usuario']['id'])) {
        $novoItem = new Item($_POST['itemnovo'], $_SESSION['usuario']['id']);
        $itemService = new ItemService;
        $itemService->criarItem($novoItem);

        header("Location: ../../../minhaLista.php");
    } else {
        throw new CamposObrigatoriosNaoPreenchidosException();
    }
} catch (\Throwable $th) {
    $_SESSION["errosAoCriarItem"][] = $th->getMessage();
    header("Location: ../../../minhaLista.php");
}
