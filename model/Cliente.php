<?php
// Conexión a la base de datos
require_once "../config/Conexion.php";
class Cliente
{
    // Implementamos el constructor
    public function __construct()
    {
    }


    // Método para insertar registros
    public function insertarcliente($clientenombre, $clienteemail)
    {
        $validacion = $this->compruebaDuplicadoscliente(0, $clientenombre);
        if ($validacion == 0) {
            $sql = "INSERT INTO cliente (clientenombre, clienteemail) VALUES ('$clientenombre','$clienteemail')";
            return ejecutarConsulta($sql);
        } else {
            return 0;
        }
    }

    // Método para verificar duplicados
    public function compruebaDuplicadoscliente($idcliente, $clientenombre)
    {
        $resultado = 0;
        $sql = "SELECT COUNT(idcliente) AS idcliente FROM cliente WHERE (clientenombre='$clientenombre') AND (idcliente<>$idcliente)";
        $resultado = ejecutarConsultaSimpleFila($sql);
        return $resultado['idcliente'];
    }

    public function verificarcredencial($clientenombre,$clienteemail){
        $sql = "SELECT rol FROM cliente WHERE (clientenombre='$clientenombre') AND (clienteemail= '$clienteemail' )";
        $resultado = ejecutarConsultaSimpleFila($sql);

		return $resultado['rol'];
    }

   
}