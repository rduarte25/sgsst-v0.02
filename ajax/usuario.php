<?php 

require_once '../modelos/class-usuario.php';

$usuario = new Usuario();

//Validar idusuario.
if ( isset( $_POST['idusuario'] ) ) {
	$idusuario = limpiarCadena( $_POST['idusuario'] );
} else {
	$idusuario = '';	
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

//Validar cargo.
if ( isset( $_POST['idcargo'] ) ) {
	$idcargo = limpiarCadena( $_POST['idcargo'] );
} else {
	$idcargo = '';	
}

//Validar login.
if ( isset( $_POST['login'] ) ) {
	$login = limpiarCadena( $_POST['login'] );
} else {
	$login = '';	
}

//Validar clave.
if ( isset( $_POST['password'] ) ) {
	$password = limpiarCadena( $_POST['password'] );
} else {
	$password = '';	
}

//Validar clave.
if ( isset( $_POST['confirmar_password'] ) ) {
	$confirmar_password = limpiarCadena( $_POST['confirmar_password'] );
} else {
	$confirmar_password = '';	
}

//Validar imagen.
if ( isset( $_POST['imagen'] ) ) {
	$imagen = limpiarCadena( $_POST['imagen'] );
} else {
	$imagen = '';	
}

//Validar imagen.
if ( isset( $_POST['permiso'] ) ) {
	$permiso = limpiarCadena( $_POST['permiso'] );
} else {
	$permiso = '';	
}

if ($password != $confirmar_password) {
	$rspta = "Las contraseñas no coinsiden";
}

switch ( $_GET['op'] ) {
	case 'guardaryeditar':

		if (!isset($_FILES['imagen']) || empty(($_FILES['imagen']))) {
			$imagen = "usuario.png";
		} else {
			if ( !file_exists( $_FILES['imagen']['tmp_name'] ) || !is_uploaded_file( $_FILES['imagen']['tmp_name'] )) {
				if (empty($_POST['imagenactual'])) {
					$imagen = "usuario.png";
				} else {
					$imagen = $_POST['imagenactual'];
				}
				
			} else {
				$ext = explode( '.' , $_FILES['imagen']['name'] );
				if ( $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg' || $_FILES['imagen']['type'] == 'image/png' ) {
					$imagen = round( microtime(true) ) . '.' . end( $ext );
					move_uploaded_file( $_FILES["imagen"]["tmp_name"], "/opt/lampp/htdocs/sistema/files/usuarios/" . $imagen );
				}
			}
		}

		
		
		//Hash SHA256 en la contraseña.
		$passwordhash = hash('SHA256', $password);

		if (empty( $idusuario )) {

			$rspta = $usuario->insertar( $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $idcargo, $login, $passwordhash, $imagen, $permiso);
			if ($rspta) {
				echo $rspta = "Usuario registrado";
			} else {
				echo $rspta = "Usuario no se pudo registar todos los datos del usuario";
			}
		} else {
			$rspta = $usuario->editar( $idusuario,  $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, $login, $clavehash, $imagen, $_POST['permiso'] );
			if ($rspta) {
				echo $rspta = "Usuario actualizado";
			} else {
				echo $rspta = "Usuario no se pudo actualizar";
			}
		}

		break;

	case 'desactivar':

		$rspta = $usuario->desactivar( $idusuario );
		if ($rspta) {
			echo $rspta = 'Usuario dasactivado';
		} else {
			echo $rspta = 'Usuario no se pudo desactivar';
		}

		break;

	case 'activar':

		$rspta = $usuario->activar( $idusuario );
		if ($rspta) {
			echo $rspta = 'Usuario activado';
		} else {
			echo $rspta = 'Usuario no se pudo activar';
		}

		break;

	case 'mostrar':

		$rspta = $usuario->mostrar( $idusuario );
		//Codificar el resultado usando json.
		echo json_encode( $rspta );

		break;

	case 'listar':

		$rspta = $usuario->listar();
		//Vamos a declarar un array.
		$data = array();
		
		while ( $reg = $rspta->fetch_object() ) {
			$data[] = array(
				'0' =>($reg->condicion)?"<button class='btn btn-warning' onclick='mostrar(".$reg->idusuario.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-danger' onclick='desactivar(".$reg->idusuario.")'><i class='fa fa-close'></i></button>":"<button class='btn btn-warning' onclick='mostrar(".$reg->idusuario.")'><i class='fa fa-pencil'></i></button>"." "."<button class='btn btn-primary' onclick='activar(".$reg->idusuario.")'><i class='fa fa-check'></i></button>",
				'1' => $reg->nombre,
				'2' => $reg->tipo_documento,
				'3' => $reg->num_documento,
				'4' => $reg->telefono,
				'5' => $reg->email,
				'6' => $reg->login,
				'7' => "<img src='../files/usuarios/". $reg->imagen ."' height='50px width='50px'/>",
				'8' => ($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
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

	case 'permisos':

		//Obtenemos todos los permisos de la tabla permisos.
		require_once '../modelos/class-permiso.php';
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario.
		$id = $_GET['id'];
		$marcados = $usuario->listarmarcados( $id );
		//Declaramos el arra para almacenar todos los permisos marcados.
		$valores = array();

		//Almacenar los permisos asignados al usuario en el array
		while ( $per = $marcados->fetch_object() ) {
			array_push($valores, $per->idpermiso);
		}

		//Mostramos la lista de permisos en la vista y si estan o no marcados.
		while ( $reg = $rspta->fetch_object() ) {
			$sw = in_array($reg->idpermiso, $valores)?'checked':'';
			echo "<li><input type='checkbox' ". $sw ." name='permiso[]' value='".$reg->idpermiso."'>".$reg->nombre."</li>";
			}

		break;

	case 'verificar':

		$logina = $_POST['logina'];
		$clavea = $_POST['clavea'];

		$clavehash = hash('SHA256', $clavea);
		$rspta = $usuario->verificar($logina, $clavehash);

		$fetch = $rspta->fetch_object();

		if (isset( $fetch )) {
			$_SESSION['idusuario'] = $fetch->idusuario;
			$_SESSION['nombre'] = $fetch->nombre;
			$_SESSION['imagen'] = $fetch->imagen;
			$_SESSION['login'] = $fetch->login;

			//Obtener los permisos del usuario.
			$marcados = $usuario->listarmarcados( $fetch->idusuario );
			//Declaramos el array para almacenar todos los permisos marcados.

			$valores = array();

			while ( $per = $marcados->fetch_object() ) {
				array_push( $valores, $per->idpermiso );
			}

		
			in_array( 1, $valores ) ? $_SESSION[ 'acceso' ] = 1 : $_SESSION[ 'acceso' ] = 0;
			in_array( 2, $valores ) ? $_SESSION[ 'almacen' ] = 1 : $_SESSION[ 'almacen' ] = 0;
			in_array( 3, $valores ) ? $_SESSION[ 'compras' ] = 1 : $_SESSION[ 'compras' ] = 0;
			in_array( 4, $valores ) ? $_SESSION[ 'ventas' ] = 1 : $_SESSION[ 'ventas' ] = 0;			
			in_array( 5, $valores ) ? $_SESSION[ 'escritorio' ] = 1 : $_SESSION[ 'escritorio' ] = 0;
			in_array( 6, $valores ) ? $_SESSION[ 'consultac' ] = 1 : $_SESSION[ 'consultac' ] = 0;
			in_array( 7, $valores ) ? $_SESSION[ 'consultav' ] = 1 : $_SESSION[ 'consultav' ] = 0;
		}

		echo json_encode( $fetch );


		break;

		case 'selectCargo':

			require_once '../modelos/class-cargo.php';
			$cargo = new Cargo();
			$rspta = $cargo->select();
			while ( $reg = $rspta->fetch_object() ) {
				echo '<option value=' . $reg->idcargo . '>' . $reg->nombre . '</option>';
			}

			break;

	case 'salir':
		//Limpiamos las variables de sesión.
		session_unset();
		session_destroy();
		header('location: ../index.php');
		break;

}

?>