<?php 

require_once '../modelos/class-categoria.php';

$categoria = new Categoria();

//Validar idcategoria.
if ( isset( $_POST['idcategoria'] ) ) {
	$idcategoria = limpiarCadena( $_POST['idcategoria'] );
} else {
	$idcategoria = '';	
}

//Validar nombre.
if ( isset( $_POST['nombre'] ) ) {
	$nombre = limpiarCadena( $_POST['nombre'] );
} else {
	$nombre = '';	
}

//Validar descripción.
if ( isset( $_POST['descripcion'] ) ) {
	$descripcion = limpiarCadena( $_POST['descripcion'] );
} else {
	$descripcion = '';	
}

switch ( $_GET['op'] ) {
	case 'guardaryeditar':
		
		if (empty( $idcategoria )) {
			$rspta = $categoria->insertar( $nombre, $descripcion );
			if ($rspta) {
				echo $rspta = "Categoria registrada";
			} else {
				echo $rspta = "Categoria no se pudo registar";
			}
		} else {
			$rspta = $categoria->editar( $idcategoria, $nombre, $descripcion );
			if ($rspta) {
				echo $rspta = "Categoria actualizada";
			} else {
				echo $rspta = "Categoria no se pudo actualizar";
			}
		}

		break;

	case 'desactivar':

		$rspta = $categoria->desactivar( $idcategoria );
		if ($rspta) {
			echo $rspta = 'Categoria dasactivada';
		} else {
			echo $rspta = 'Categoria no se pudo desactivar';
		}

		break;

	case 'activar':

		$rspta = $categoria->activar( $idcategoria );
		if ($rspta) {
			echo $rspta = 'Categoria activada';
		} else {
			echo $rspta = 'Categoria no se pudo activar';
		}

		break;

	case 'mostrar':

		$rspta = $categoria->mostrar( $idcategoria );
		//Codificar el resultado usando json.
		echo json_encode( $rspta );

		break;

	case 'listar':

		$rspta = $categoria->listar();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' =>($reg->condicion)?"<button class='btn btn-warning' onclick='mostrar(".$reg->idcategoria.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-danger' onclick='desactivar(".$reg->idcategoria.")'><i class='fa fa-close'></i></button>":"<button class='btn btn-warning' onclick='mostrar(".$reg->idcategoria.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-primary' onclick='activar(".$reg->idcategoria.")'><i class='fa fa-check'></i></button>",
				'1' => $reg->nombre,
				'2' => $reg->descripcion,
				'3' => ($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
			);

		}
		$results = array (
			'sEcho'=> 1, //Información para el datatables.
			'iTotalRecords'=> count( $data ), //Enviamos el total registro al datatable.
			'iTotalDisplayRecords'=> count( $data ), //Enviamos el total registro a visualizar.
			'aaData'=> $data, //Información para el datatables.
		);

		echo json_encode( $results );

		break;
}

?>