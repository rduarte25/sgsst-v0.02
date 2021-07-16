<?php 

//Incluimos inicialmente la conexión a la base de datos.
require '../config/conexion.php';

Class Capacitacion {
	//Implementar nuestro constructor.
	public function __constructor() {

	}

	//Implementamos un método para insertar registros.
	public function insertar( $fecha, $idtipo_capacitacion, $descripcion_capacitacion, $duracion, $ci_asistente, $nombre_asistente, $realizado_por, $observaciones ) {

		$sql = "INSERT INTO capacitacion (  idcapacitacion, fecha, idtipo_capacitacion, descripcion_capacitacion, duracion, ci_asistente, nombre_asistente, realizado_por, observaciones) VALUES (NULL, '$fecha', '$idtipo_capacitacion', '$descripcion_capacitacion', '$duracion', '$ci_asistente', '$nombre_asistente', '$realizado_por', '$observaciones')";
		return ejecutarConsulta( $sql );
	}

	//Implementamos un método para editar registros.
	public function editar( $idcapacitacion,  $fecha, $idtipo_capacitacion, $descripcion_capacitacion, $duracion, $ci_asistente, $nombre_asistente, $realizado_por, $observaciones ) {
		$sql = "UPDATE capacitacion SET fecha = '$fecha', idtipo_capacitacion = '$idtipo_capacitacion', descripcion_capacitacion = '$descripcion_capacitacion', duracion = '$duracion', ci_asistente = '$ci_asistente', nombre_asistente = '$nombre_asistente', realizado_por = '$realizado_por', observaciones = '$observaciones' WHERE idcapacitacion = '$idcapacitacion'";
		return ejecutarConsulta( $sql );
	}

	//Implementa un método para mostrar los datos de un registro a modificar.
	public function mostrar( $idcapacitacion ) {
		$sql = "SELECT * FROM capacitacion WHERE idcapacitacion = '$idcapacitacion'";
		return ejecutarConsultaSimpleFila( $sql );
	}

	//Implementar un método para listar los registros.
	public function listar() {
		$sql = "SELECT * FROM capacitacion";
		return ejecutarConsulta( $sql );
	}

	//Implementar un método para listar los registros activos.
	public function listarActivos() {
		$sql = "SELECT a.idarticulo, a.idcategoria, c.nombre as categoria, a.codigo, a.nombre,a.stock, a.descripcion, a.imagen, a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion = '1'";
		return ejecutarConsulta( $sql );
	}

	//Implementar un método para listar los registros y mostrar en el select.
	public function select() {
		$sql = "SELECT * FROM tipo_capacitacion";
		return ejecutarConsulta( $sql );
	}
}


?>