<?php
// Conexión a la base de datos
require_once "../config/Conexion.php";
class Jugo
{
    // Implementamos el constructor
    public function __construct()
    {
    }


    public function listar()
    {
        $sql = "SELECT * FROM jugos";
        return ejecutarConsulta($sql);
    }

    public function listar2()
    {
        $sql = "SELECT * FROM jugos WHERE jugocondicion='1'";
        return ejecutarConsulta($sql);
    }

    public function insertar($nombre, $descripcion, $tipo, $precio, $imagen) {
        $sql = "INSERT INTO jugos (jugonombre, jugodescripcion, jugotipo, jugoprecio, jugoimagen) 
                VALUES ('$nombre', '$descripcion', '$tipo', '$precio', '$imagen')";
        return ejecutarConsulta($sql);
    }
    public function editar($idjugo, $nombre, $descripcion, $tipo, $precio, $imagen){
        $sql = "UPDATE jugos SET jugonombre='$nombre', jugodescripcion='$descripcion', jugotipo='$tipo', jugoprecio='$precio',jugoimagen='$imagen' 
        WHERE idjugo='$idjugo'";
        return ejecutarConsulta($sql);
    }
	public function mostrar($idjugo)
    {
    $sql = "SELECT * FROM jugos WHERE idjugo='$idjugo'";
    $resultado = ejecutarConsultaSimpleFila($sql);
    return $resultado;
    }
    
    //Implementamos un método para desactivar categorías
	public function desactivar($idjugo)
	{
		$sql="UPDATE jugos SET jugocondicion='0' WHERE idjugo='$idjugo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idjugo)
	{
		$sql="UPDATE jugos SET jugocondicion='1' WHERE idjugo='$idjugo'";
		return ejecutarConsulta($sql);
	}
    



}
?>