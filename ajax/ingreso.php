<?php 

require_once '../modelos/class-ingreso.php';

if ( strlen( session_id() < 1 ) ) {
	session_start();
}

$ingreso = new Ingreso();

//Validar idingreso.
if ( isset( $_POST['idingreso'] ) ) {
	$idingreso = limpiarCadena( $_POST['idingreso'] );
} else {
	$idingreso = '';	
}

//Validar idproveedor.
if ( isset( $_POST['idproveedor'] ) ) {
	$idproveedor = limpiarCadena( $_POST['idproveedor'] );
} else {
	$idproveedor = '';	
}

//Validar idusuario.
$idusuario = $_SESSION['idusuario'];

//Validar tipo_comprobante.
if ( isset( $_POST['tipo_comprobante'] ) ) {
	$tipo_comprobante = limpiarCadena( $_POST['tipo_comprobante'] );
} else {
	$tipo_comprobante = '';	
}

//Validar serie_comprobante.
if ( isset( $_POST['serie_comprobante'] ) ) {
	$serie_comprobante = limpiarCadena( $_POST['serie_comprobante'] );
} else {
	$serie_comprobante = '';	
}

//Validar num_comprobante.
if ( isset( $_POST['num_comprobante'] ) ) {
	$num_comprobante = limpiarCadena( $_POST['num_comprobante'] );
} else {
	$num_comprobante = '';	
}

//Validar fecha_hora.
if ( isset( $_POST['fecha_hora'] ) ) {
	$fecha_hora = limpiarCadena( $_POST['fecha_hora'] );
} else {
	$fecha_hora = '';	
}

//Validar fecha_hora.
if ( isset( $_POST['fecha_hora'] ) ) {
	$fecha_hora = limpiarCadena( $_POST['fecha_hora'] );
} else {
	$fecha_hora = '';	
}

//Validar impuesto.
if ( isset( $_POST['impuesto'] ) ) {
	$impuesto = limpiarCadena( $_POST['impuesto'] );
} else {
	$impuesto = '';	
}

//Validar total_compra.
if ( isset( $_POST['total_compra'] ) ) {
	$total_compra = limpiarCadena( $_POST['total_compra'] );
} else {
	$total_compra = '';	
}

switch ( $_GET['op'] ) {
	case 'guardaryeditar':
		
		if (empty( $idingreso )) {

			$rspta = $ingreso->insertar( $idproveedor, $idusuario, $tipo_comprobante, $serie_comprobante, $num_comprobante, $fecha_hora, $impuesto, $total_compra, $_POST['idarticulo'], $_POST['cantidad'], $_POST['precio_compra'], $_POST['precio_venta'] );
			if ($rspta) {

				echo $rspta = "Ingreso registrado";
			} else {
				echo $rspta = "No se pudieron registrar todos los datos del increso";
			}
		}

		break;

	case 'anular':

		$rspta = $ingreso->anular( $idingreso );
		if ($rspta) {
			echo $rspta = 'Ingreso anulado';
		} else {
			echo $rspta = 'Ingreso no se pude anular';
		}

		break;

	case 'mostrar':

		$rspta = $ingreso->mostrar( $idingreso );
		//Codificar el resultado usando json.
		echo json_encode( $rspta );

		break;

	case 'listar':

		$rspta = $ingreso->listar();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' =>($reg->estado == 'Aceptado')?"<button class='btn btn-warning' onclick='mostrar(".$reg->idingreso.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-danger' onclick='anular(".$reg->idingreso.")'><i class='fa fa-close'></i></button>":"<button class='btn btn-warning' onclick='mostrar(".$reg->idingreso.")'><i class='fa fa-pencil'></i></button>",
				'1' => $reg->fecha,
				'2' => $reg->proveedor,
				'3' => $reg->usuario,
				'4' => $reg->tipo_comprobante,
				'5' => $reg->serie_comprobante,
				'6' => $reg->total_compra,
				'7' => ($reg->estado == 'Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>',
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
	case 'selectProveedor':
		require_once '../modelos/class-persona.php';
		$persona = new Persona();

		$rspta = $persona->listarp();
		while( $reg = $rspta->fetch_object() ){
			echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
		}
		break;

	case 'listarArticulos':
		require_once '../modelos/class-articulo.php';
		$articulo = new Articulo();

		$rspta = $articulo->listarActivos();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' =>'<button class="btn btn-warning" onclick="agregarDetalle(' . $reg->idarticulo .',\'' . $reg->nombre . '\')"><span class="fa fa-plus"></span></button>',
				'1' => $reg->nombre,
				'2' => $reg->categoria,
				'3' => $reg->codigo,
				'4' => $reg->stock,
				'5' => "<img src='../files/articulos/". $reg->imagen ."' height='50px width='50px'/>",
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