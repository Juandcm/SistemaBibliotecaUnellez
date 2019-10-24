<?php session_start();
include_once '../Modelo/Mensaje.php';
$mensajeUsuarioNormal = new Mensaje();
$mensajeUsuarioGeneral = new Mensaje();

// Session Usuario
$DataUsuario = !empty($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$id = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$permiso = !empty($DataUsuario['usuario']['permiso'])?$DataUsuario['usuario']['permiso']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$idMensaje = isset($_POST['idMensaje'])?$_POST['idMensaje']:'';

$mensaje = isset($_POST['mensaje'])?limpiar($_POST['mensaje']):'';
$idUsuarioDelMensaje = isset($_POST['idUsuarioDelMensaje'])?limpiar($_POST['idUsuarioDelMensaje']):'';

$sessData = array();

$op = isset($_GET['op'])?limpiar($_GET['op']):'No';

switch ($op) {
	case 'cargarNotificaciones':
	$mensajeUsuarioNormal->cargarNotificaciones($idUsuario);
	break;

	case 'mostrarCantidadNotificaciones':
	$mensajeUsuarioNormal->mostrarCantidadNotificaciones($idUsuario);
	break;
	
	case 'mostrarNotificacionNormal':
	$mensajeUsuarioNormal->mostrarNotificacionNormal($idUsuario,$permiso);
	break;

	case 'eliminarMensaje':
	$mensajeUsuarioGeneral->eliminarMensaje($idMensaje);		
	break;

	case 'EnviarMensajeAdministrador':
	$mensajeUsuarioGeneral->EnviarMensajeAdministrador($idUsuarioDelMensaje,$idUsuario,$mensaje);
	break;

	case 'verMensaje':
	$mensajeUsuarioGeneral->verMensaje($idMensaje,$permiso);
	break;

	
	default:
	break;
}






?>
