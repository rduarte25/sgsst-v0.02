	var tabla;

	//Función que se ejecuta al inicio.
	function init() {
		mostrarform(false);
		listar();
	}


	//Función mostrar formulario.
	function mostrarform( flag ) {
		//limpiar();
		if ( flag ) {
			$( '#listadoregistros' ).hide();
			$( '#formularioregistros' ).show();
			$( '#btnGuardar' ).prop( 'disabled', false );
			$( '#btnagregar' ).hide();
		} else {
			$( '#listadoregistros' ).show();
			$( '#formularioregistros' ).hide();
			$( '#btnagregar' ).hide();
		}
		
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

						"url": "../ajax/permiso.php?op=listar",
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

	init();

$(document).ready( function(){

});