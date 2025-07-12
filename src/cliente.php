<?php
session_start();
require_once "../model/Cliente.php";
$cliente = new Cliente();


$idcliente = isset($_POST["idcliente"]) ? $_POST["idcliente"] : "";
$clientenombre = isset($_POST["clientenombre"]) ? mb_strtoupper($_POST["clientenombre"]) : "";
$clienteemail = isset($_POST["clienteemail"]) ? mb_strtoupper($_POST["clienteemail"]) : "";

switch ($_GET["op"]) {

    case '0':

        if (empty($idcliente)) {
            $rspta = $cliente->insertarcliente($clientenombre, $clienteemail);

            echo $rspta ? "1:El Cliente fué registrado" : "0:El Cliente no fué registrado";
        }
        break;
}
