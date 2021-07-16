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
							<h1 class="box-title">Permiso <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle">Agregar</i></button></h1>
							<div class="box-tools pull-right">
								
							</div>
						</div>
						<!--/.box-header-->
						<!--centro-->
						
						<div class="panel-body table-responsibe" id="listadoregistros">
							<table id="tbllistado" class="table table-striped table-bordered teble-condensed table-hover">
								<thead>
									<th>Nombre</th>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<th>Nombre</th>
								</tfoot>
							</table>
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
<script type="text/javascript" src="scripts/permiso.js"></script>

<?php 

};
ob_end_flush();


?>