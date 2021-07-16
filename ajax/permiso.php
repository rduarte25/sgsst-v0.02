<?php 

require_once '../modelos/class-permiso.php';

$permiso = new Permiso();

switch ( $_GET['op'] ) {
		case 'listar':

		$rspta = $permiso->listar();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' => $reg->nombre,
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