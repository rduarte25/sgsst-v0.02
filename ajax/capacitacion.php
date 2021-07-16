<?php 

require_once '../modelos/class-capacitacion.php';

$capacitacion = new Capacitacion();

//Validar idcapacitacion.
if ( isset( $_POST['idcapacitacion'] ) ) {
	$idcapacitacion = limpiarCadena( $_POST['idcapacitacion'] );
} else {
	$idcapacitacion = '';	
}

//Validar facha.
if ( isset( $_POST['fecha'] ) ) {
	$fecha = limpiarCadena( $_POST['fecha'] );
} else {
	$fecha = '';	
}

//Validar idtipo_capacitacion.
if ( isset( $_POST['idtipo_capacitacion'] ) ) {
	$idtipo_capacitacion = limpiarCadena( $_POST['idtipo_capacitacion'] );
} else {
	$idtipo_capacitacion = '';	
}

//Validar descripcion_capacitacion.
if ( isset( $_POST['descripcion_capacitacion'] ) ) {
	$descripcion_capacitacion = limpiarCadena( $_POST['descripcion_capacitacion'] );
} else {
	$descripcion_capacitacion = '';	
}

//Validar duracion.
if ( isset( $_POST['duracion'] ) ) {
	$duracion = limpiarCadena( $_POST['duracion'] );
} else {
	$duracion = '';	
}

//Validar descripción.
if ( isset( $_POST['ci_asistente'] ) ) {
	$ci_asistente = limpiarCadena( $_POST['ci_asistente'] );
} else {
	$ci_asistente = '';	
}

//Validar nombre_asistente.
if ( isset( $_POST['nombre_asistente'] ) ) {
	$nombre_asistente = limpiarCadena( $_POST['nombre_asistente'] );
} else {
	$nombre_asistente = '';	
}

//Validar realizador_por.
if ( isset( $_POST['realizado_por'] ) ) {
	$realizado_por = limpiarCadena( $_POST['realizado_por'] );
} else {
	$realizado_por = '';	
}

//Validar observaciones.
if ( isset( $_POST['observaciones'] ) ) {
	$observaciones = limpiarCadena( $_POST['observaciones'] );
} else {
	$observaciones = '';	
}

switch ( $_GET['op'] ) {
	case 'guardaryeditar':
		
		if (empty( $idcapacitacion )) {
			$rspta = $capacitacion->insertar( $fecha, $idtipo_capacitacion, $descripcion_capacitacion, $duracion, $ci_asistente, $ci_asistente, $nombre_asistente, $realizado_por, $observaciones);
			if ($rspta) {
				echo $rspta = "capacitacion registrado";
			} else {
				echo $rspta = "capacitacion no se pudo registar";
			}
		} else {
			$rspta = $capacitacion->editar( $idcapacitacion,  $fecha, $idtipo_capacitacion, $descripcion_capacitacion, $duracion, $ci_asistente, $nombre_asistente, $realizado_por, $observaciones );
			if ($rspta) {
				echo $rspta = "capacitacion actualizado";
			} else {
				echo $rspta = "capacitacion no se pudo actualizar";
			}
		}

		break;

	case 'desactivar':

		$rspta = $capacitacion->desactivar( $idcapacitacion );
		if ($rspta) {
			echo $rspta = 'capacitacion dasactivado';
		} else {
			echo $rspta = 'capacitacion no se pudo desactivar';
		}

		break;

	case 'activar':

		$rspta = $capacitacion->activar( $idcapacitacion );
		if ($rspta) {
			echo $rspta = 'capacitacion activado';
		} else {
			echo $rspta = 'capacitacion no se pudo activar';
		}

		break;

	case 'mostrar':

		$rspta = $capacitacion->mostrar( $idcapacitacion );
		//Codificar el resultado usando json.
		echo json_encode( $rspta );

		break;

	case 'listar':

		$rspta = $capacitacion->listar();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' => "<button class='btn btn-warning' onclick='mostrar(".$reg->idcapacitacion.")'><i class='fa fa-pencil'></i></button>",
				'1' => $reg->fecha,
				'2' => $reg->idtipo_capacitacion,
				'3' => $reg->descripcion_capacitacion,
				'4' => $reg->duracion,
				'5' => $reg->ci_asistente,
				'6' => $reg->nombre_asistente,
				'7' => $reg->realizado_por,
				'8' => $reg->observaciones,
				
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

		case 'selectCapacitacion':

			require_once '../modelos/class-capacitacion.php';
			$capacitacion = new Capacitacion();
			$rspta = $capacitacion->select();
			while ( $reg = $rspta->fetch_object() ) {
				echo '<option value=' . $reg->idtipo_capacitacion . '>' . $reg->nombre . '</option>';
			}

			break;
}

?>