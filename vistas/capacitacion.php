<?php 

ob_start();
session_start();
if ( !isset( $_SESSION['nombre'] ) ) {
	header('location:login.php');
} else {

require_once 'header.php'; 

if ( $_SESSION['acceso'] == 1 ) {
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
							<h1 class="box-title">Articulo <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle">Agregar</i></button></h1>
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
									<th>Id Tipo Capacitacion</th>
									<th>Descripcion Capacitacion</th>
									<th>Duracion</th>
									<th>Cedula de Identidad Asistente</th>
									<th>Nombre Asistente</th>
									<th>Realizador Por</th>
									<th>Observaciones</th>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<th>Opciones</th>
									<th>Fecha</th>
									<th>Id Tipo Capacitacion</th>
									<th>Descripcion Capacitacion</th>
									<th>Duracion</th>
									<th>Cedula de Identidad Asistente</th>
									<th>Nombre Asistente</th>
									<th>Realizador Por</th>
									<th>Observaciones</th>
								</tfoot>
							</table>
						</div>

						<div class="panel-body" id="formularioregistros">
							<form name="formulario" id="formulario" method="POST" enctype="multipart/form-data" action="">
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Fecha</label>
									<input type="hidden" name="idcapacitacion" id="idcapacitacion">
									<input type="date" name="fecha" id="fecha" class="form-control" required>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Categoria</label>
									<select name="idtipo_capacitacion" id="idtipo_capacitacion" class="form-control selectpicker" data-live-search='true' required></select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Descripción</label>
									<textarea name="descripcion_capacitacion" id="descripcion_capacitacion" maxlength="200" placeholder="Descripción" class="form-control"></textarea> 
								</div>


								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Duracion</label>
									<input type="number" id="duracion" name="duracion" class="form-control"> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Cedula de identidad del asistente</label>
									<input type="text" id="ci_asistente" name="ci_asistente" placeholder="Cedula de Indentidad Asistente" class="form-control"> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Nombre Asistente</label>
									<input type="text" id="nombre_asistente" name="nombre_asistente" placeholder="Nombre Asistente" class="form-control"> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Realizador por</label>
									<input type="text" id="realizado_por" name="realizado_por" placeholder="Realizador Por" class="form-control"> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Observaciones</label>
									<textarea name="observaciones" id="observaciones" maxlength="200" placeholder="Observaciones" class="form-control"></textarea> 
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/capacitacion.js"></script>

<?php 

};
ob_end_flush();


?>