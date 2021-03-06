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
		$('#idcategoria').val('');
		$('#nombre').val('');
		$('#descripcion').val('');
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

						"url": "../ajax/categoria.php?op=listar",
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

			url: '../ajax/categoria.php?op=guardaryeditar',
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
	function mostrar(idcategoria) {
		$.post("../ajax/categoria.php?op=mostrar", {idcategoria : idcategoria}, function(data, status){
			data = JSON.parse(data);
			mostrarform(true);

			$("#nombre").val(data.nombre);
			$("#descripcion").val(data.descripcion);
			$("#idcategoria").val(data.idcategoria);
		})
	}

	//Función para desactivar registros.
	function desactivar(idcategoria){
		bootbox.confirm("¿Esta seguro de dasactivar la categoria?", function(result){
			if (result){
				$.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				})
			}
		})
	}

	//Función para activar registros.
	function activar(idcategoria){
		bootbox.confirm("¿Esta seguro de activar la categoria?", function(result){
			if (result){
				$.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				})
			}
		})
	}


	init();

$(document).ready( function(){

});