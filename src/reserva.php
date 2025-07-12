<?php
require_once "../model/Reserva.php"; // Asegúrate de que el archivo requerido sea correcto y exista
session_start();

$nombrecliente_session = isset($_SESSION['clientenombre']) ? $_SESSION['clientenombre'] : '';

$reserva = new Reserva();

$num_comensales = isset($_POST["num_comensales"]) ? mb_strtoupper($_POST["num_comensales"]) : "";
$reservahora = isset($_POST["reservahora"]) ? mb_strtoupper($_POST["reservahora"]) : "";
$reservafecha = isset($_POST["reservafecha"]) ? mb_strtoupper($_POST["reservafecha"]) : "";
$num_mesa = isset($_POST["num_mesa"]) ? mb_strtoupper($_POST["num_mesa"]) : "";

switch ($_GET["op"]) {
    case '0':
        if (!empty($nombrecliente_session)) {
            $rspta = $reserva->insertarreserva($num_comensales, $num_mesa, $reservahora, $reservafecha, $nombrecliente_session);
            $rspta = $reserva->actmesa($num_mesa);
            echo json_encode(["status" => $rspta ? 1 : 0, "message" => $rspta ? "Su Reserva fue agendada con éxito." : "La Reserva no pudo ser registrada"]);
        } else {
            echo json_encode(["status" => 0, "message" => "No te olvides de iniciar tu sesión en Google"]);
        }
        break;
    case '1':
        //Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
        break;
}
