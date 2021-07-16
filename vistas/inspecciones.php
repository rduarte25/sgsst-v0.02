<?php 

ob_start();
session_start();
if ( !isset( $_SESSION['nombre'] ) ) {
	header('location:login.html');
} else {

require_once 'header.php'; 

if ( $_SESSION['almacen'] == 1 ) {
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
							<h1 class="box-title">Proveedor <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle">Agregar</i></button></h1>
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
									<th>Tipo de Documento</th>
									<th>Número de Documento</th>
									<th>Teléfono</th>
									<th>Email</th>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<th>Opciones</th>
									<th>Nombre</th>
									<th>Tipo de Documento</th>
									<th>Número de Documento</th>
									<th>Teléfono</th>
									<th>Email</th>
								</tfoot>
							</table>
						</div>

						<div class="panel-body" id="formularioregistros">
							<form name="formulario" id="formulario" method="POST" action="">
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Nombre</label>
									<input type="hidden" name="idpersona" id="idpersona">
									<input type="hidden" name="tipo_persona" id="tipo_persona" value="Proveedor">
									<input type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del proveedor" required class="form-control">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Tipo de documento</label>
									<select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required=>
										<option value="DNI">DNI</option>
										<option value="RUC">RUC</option>
										<option value="CEDULA">CEDULA</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Número de documento</label>
									<input type="text" name="num_documento" id="num_documento" placeholder="Número de documento" class="form-control" maxlength="20">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Dirección</label>
									<input type="text" name="direccion" id="direccion" placeholder="Dirección" class="form-control" maxlength="70">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Teléfono</label>
									<input type="text" name="telefono" id="telefono" placeholder="Teléfono" class="form-control" maxlength="20">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Email</label>
									<input type="email" name="email" id="email" placeholder="Email" class="form-control" maxlength="20">
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


<?php require_once 'footer.php'; 

} else {
	require 'noacceso.php';
}
?>
<script type="text/javascript" src="scripts/proveedor.js"></script>

<?php 

};
ob_end_flush();


?>