<?php 

ob_start();
session_start();
if ( !isset( $_SESSION['nombre'] ) ) {
	header('location:login.php');
} else {

	require_once 'header.php'; 

	if ( $_SESSION[ 'almacen' ] == 1 ) {

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
								<h1 class="box-title">Categoria <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle">Agregar</i></button></h1>
								<div class="box-tools pull-right">
									
								</div>
							</div>
							<!--/.box-header-->
							<!--centro-->
							
							<div class="panel-body table-responsibe" id="listadoregistros">
								<table id="tbllistado" class="table table-striped table-bordered teble-condensed table-hover">
									<thead>
										<th>Opciones</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Estado</th>
									</thead>
									<tbody>
										
									</tbody>
									<tfoot>
										<th>Opciones</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Estado</th>
									</tfoot>
								</table>
							</div>

							<div class="panel-body" id="formularioregistros">
								<form name="formulario" id="formulario" method="POST" action="">
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="">Nombre</label>
										<input type="hidden" name="idcategoria" id="idcategoria">
										<input type="text" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required class="form-control">
									</div>

									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="">Descripción</label>
										<textarea name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción" class="form-control"></textarea> 
									</div>
									
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>Guardar</button> 

										<button class="btn btn-danger" onclick="cancelarform()" type="button" id=""><i class="fa fa-arrow-circle-left"></i>Cancelar</button> 
									</div>


								</form>
							</div>
							<!--Fin centro-->
							
							
						</div>
					</div>
				</div>
			</section>

		</div>


	<?php 

	} else {
		require 'noacceso.php';
	}

	require_once 'footer.php'; ?>
	<script type="text/javascript" src="scripts/categoria.js"></script>

<?php 

};
ob_end_flush();


?>