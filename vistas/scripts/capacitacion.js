	var tabla;

	//Función que se ejecuta al inicio.
	function init() {
		mostrarform(false);
		listar();

		$('#formulario').on('submit', function( e ){
			guardaryeditar( e );
		});

		//Cargamos los items al select categoria.
		$.post( '../ajax/capacitacion.php?op=selectCapacitacion', function(r) {
			$('#idtipo_capacitacion').html(r);
			$('#idtipo_capacitacion').selectpicker('refresh');
		} );

		$("#imagenmuestra").hide();
		
	}

	//Función limpiar.
	function limpiar() {
		$('#idcapacitacion').val('');
		$('#fecha').val('');
		$('#idtipo_capacitacion').val('');
		$('#descripcion_capacitacion').val('');
		$('#duracion').val('');
		$('#ci_asistente').val('');
		$('#nombre_asistente').val('');
		$('#realizador_por').val('');
		$('#observaciones').val('');
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

						"url": "../ajax/capacitacion.php?op=listar",
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

			url: '../ajax/capacitacion.php?op=guardaryeditar',
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
	function mostrar(idcapacitacion) {
		$.post("../ajax/capacitacion.php?op=mostrar", {idcapacitacion : idcapacitacion}, function(data, status){
			data = JSON.parse(data);
			mostrarform(true);

			$("#idcapacitacion").val(data.idcapacitacion);
			$("#fecha").val(data.fecha);
			$("#idtipo_capacitacion").val(data.idtipo_capacitacion);
			$("#descripcion_capacitacion").val(data.descripcion_capacitacion);
			$("#duracion").val(data.duracion);
			$("#ci_asistente").val(data.ci_asistente);
			$("#nombre_asistente").val(data.nombre_asistente);
			$("#realizador_por").val(data.realizador_por);
			$("#observaciones").val(data.observaciones);
		})
	}

	//Función para desactivar registros.
	function desactivar(idarticulo){
		bootbox.confirm("¿Esta seguro de dasactivar el articulo?", function(result){
			if (result){
				$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				})
			}
		})
	}

	//Función para activar registros.
	function activar(idarticulo){
		bootbox.confirm("¿Esta seguro de activar el articulo?", function(result){
			if (result){
				$.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				})
			}
		})
	}

	//Función para general el código de barras.
	function generarbarcode(){
		codigo = $("#codigo").val();
		JsBarcode("#barcode", codigo);
		$('#print').show();
	}

	//Función para imprimir en código de barras.
	function imprimir(){
		$("#print").printArea();
	}

	init();

$(document).ready( function(){

});