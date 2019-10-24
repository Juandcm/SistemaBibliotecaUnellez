<?php 
$permiso2 = isset($DataUsuario['usuario']['permiso'])?$DataUsuario['usuario']['permiso']:'';
$vista2 = isset($_REQUEST['vista'])?$_REQUEST['vista']:'No';
?>
<!DOCTYPE html>
<html>
<head>
<title>Biblioteca Unellez</title>
<!-- Último minificado bootstrap css -->
<link rel="stylesheet" href="assets/css/normalize.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/sweetalert2.min.css">
<link rel="stylesheet" href="assets/css/adminlte.min.css">
<link rel="stylesheet" href="assets/css/fine-uploader-new.css">
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

<?php 
switch ($vista2) {
	case 'No':	
	break;
	case 'mostrarNotificacionNormal':
	?>
<link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="assets/css/demo_table_jui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.custom.css">
	<?php
	break;

	case 'DocumentoUsuario':
	?>
<link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="assets/css/demo_table_jui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.custom.css">
	<?php 
	break;

	case 'VerTodosLosUsuariosEn1':
	?>
<link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="assets/css/demo_table_jui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.custom.css">
	<?php
	break;

	case 'MostrarDocumentos':
	?>
<link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="assets/css/demo_table_jui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.custom.css">
	<?php
	break;

	case 'ArchivosUsuarios':
	?>
<link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="assets/css/demo_table_jui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.custom.css">
	<?php	
	break;

	case 'mostrarNotificacionAdministrador':
	?>
<link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="assets/Datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="assets/css/demo_table_jui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.custom.css">
	<?php		
	break;

	default:
	break;
}
?>

<link rel="stylesheet" href="assets/css/style.css" />
<!-- jQuery libraria incluida -->
</head>
<body class="app hold-transition sidebar-mini">

<div id='loader'>
  <div class="spinner"></div>
</div>

<div>
<div>
<div>
<div class="row">