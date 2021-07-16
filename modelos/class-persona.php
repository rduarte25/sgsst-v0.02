<?php 

//Incluimos inicialmente la conexión a la base de datos.
require '../config/conexion.php';

Class Persona {
	//Implementar nuestro constructor.
	public function __constructor() {

	}

	//Implementamos un método para insertar registros.
	public function insertar( $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email ) {
		$sql = "INSERT INTO persona ( tipo_persona, nombre, tipo_documento, num_documento, direccion, telefono, email ) VALUES ('$tipo_persona', '$nombre', '$tipo_documento', '$num_documento', '$direccion', '$telefono', '$email')";
		return ejecutarConsulta( $sql );
	}

	//Implementamos un método para editar registros.
	public function editar( $idpersona, $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email ) {
		$sql = "UPDATE persona SET tipo_persona = '$tipo_persona', nombre = '$nombre', tipo_documento = '$tipo_documento', num_documento = '$num_documento', direccion = '$direccion', telefono = '$telefono', email = '$email' WHERE idpersona = '$idpersona'";
		return ejecutarConsulta( $sql );
	}

	//Implementamos un método para eliminar la categoria.
	public function eliminar( $idpersona ) {
		$sql = "DELETE FROM persona WHERE idpersona = '$idpersona'";
		return ejecutarConsulta( $sql );
	}

	
	//Implementa un método para mostrar los datos de un registro a modificar.
	public function mostrar( $idpersona ) {
		$sql = "SELECT * FROM persona WHERE idpersona = '$idpersona'";
		return ejecutarConsultaSimpleFila( $sql );
	}

	//Implementar un método para listar los registros.
	public function listarp() {
		$sql = "SELECT * FROM persona WHERE tipo_persona = 'Proveedor'";
		return ejecutarConsulta( $sql );
	}

	//Implementar un método para listar los registros.
	public function listarc() {
		$sql = "SELECT * FROM persona WHERE tipo_persona = 'Cliente'";
		return ejecutarConsulta( $sql );
	}

}


?>