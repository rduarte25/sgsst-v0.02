<?php 

//Incluimos inicialmente la conexión a la base de datos.
require '../config/conexion.php';

Class Cargo {
	//Implementar nuestro constructor.
	public function __constructor() {

	}

	//Implementamos un método para insertar registros.
	public function insertar( $nombre ) {
		$sql = "INSERT INTO cargo ( nombre ) VALUES ('$nombre')";
		return ejecutarConsulta( $sql );
	}

	//Implementamos un método para editar registros.
	public function editar( $idcargo, $nombre ) {
		$sql = "UPDATE cargo SET nombre = '$nombre' WHERE idcargo = '$idcargo'";
		return ejecutarConsulta( $sql );
	}

	//Implementa un método para mostrar los datos de un registro a modificar.
	public function mostrar( $idcargo ) {
		$sql = "SELECT * FROM cargo WHERE idcargo = '$idcargo'";
		return ejecutarConsultaSimpleFila( $sql );
	}

	//Implementar un método para listar los registros.
	public function listar() {
		$sql = "SELECT * FROM cargo";
		return ejecutarConsulta( $sql );
	}

	//Implementar un método para listar los registros y mostrar en el select.
	public function select() {
		$sql = "SELECT * FROM cargo";
		return ejecutarConsulta( $sql );
	}
}


?>