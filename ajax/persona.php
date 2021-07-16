<?php 

require_once '../modelos/class-persona.php';

$persona = new Persona();

//Validar idpersona.
if ( isset( $_POST['idpersona'] ) ) {
	$idpersona = limpiarCadena( $_POST['idpersona'] );
} else {
	$idpersona = '';	
}

//Validar tipo_persona.
if ( isset( $_POST['tipo_persona'] ) ) {
	$tipo_persona = limpiarCadena( $_POST['tipo_persona'] );
} else {
	$tipo_persona = '';	
}

//Validar nombre.
if ( isset( $_POST['nombre'] ) ) {
	$nombre = limpiarCadena( $_POST['nombre'] );
} else {
	$nombre = '';	
}

//Validar tipo_documento.
if ( isset( $_POST['tipo_documento'] ) ) {
	$tipo_documento = limpiarCadena( $_POST['tipo_documento'] );
} else {
	$tipo_documento = '';	
}

//Validar num_documento.
if ( isset( $_POST['num_documento'] ) ) {
	$num_documento = limpiarCadena( $_POST['num_documento'] );
} else {
	$num_documento = '';	
}

//Validar direccion.
if ( isset( $_POST['direccion'] ) ) {
	$direccion = limpiarCadena( $_POST['direccion'] );
} else {
	$direccion = '';	
}

//Validar telefono.
if ( isset( $_POST['telefono'] ) ) {
	$telefono = limpiarCadena( $_POST['telefono'] );
} else {
	$telefono = '';	
}

//Validar email.
if ( isset( $_POST['email'] ) ) {
	$email = limpiarCadena( $_POST['email'] );
} else {
	$email = '';	
}

switch ( $_GET['op'] ) {
	case 'guardaryeditar':
		
		if (empty( $idpersona )) {
			$rspta = $persona->insertar( $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email );
			if ($rspta) {
				echo $rspta = "Persona registrada";
			} else {
				echo $rspta = "Persona no se pudo registar";
			}
		} else {
			$rspta = $persona->editar( $idpersona, $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email );
			if ($rspta) {
				echo $rspta = "Persona actualizada";
			} else {
				echo $rspta = "Persona no se pudo actualizar";
			}
		}

		break;

	case 'eliminar':

		$rspta = $persona->eliminar( $idpersona );
		if ($rspta) {
			echo $rspta = 'Persona eliminada';
		} else {
			echo $rspta = 'Persona no se pudo eliminar';
		}

		break;

	case 'mostrar':

		$rspta = $persona->mostrar( $idpersona );
		//Codificar el resultado usando json.
		echo json_encode( $rspta );

		break;

	case 'listarp':

		$rspta = $persona->listarp();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' =>"<button class='btn btn-warning' onclick='mostrar(".$reg->idpersona.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-danger' onclick='eliminar(".$reg->idpersona.")'><i class='fa fa-trash'></i></button>",
				'1' => $reg->nombre,
				'2' => $reg->tipo_documento,
				'3' => $reg->num_documento,
				'4' => $reg->telefono,
				'5' => $reg->email,
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

	case 'listarc':

		$rspta = $persona->listarc();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' =>"<button class='btn btn-warning' onclick='mostrar(".$reg->idpersona.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-danger' onclick='eliminar(".$reg->idpersona.")'><i class='fa fa-trash'></i></button>",
				'1' => $reg->nombre,
				'2' => $reg->tipo_documento,
				'3' => $reg->num_documento,
				'4' => $reg->telefono,
				'5' => $reg->email,
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