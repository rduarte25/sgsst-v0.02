<?php 

session_start();

//Incluimos inicialmente la conexión a la base de datos.
require '../config/conexion.php';

Class Ingreso {
	//Implementar nuestro constructor.
	public function __constructor() {

	}

	//Implementamos un método para insertar registros.
	public function insertar( $idproveedor, $idusuario, $tipo_comprobante, $serie_comprobante, $num_comprobante, $fecha_hora, $impuesto, $total_compra, $idarticulo, $cantidad, $precio_compra, $precio_venta ) {
		$sql = "INSERT INTO ingreso ( idproveedor, idusuario, tipo_comprobante, serie_comprobante, num_comprobante, fecha_hora, impuesto, total_compra, estado ) VALUES ('$idproveedor', '$idusuario', '$tipo_comprobante', '$serie_comprobante', '$num_comprobante', '$fecha_hora', '$impuesto', '$total_compra', 'Aceptado')";
		$idingresonew = ejecutarConsulta_returnID( $sql );
		$num_elementos = 0;
		$sw = true;
		while ($num_elementos < count($idarticulo)) {
			$sql_detalle = "INSERT INTO detalle_ingreso ( idingreso, idarticulo, cantidad, precio_compra, precio_venta) VALUES ( '$idingresonew', '$idarticulo[$num_elementos]', '$cantidad[$num_elementos]', '$precio_compra[$num_elementos]', '$precio_venta[$num_elementos]' )";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;
		}
		return $sw;
	}

	//Implementamos un método para desactivar la categoria.
	public function anular( $idingreso ) {
		$sql = "UPDATE ingreso SET estado = 'Anulado' WHERE idingreso = '$idingreso'";
		return ejecutarConsulta( $sql );
	}

	//Implementa un método para mostrar los datos de un registro a modificar.
	public function mostrar( $idingreso ) {
		$sql = "SELECT i.idingreso, DATE(i.fecha_hora) as fecha, i.idproveedor, p.nombre as proveedor, u.idusuario, u.nombre as usuario, i.tipo_comprobante, i.serie_comprobante, i.num_comprobante, i.total_compra, i.impuesto, i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor = p.idpersona INNER JOIN usuario u ON i.idusuario = u.idusuario WHERE idingreso = '$idingreso'";
		return ejecutarConsultaSimpleFila( $sql );
	}

	//Implementar un método para listar los registros.
	public function listar() {
		$sql = "SELECT i.idingreso, DATE(i.fecha_hora) as fecha, i.idproveedor, p.nombre as proveedor, u.idusuario, u.nombre as usuario, i.tipo_comprobante, i.serie_comprobante, i.num_comprobante, i.total_compra, i.impuesto, i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor = p.idpersona INNER JOIN usuario u ON i.idusuario = u.idusuario";
		return ejecutarConsulta( $sql );
	}
}


?>