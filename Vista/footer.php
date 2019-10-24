<?php 
$permiso1 = isset($DataUsuario['usuario']['permiso'])?$DataUsuario['usuario']['permiso']:'';
$vista1 = isset($_REQUEST['vista'])?$_REQUEST['vista']:'No';
?>

</div><!--Cierra row-->
</div>



</div>
</div><!--Panel cierra-->


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/modernizr-custom.js"></script>

<!-- Último minificado bootstrap js y sweetalert2-->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>

<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>

<!-- Revision de formularios y Subida de archivos -->
<script src="assets/js/jquery.fine-uploader.min.js"></script>
<script src="assets/js/parsley.min.js"></script>
<script src="assets/js/es.js"></script>
<script src="assets/js/jquery.formance.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<?php 
switch ($vista1) {
	case 'No':
    if ($permiso1 == '0' || $permiso1 == '1') {
	?>
<!-- Graficas -->
<script src="assets/js/highcharts/highcharts.js"></script>
<script src="assets/js/highcharts/drilldown.js"></script>
<script src="assets/js/highcharts/exporting.js"></script>
	<?php	
    }else{}
	break;

	case 'mostrarNotificacionNormal':
	?>
<!-- Datatables -->
<script src="assets/Datatables/jquery.dataTables.min.js"></script>
<script src="assets/Datatables/dataTables.buttons.min.js"></script>
<script src="assets/Datatables/dataTables.responsive.min.js"></script>
<script src="assets/Datatables/buttons.colVis.min.js"></script>
<script src="assets/Datatables/jszip.min.js"></script>
<script src="assets/Datatables/pdfmake.min.js"></script>
<script src="assets/Datatables/vfs_fonts.js"></script>
<script src="assets/Datatables/buttons.html5.min.js"></script>
	<?php 
	break;

	case 'DocumentoUsuario':
	?>
<!-- Datatables -->
<script src="assets/Datatables/jquery.dataTables.min.js"></script>
<script src="assets/Datatables/dataTables.buttons.min.js"></script>
<script src="assets/Datatables/dataTables.responsive.min.js"></script>
<script src="assets/Datatables/buttons.colVis.min.js"></script>
<script src="assets/Datatables/jszip.min.js"></script>
<script src="assets/Datatables/pdfmake.min.js"></script>
<script src="assets/Datatables/vfs_fonts.js"></script>
<script src="assets/Datatables/buttons.html5.min.js"></script>

	<?php 
	break;

	case 'ArchivosUsuarios':
	?>
<!-- Datatables -->
<script src="assets/Datatables/jquery.dataTables.min.js"></script>
<script src="assets/Datatables/dataTables.buttons.min.js"></script>
<script src="assets/Datatables/dataTables.responsive.min.js"></script>
<script src="assets/Datatables/buttons.colVis.min.js"></script>
<script src="assets/Datatables/jszip.min.js"></script>
<script src="assets/Datatables/pdfmake.min.js"></script>
<script src="assets/Datatables/vfs_fonts.js"></script>
<script src="assets/Datatables/buttons.html5.min.js"></script>

	<?php 
	break;
	
	case 'VerTodosLosUsuariosEn1':
	?>
<!-- Datatables -->
<script src="assets/Datatables/jquery.dataTables.min.js"></script>
<script src="assets/Datatables/dataTables.buttons.min.js"></script>
<script src="assets/Datatables/dataTables.responsive.min.js"></script>
<script src="assets/Datatables/buttons.colVis.min.js"></script>
<script src="assets/Datatables/jszip.min.js"></script>
<script src="assets/Datatables/pdfmake.min.js"></script>
<script src="assets/Datatables/vfs_fonts.js"></script>
<script src="assets/Datatables/buttons.html5.min.js"></script>

	<?php 
	break;

	case 'MostrarDocumentos':
	?>
<!-- Datatables -->
<script src="assets/Datatables/jquery.dataTables.min.js"></script>
<script src="assets/Datatables/dataTables.buttons.min.js"></script>
<script src="assets/Datatables/dataTables.responsive.min.js"></script>
<script src="assets/Datatables/buttons.colVis.min.js"></script>
<script src="assets/Datatables/jszip.min.js"></script>
<script src="assets/Datatables/pdfmake.min.js"></script>
<script src="assets/Datatables/vfs_fonts.js"></script>
<script src="assets/Datatables/buttons.html5.min.js"></script>
	<?php 
	break;

	case 'mostrarNotificacionAdministrador':
	?>
<!-- Datatables -->
<script src="assets/Datatables/jquery.dataTables.min.js"></script>
<script src="assets/Datatables/dataTables.buttons.min.js"></script>
<script src="assets/Datatables/dataTables.responsive.min.js"></script>
<script src="assets/Datatables/buttons.colVis.min.js"></script>
<script src="assets/Datatables/jszip.min.js"></script>
<script src="assets/Datatables/pdfmake.min.js"></script>
<script src="assets/Datatables/vfs_fonts.js"></script>
<script src="assets/Datatables/buttons.html5.min.js"></script>
	<?php 
	break;
	default:
    if ($permiso1 == '0' || $permiso1 == '1') {
	?>
<!-- Graficas -->
<script src="assets/js/highcharts/highcharts.js"></script>
<script src="assets/js/highcharts/drilldown.js"></script>
<script src="assets/js/highcharts/exporting.js"></script>
	<?php	
    }else{}
	break;
}
?>

<!-- Tabs diferentes -->
<script src="assets/js/jquery-ui-tabs.js"></script>
<!-- Jquery Principal -->
<script src="assets/js/interaccion.js"></script>



</body>
</html>



