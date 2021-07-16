function init() {
	//Cargamos los items al select categoria.
	$.post( '../ajax/usuario.php?op=selectCargo', function(r) {
		$('#idcargo').html(r);
		$('#idcargo').selectpicker('refresh');
	} );
}

$('#frmRegister').on( 'submit', function(e) {
	e.preventDefault();
	nombre = $('#nombre').val();
	tipo_documento = $('#tipo_documento').val();
	num_documento = $('#num_documento').val();
	direccion = $('#direccion').val();
	telefono = $('#telefono').val();
	email = $('#email').val();
	idcargo = $('#idcargo').val();
	logina = $('#login').val();
	password = $('#password').val();
	confirmar_password = $('#confirmar_password').val();
	imagen = $('#imagen').val();
	permiso = $('#permiso').val();

	$.post( '../ajax/usuario.php?op=guardaryeditar', {
		'nombre' : nombre,
		'tipo_documento' : tipo_documento,
		'num_documento' : num_documento,
		'direccion' : direccion,
		'telefono' : telefono,
		'email' : email,
		'idcargo' : idcargo,
		'login' : logina,
		'password' : password,
		'confirmar_password' : confirmar_password,
		'imagen' : imagen,
		'permiso' : permiso,	
		}, function(data){
		console.log(data);
		if ( data != 'null' ) {
			console.log(data);
			$(location).attr('href', 'categoria.php');
		} else {
			bootbox.alert('Usuario no registrado');
		}
	} );
});

init();