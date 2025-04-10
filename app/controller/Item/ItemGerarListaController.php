<?php

require_once __DIR__ . '/../../model/Item.php';
require_once __DIR__ . '/../../service/ItemService.php';

class ItemGerarListaController
{

    public function gerarTabelaComALista()
    {
        $itemService = new ItemService;

        if ($itemService->contarQuantidadeDeItemPorUsuario($_SESSION['usuario']['id']) > 0) {
            $lista = $itemService->listarItemPorUsuario($_SESSION['usuario']['id']);

            $html = '';

            foreach ($lista as $item) {
                $status = ($item['concluido']) ? "Concluído" : "Pendente";

                $html .= "
                        <tr>
                        <td>".$item["descricao"]."</td>
                        <td>".$status."</td>
                        <td><button type='submit' name='botaoMudarStatus' value='".$item["id"]."'>Mudar Status</button></td>
                        </tr>";

            }
            return $html;
        } else {
            return null;
        }
    }
}
