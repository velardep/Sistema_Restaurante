<?php
require_once "../model/Mesa.php";
$mesa = new Mesa();


switch ($_GET["op"]) {
    case '0':
        $rspta = $mesa->listar();
        $data = array();

        while ($reg = pg_fetch_assoc($rspta)) {
            $data[] = array(
                "num_mesa" => $reg['num_mesa'],
                "mesacapacidad" => $reg['mesacapacidad'],
                "mesacondicion" => $reg['mesacondicion']
            );
        }
        echo json_encode($data);
        break;
}
