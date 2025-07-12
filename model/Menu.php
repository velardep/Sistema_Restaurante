<?php
// Conexión a la base de datos
require_once "../config/Conexion.php";
class Menu
{
    // Implementamos el constructor
    public function __construct()
    {
    }

    public function listar()
    {
        $sql = "SELECT * FROM menu";
        return ejecutarConsulta($sql);
    }
    public function listar2()
    {
        $sql = "SELECT * FROM menu WHERE menucondicion='1'";
        return ejecutarConsulta($sql);
    }

    public function insertar($nombre, $tipo, $precio, $imagen, $descripcion)
    {
        $sql = "INSERT INTO menu (comidanombre, comidatipo, comidaprecio, comidaimagen,comidadescripcion) 
        VALUES ('$nombre', '$tipo', '$precio', '$imagen','$descripcion')";
        return ejecutarConsulta($sql);
    }

    public function editar($idcomida, $nombre, $tipo, $precio, $imagen, $descripcion)
    {
        $sql = "UPDATE menu SET comidanombre='$nombre', comidatipo='$tipo', comidaprecio='$precio', comidaimagen='$imagen',comidadescripcion='$descripcion' 
        WHERE idcomida='$idcomida'";
        return ejecutarConsulta($sql);
    }
    public function mostrar($idcomida)
    {
        $sql = "SELECT * FROM menu WHERE idcomida='$idcomida'";
        $resultado = ejecutarConsultaSimpleFila($sql);
        return $resultado;
    }

    //Implementamos un método para desactivar categorías
    public function desactivar($idcomida)
    {
        $sql = "UPDATE menu SET menucondicion='0' WHERE idcomida='$idcomida'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function activar($idcomida)
    {
        $sql = "UPDATE menu SET menucondicion='1' WHERE idcomida='$idcomida'";
        return ejecutarConsulta($sql);
    }
}
