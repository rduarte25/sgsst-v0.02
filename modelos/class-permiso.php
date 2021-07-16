<?php 

//Incluimos inicialmente la conexión a la base de datos.
require '../config/conexion.php';

Class Permiso {
	//Implementar nuestro constructor.
	public function __constructor() {

	}

	//Implementar un método para listar los registros.
	public function listar() {
		$sql = "SELECT * FROM permiso";
		return ejecutarConsulta( $sql );
	}
}


?>