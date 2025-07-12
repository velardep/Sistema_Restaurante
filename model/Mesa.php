<?php
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";
class Mesa
{
    //Implementamos nuestro constructor
    public function __construct()
    {
    }


    //Implementar un método para listar los registros
    public function listar()
    {
        $sql = "SELECT * FROM public.mesa WHERE mesacondicion=1 ORDER BY num_mesa ASC ";
        return ejecutarConsulta($sql);
    }

}


        
