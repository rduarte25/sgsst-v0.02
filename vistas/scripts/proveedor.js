	var tabla;

	//Función que se ejecuta al inicio.
	function init() {
		mostrarform(false);
		listar();

		$('#formulario').on('submit', function( e ){
			guardaryeditar( e );
		})
	}

	//Función limpiar.
	function limpiar() {
		$('#idpersona').val('');
		$('#nombre').val('');
		$('#tipo_documento').val('');
		$('#num_documento').val('');
		$('#direccion').val('');
		$('#telefono').val('');
		$('#email').val('');
	}

	//Función mostrar formulario.
	function mostrarform( flag ) {
		
		limpiar();
		if ( flag ) {
			$( '#listadoregistros' ).hide();
			$( '#formularioregistros' ).show();
			$( '#btnGuardar' ).prop( 'disabled', false );
			$( '#btnagregar' ).hide();
		} else {
			$( '#listadoregistros' ).show();
			$( '#formularioregistros' ).hide();
			$( '#btnagregar' ).show();
		}
	}

	//Función cancelarform
	function cancelarform() {
		limpiar();
		mostrarform( false );
	}

	//Función listar.
	function listar() {
		tabla = $('#tbllistado').dataTable( {
			"aProcessing":true,
			"aServerSide":true,
			dom: "Blfrtipo",
			buttons: [
						'copy',
						'excel',
						'csv',
						'pdf',
					],
			"ajax": {

						"url": "../ajax/persona.php?op=listarp",
						"type":"GET",
						"dataType": "JSON",
						error: function( e ) {
							console.log( e.responseText );
						}

					},


			"bDistory":true,
			"iDisplayLength":5,
			"order": [[ 0,"desc" ]]
		} ).DataTable();
	}	

	function guardaryeditar(e) {
		e.preventDefault();
		$('#btnGuardar').prop('disabled', true);
		var formData = new FormData($('#formulario')[0]);

		$.ajax({

			url: '../ajax/persona.php?op=guardaryeditar',
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,

			success:function(datos) {
				bootbox.alert(datos);
				mostrarform( false );
				tabla.ajax.reload();

			}

		});

		limpiar();
	}

	//Mostrar 
	function mostrar(idpersona) {
		$.post("../ajax/persona.php?op=mostrar", {idpersona : idpersona}, function(data, status){
			data = JSON.parse(data);
			mostrarform(true);


			$('#idpersona').val(data.idpersona);
			$('#nombre').val(data.nombre);
			$('#tipo_documento').val(data.tipo_documento);
			$('#tipo_documento').selectpicker('refresh');
			$('#num_documento').val(data.num_documento);
			$('#direccion').val(data.direccion);
			$('#telefono').val(data.telefono);
			$('#email').val(data.email);
		})
	}

	//Función para desactivar registros.
	function eliminar(idpersona){
		bootbox.confirm("¿Esta seguro de eliminar el proveedor?", function(result){
			if (result){
				$.post("../ajax/categoria.php?op=eliminar", {idpersona : idpersona}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				})
			}
		})
	}

	init();

$(document).ready( function(){

});