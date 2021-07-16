<?php 

ob_start();
session_start();
if ( !isset( $_SESSION['nombre'] ) ) {
	header('location:login.html');
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
							<h1 class="box-title">Usuario <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle">Agregar</i></button></h1>
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
									<th>Documento</th>
									<th>Número</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Login</th>
									<th>Foto</th>
									<th>Estado</th>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<th>Opciones</th>
									<th>Nombre</th>
									<th>Documento</th>
									<th>Número</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Login</th>
									<th>Foto</th>
									<th>Estado</th>
								</tfoot>
							</table>
						</div>

						<div class="panel-body" id="formularioregistros">
							<form name="formulario" id="formulario" method="POST" enctype="multipart/form-data" action="">
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="">Nombre</label>
									<input type="hidden" name="idusuario" id="idusuario">
									<input type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" class="form-control" required>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Tipo documento</label>
									
									<select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" required>
										<option value="DNI">DNI</option>
										<option value="RUC">RUC</option>
										<option value="CEDULA">CEDULA</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Número de documento</label>
									<input type="text" name="num_documento" id="num_documento" class="form-control" placeholder="Número de documento" required maxlength="20">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Dirección</label>
									<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" maxlength="70">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Teléfono</label>
									<input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" maxlength="20">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Email</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="Email" maxlength="50">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Cargo</label>
									<input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo" maxlength="20">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Login</label>
									<input type="text" name="login" id="login" class="form-control" placeholder="Login" maxlength="20" required>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Clave</label>
									<input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" maxlength="64" required>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Permisos</label>
									<ul style="list-style: none;" id="permisos">
										
									</ul>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="">Imagen</label>
									<input type="file" name="imagen" id="imagen" class="form-control">
									<input type="hidden" name="imagenactual" id="imagenactual">
									<img src="" width="150px" height="120" id="imagenmuestra" alt="">
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
<script type="text/javascript" src="scripts/usuario.js"></script>

<?php 

};
ob_end_flush();


?>