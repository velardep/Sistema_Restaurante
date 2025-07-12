<?php
require_once "../model/Menu.php";
$menu = new Menu();

$idcomida = isset($_POST["idcomida"]) ? $_POST["idcomida"] : "";
$nombre = isset($_POST["nombre"]) ? mb_strtoupper($_POST["nombre"]) : "";
$tipo = isset($_POST["tipo"]) ? mb_strtoupper($_POST["tipo"]) : "";
$precio = isset($_POST["precio"]) ? $_POST["precio"] : "";
$descripcion = isset($_POST["descripcion"]) ? mb_strtoupper($_POST["descripcion"]) : "";
$imagen = isset($_POST["imagen"]) ? $_POST["imagen"] : "";



switch ($_GET["op"]) {
	case '0':
		$rspta = $menu->listar();
		$data = array();

		while ($reg = pg_fetch_assoc($rspta)) {
			$data[] = array(
				"id" => $reg['idcomida'],
				"name" => $reg['comidanombre'],
				"price" => $reg['comidaprecio'],
				"image" => $reg['comidaimagen'],
				"description" => $reg['comidadescripcion'],
				"active" => $reg['menucondicion'] == 1 ? true : false, // Cambiamos 'type' a 'active'
			);
		}
		echo json_encode($data);
		break;
	case '1':
		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen = $_POST["imagenactual"];
		} else {
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../file/comida/" . $imagen);
			}
		}
		if (empty($idcomida)) {
			$rspta = $menu->insertar($nombre, $tipo, $precio, $imagen, $descripcion);
			echo $rspta ? "1:El menu fué registrado" : "0:El menu no fué registrado";
		} else {
			$rspta = $menu->editar($idcomida, $nombre, $tipo, $precio, $imagen, $descripcion);
			echo $rspta ? "1:El menu fué actualizado" : "0:El menu no fué actualizado";
		}
		break;

	case '2':
		$rspta = $menu->desactivar($idcomida);
		echo $rspta ? "1:El menu fué Desactivado" : "0:El menu no fué Desactivado";
		break;

	case '3':
		$rspta = $menu->activar($idcomida);
		echo $rspta ? "1:El menu fué Activado" : "0:El menu no fué Activado";
		break;

	case '4':
		$rspta = $menu->mostrar($idcomida);
		echo json_encode($rspta);
		break;
	case '5':
		$rspta = $menu->listar();
		$data = array();

		while ($reg = pg_fetch_assoc($rspta)) {
			$data[] = array(
				"id" => $reg['idcomida'],
				"name" => $reg['comidanombre'],
				"price" => $reg['comidaprecio'],
				"image" => $reg['comidaimagen'],
				"description" => $reg['comidadescripcion'],
				"active" => $reg['menucondicion'] == 1 ? true : false, // Cambiamos 'type' a 'active'
			);
		}
		echo json_encode($data);
		break;
	case '6':

		$rspta = $menu->listar2();
		$data = array();

		while ($reg = pg_fetch_assoc($rspta)) {
			$data[] = array(
				"id" => $reg['idcomida'],
				"name" => $reg['comidanombre'],
				"price" => $reg['comidaprecio'],
				"image" => $reg['comidaimagen'],
				"description" => $reg['comidadescripcion'],
				"active" => $reg['menucondicion'] == 1 ? true : false, // Cambiamos 'type' a 'active'
			);
		}
		echo json_encode($data);
		break;
}
