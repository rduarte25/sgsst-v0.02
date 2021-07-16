<?php 

ob_start();
session_start();
if ( !isset( $_SESSION['nombre'] ) ) {
	header('location:login.html');
} else {

	require_once 'header.php'; 

	if ( $_SESSION[ 'compras' ] == 1 ) {

	?>
	


	<!--Contenido-->
		<!--Content Wrapper, Contais page contect-->
		<div class="content-wrapper">
			
			<!--Main Content-->
			
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h1 class="box-title">Ingreso <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle">Agregar</i></button></h1>
								<div class="box-tools pull-right">
									
								</div>
							</div>
							<!--/.box-header-->
							<!--centro-->
							
							<div class="panel-body table-responsibe" id="listadoregistros">
								<table id="tbllistado" class="table table-striped table-bordered teble-condensed table-hover">
									<thead>
										<th>Opciones</th>
										<th>Fecha</th>
										<th>Proveedor</th>
										<th>Usuario</th>
										<th>Documento</th>
										<th>Número</th>
										<th>Total Compra</th>
										<th>Estado</th>
									</thead>
									<tbody>
										
									</tbody>
									<tfoot>
										<th>Opciones</th>
										<th>Fecha</th>
										<th>Proveedor</th>
										<th>Usuario</th>
										<th>Documento</th>
										<th>Número</th>
										<th>Total Compra</th>
										<th>Estado</th>
									</tfoot>
								</table>
							</div>

							<div class="panel-body" id="formularioregistros">
								<form name="formulario" id="formulario" method="POST" action="">
									<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<label for="">Proveedor</label>
										<input type="hidden" name="idingreso" id="idingreso">
										<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true" required >
											
										</select>
									</div>

									<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<label for="">Fecha</label>
										<input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required > 
									</div>

									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="">Tipo de comprobante </label>
										<select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required>
											<option value="Boleta">Boleta</option>
											<option value="Factura">Factura</option>
											<option value="Ticket">Ticket</option>
										</select>
									</div>

									<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label for="">Serie:</label>
										<input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie" required > 
									</div>

									<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label for="">Número:</label>
										<input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required > 
									</div>

									<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label for="">Impuesto:</label>
										<input type="text" class="form-control" name="impuesto" id="impuesto" required > 
									</div>

									<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a href="#myModal" data-toggle="modal"><button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>Agregar Articulos</button></a> 
									</div>

									<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<table class="table table-striped table-bordered table-condensed table-hover" id="detalles">
											<thead style="background-color: #a9d0f5">
												<th>Opciones</th>
												<th>Articulo</th>
												<th>Cantidad</th>
												<th>Precio Compra</th>
												<th>Precio Venta</th>
												<th>Subtotal</th>
											</thead>
											<tfoot>
												<th>TOTAL</th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th><h4 id="total">S/. 0.00 </h4><input type="hidden" name="total_compra" id="total_compra"></th>
											</tfoot>
											<tbody>
												
											</tbody>
										</table>
									</div>
									
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
										<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>Guardar</button> 

										<button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i>Cancelar</button> 
									</div>


								</form>
							</div>
							<!--Fin centro-->
							
							
						</div>
					</div>
				</div>
			</section>

		</div>

		<!--Modal-->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="model-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" data-dismiss="modal" aria_hidden="true" class="close">&times;</button>
						<h4 class="modal-title">Seleccione un articulo</h4>
					</div>
					<div class="modal-body">
						<table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
							<thead>
								<th>Opciones</th>
								<th>Nombre</th>
								<th>Categoria</th>
								<th>Código</th>
								<th>Stock</th>
								<th>Imagen</th>
							</thead>
							<tbody>
								
							</tbody>

							<tfoot>
								<th>Opciones</th>
								<th>Nombre</th>
								<th>Categoria</th>
								<th>Código</th>
								<th>Stock</th>
								<th>Imagen</th>
							</tfoot>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	<?php 

	} else {
		require 'noacceso.php';
	}

	require_once 'footer.php'; ?>
	<script type="text/javascript" src="scripts/ingreso.js"></script>

<?php 

};
ob_end_flush();


?>