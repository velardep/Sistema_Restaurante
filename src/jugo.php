<?php
require_once "../model/Jugo.php";
$jugo = new Jugo();

$idjugo=isset($_POST["idjugo"])? $_POST["idjugo"]:"";
$nombre=isset($_POST["nombrejugo"])? mb_strtoupper($_POST["nombrejugo"]):"";
$tipo=isset($_POST["tipojugo"])? mb_strtoupper($_POST["tipojugo"]):"";
$precio=isset($_POST["preciojugo"])? $_POST["preciojugo"]:"";
$descripcion=isset($_POST["descripcionjugo"])? mb_strtoupper($_POST["descripcionjugo"]):"";
$imagen=isset($_POST["imagen"])? $_POST["imagen"]:"";



switch ($_GET["op"]) {
    case '0':
        $rspta = $jugo->listar2();
        $data = array();

        while ($reg = pg_fetch_assoc($rspta)) {
            $data[] = array(
                "id" => $reg['idjugo'],
                "name" => $reg['jugonombre'],
                "type" => $reg['jugotipo'],
                "price" => $reg['jugoprecio'],
                "image" => $reg['jugoimagen'],
                "description" => $reg['jugodescripcion'],
				"condicion" => $reg['jugocondicion'] == 1 ? true : false, // Cambiamos 'type' a 'active'
            );
        }
        echo json_encode($data);
    break;
    case '1':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactualjugo"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../file/jugo/" . $imagen);
			}
		}
		if (empty($idjugo)){
			$rspta=$jugo->insertar($nombre,$descripcion, $tipo, $precio, $imagen);
			echo $rspta ? "1:El jugo fué registrado" : "0:El jugo no fué registrado";
            //echo $idjugo;
        }
		else {
			$rspta=$jugo->editar($idjugo,$nombre,$descripcion, $tipo, $precio, $imagen);
			echo $rspta ? "1:El jugo fué actualizado" : "0:El jugo no fué actualizado";
		}
	break;
	case '2':
		$rspta=$jugo->desactivar($idjugo);
 		echo $rspta ? "1:El jugo fué Desactivado" : "0:El jugo no fué Desactivado";
	break;

	case '3':
		$rspta=$jugo->activar($idjugo);
 		echo $rspta ? "1:El jugo fué Activado" : "0:El jugo no fué Activado";
	break;

	case '4':
		$rspta=$jugo->mostrar($idjugo);
 		echo json_encode($rspta);
	break;





	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	case '5':
		$rspta = $jugo->listar();
		$data = array();

		while ($reg = pg_fetch_assoc($rspta)) {
			$data[] = array(
				"id" => $reg['idjugo'],
				"name" => $reg['jugonombre'],
				"price" => $reg['jugoprecio'],
				"image" => $reg['jugoimagen'],
				"description" => $reg['jugodescripcion'],
				"active" => $reg['jugocondicion'] == 1 ? true : false, // Cambiamos 'type' a 'active'
			);
		}
		echo json_encode($data);
		break;
		
	case '6':

		$rspta = $jugo->listar2();
		$data = array();

		while ($reg = pg_fetch_assoc($rspta)) {
			$data[] = array(
				"id" => $reg['idjugo'],
				"name" => $reg['jugonombre'],
				"price" => $reg['jugoprecio'],
				"image" => $reg['jugoimagen'],
				"description" => $reg['jugodescripcion'],
				"active" => $reg['jugocondicion'] == 1 ? true : false, // Cambiamos 'type' a 'active'
			);
		}
		echo json_encode($data);
		break;
}

