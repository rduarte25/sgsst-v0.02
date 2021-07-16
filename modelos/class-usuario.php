<?php 

session_start();

//Incluimos inicialmente la conexión a la base de datos.
require '../config/conexion.php';

Class Usuario {
	//Implementar nuestro constructor.
	public function __constructor() {

	}

	//Implementamos un método para insertar registros.
	public function insertar( $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $idcargo, $login, $password, $imagen, $permiso ) {
		$sql = "INSERT INTO usuario ( idusuario, nombre, tipo_documento, num_documento, direccion, telefono, email, idcargo, login, password, imagen, condicion ) VALUES (NULL, '$nombre', '$tipo_documento', '$num_documento', '$direccion', '$telefono', '$email', '$idcargo', '$login', '$password', '$imagen', '1')";
		$idusuarionew = ejecutarConsulta_returnID( $sql );
		$num_elementos = 0;
		$sw = true;
		$sql_detalle = "INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES ('$idusuarionew', '$permiso')";
		ejecutarConsulta($sql_detalle) or $sw = false;
		$num_elementos = $num_elementos + 1;
		return $sw;
	}

	//Implementamos un método para editar registros.
	public function editar( $idusuario, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, $login, $password, $imagen, $permisos ) {
		$sql = "UPDATE usuario SET nombre = '$nombre', tipo_documento = '$tipo_documento', num_documento = '$num_documento', direccion = '$direccion', telefono = '$telefono', email = '$email', cargo = '$cargo', login = '$login', password = '$password', imagen = '$imagen' WHERE idusuario = '$idusuario'";
		ejecutarConsulta( $sql );

		//Eliminar todos los permidos asignados para volverlos a registrar.
		$sqldel = "DELETE FROM usuario_permiso WHERE idusuario = '$idusuario'";
		ejecutarConsulta( $sqldel );

		$num_elementos = 0;
		$sw = true;
		while ($num_elementos < count($permisos)) {
			$sql_detalle = "INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES ('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos = $num_elementos + 1;
		}
		return $sw;

	}

	//Implementamos un método para desactivar la categoria.
	public function desactivar( $idusuario ) {
		$sql = "UPDATE usuario SET condicion = '0' WHERE idusuario = '$idusuario'";
		return ejecutarConsulta( $sql );
	}

	//Implementamos un método para activar la categoria.
	public function activar( $idusuario ) {
		$sql = "UPDATE usuario SET condicion = '1' WHERE idusuario= '$idusuario'";
		return ejecutarConsulta( $sql );
	}

	//Implementa un método para mostrar los datos de un registro a modificar.
	public function mostrar( $idusuario ) {
		$sql = "SELECT * FROM usuario WHERE idusuario = '$idusuario'";
		return ejecutarConsultaSimpleFila( $sql );
	}

	//Implementar un método para listar los registros.
	public function listar() {
		$sql = "SELECT * FROM usuario";
		return ejecutarConsulta( $sql );
	}

	//Implementar un método para listar los permisos marcados.
	public function listarmarcados( $idusuario ) {
		$sql = "SELECT * FROM usuario_permiso WHERE idusuario = '$idusuario'";
		return ejecutarConsulta( $sql );
	}

	//Función para verificar el acceso al sistema.
	public function verificar($login, $password){
		$sql = "SELECT idusuario, nombre, tipo_documento, num_documento, direccion, telefono, email, idcargo, login, imagen FROM usuario WHERE login = '$login' AND password = '$password' AND condicion = '1'";

		return ejecutarConsulta( $sql );
	}

}


?>