	var tabla;

	//Función que se ejecuta al inicio.
	function init() {
		mostrarform(false);
		listar();

		$('#formulario').on('submit', function( e ){
			guardaryeditar( e );
		});
		//Cargamos items al select proveedor.
		$.post('../ajax/ingreso.php?op=selectProveedor', function(r){
			$('#idproveedor').html(r);
			$('#idproveedor').selectpicker('refresh');
		});
	}

	//Función limpiar.
	function limpiar() {
		$('#idproveedor').val('');
		$('#proveedor').val('');
		$('#serie_comprobante').val('');
		$('#num_comprobante').val('');
		$('#fecha_hora').val('');
		$('#impuesto').val('');
		$('#total_compra').val('');
		$('.filas').remove();
		$('#total').html('0')
	}

	//Función mostrar formulario.
	function mostrarform( flag ) {
		
		limpiar();
		if ( flag ) {
			$( '#listadoregistros' ).hide();
			$( '#formularioregistros' ).show();
			$( '#btnGuardar' ).prop( 'disabled', false );
			$( '#btnagregar' ).hide();
			listarArticulos();
			$( '#guardar' ).hide();
			$( '#btnGuardar' ).show();
			$( '#btnCancelar' ).show();
			$( '#btnAgregarArt' ).show();
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

						"url": "../ajax/ingreso.php?op=listar",
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

	//Función listar.
	function listarArticulos() {
		tabla = $('#tblarticulos').dataTable( {
			"aProcessing":true,
			"aServerSide":true,
			dom: "Blfrtipo",
			buttons: [
					],
			"ajax": {

						"url": "../ajax/ingreso.php?op=listarArticulos",
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
		//$('#btnGuardar').prop('disabled', true);
		var formData = new FormData($('#formulario')[0]);

		$.ajax({

			url: '../ajax/ingreso.php?op=guardaryeditar',
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,

			success:function(datos) {
				bootbox.alert(datos);
				mostrarform( false );
				listar();

			}

		});

		limpiar();
	}

	//Mostrar 
	function mostrar(idarticulo) {
		$.post("../ajax/ingreso.php?op=mostrar", {idarticulo : idarticulo}, function(data, status){
			data = JSON.parse(data);
			mostrarform(true);

			$("#idcategoria").val(data.idcategoria);
			$("#idcategoria").selectpicker('refresh');
			$("#codigo").val(data.codigo);
			$("#nombre").val(data.nombre);
			$("#stock").val(data.stock);
			$("#descripcion").val(data.descripcion);
			$("#imagenmuestra").show();
			$("#imagenmuestra").attr("src", "../files/articulos/"+data.imagen);
			$("#imagenactual").val(data.imagen);
			$("#idarticulo").val(data.idarticulo);
			generarbarcode();
		})
	}

	//Función para desactivar registros.
	function anular(idarticulo){
		bootbox.confirm("¿Esta seguro de anular el ingreso?", function(result){
			if (result){
				$.post("../ajax/ingreso.php?op=anular", {idingreso: idingreso}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				})
			}
		})
	}

	var impuesto = 18;
	var cont = 0;
	var detalles = 0;
	$('#guardar').hide();
	$('#tipo_comprobante').change(marcarImpuesto);
	function marcarImpuesto(){
		var tipo_comprobante = $('#tipo_comprobante option:selected').text();
		if ( tipo_comprobante == 'Factura' ){
			$('#impuesto').val(impuesto);
		} else {
			$('#impuesto').val('0');
		}
	}

	function agregarDetalle( idarticulo, articulo ){
		var cantidad = 1;
		var precio_compra = 1;
		var precio_venta = 1;
		if ( idarticulo != '' ) {
			var subtotal = cantidad * precio_compra;
			var fila = '<tr class="filas" id="fila'+cont+'">'+
			'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</></td>'+
			'<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
			'<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
			'<td><input type="number" name="precio_compra[]" id="precio_compra[]" value="'+precio_compra+'"></td>'+
			'<td><input type="number" name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>'+
			'<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
			'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
			'</tr>';
			cont++;
			detalles++;
			$('#detalles').append(fila);
			modificarSubtotales();
		} else {
			bootbox.alert( 'Error al ingresar el detalle, revise los datos del articulo' );
		}
	}

	function modificarSubtotales(){
		var cant = document.getElementsByName('cantidad[]');
		var prec = document.getElementsByName('precio_compra[]');
		var sub = document.getElementsByName('subtotal');
		for (var i = 0; i < cant.length; i++) {
			var inpC = cant[i];
			var inpP = prec[i];
			var inpS = sub[i];
			inpS.value = inpC.value * inpP.value;
			document.getElementsByName('subtotal')[i].innerHTML = inpS.value; 
		}
		calcularTotales();
	}

	function calcularTotales(){
		var sub = document.getElementsByName('subtotal');
		var total = 0;
		for ( var i = 0; i < sub.length; i++ ){
			total += document.getElementsByName('subtotal')[i].value;
		}
		$('#total').html('S/ '+total);
		$('#total_compra').val(total);
		evaluar();
	}

	function evaluar(){
		if ( detalles > 0 ) {
			$('#guardar').show();
		} else {
			$('#guardar').hide();
			cont=0;
		}
	}

	function eliminarDetalle( indice ){
		$('#fila'+indice).remove();
		calcularTotales();
		detalles--;
	}

	init();

$(document).ready( function(){

});