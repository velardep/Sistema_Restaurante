<?php
require_once "../config/Conexion.php";

// Template Method
// La clase Reserva define el esqueleto de los algoritmos para reservas, con pasos fijos y algunos delegados a otros métodos.
class Reserva
{
    public function __construct()
    {
    }

    // Template Method: Define la estructura para insertar una reserva
    // 1. Construir SQL 
    // 2. Ejecutar SQL 
    public function insertarreserva($num_comensales, $num_mesa, $reservahora, $reservafecha, $nombrecliente_session)
    {
        $sql = "INSERT INTO reserva (num_comensales, num_mesa, reservahora, reservafecha, clientenombre) 
                VALUES ('$num_comensales', '$num_mesa', '$reservahora', '$reservafecha', '$nombrecliente_session')";
        return ejecutarConsulta($sql);
    }

    // Define la estructura para obtener mesas
    // 1. Construir SQL 
    // 2. Ejecutar SQL 
    // 3. Transformar resultados 
    public function obtenerMesasDisponibles()
    {
        $sql = "SELECT id_mesa, nombre_mesa FROM mesas WHERE disponible = 1";
        // $result = ejecutarConsulta($sql);
        // return transformarResultados($result);
    }

    public function actmesa($num_mesa){
        $sql = "UPDATE mesa 
                SET mesacondicion=0
                WHERE num_mesa= $num_mesa";
        return ejecutarConsulta($sql);
    }
}
