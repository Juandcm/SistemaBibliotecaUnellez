<?php session_start();
include_once '../Modelo/Usuario.php';

$usuarioGeneral = new Usuario();
$usuarioNormal = new Usuario();
$usuarioAdministrador = new Usuario();

// Variables
$nombre = isset($_POST['nombres'])?limpiar($_POST['nombres']):'';
$apellido = isset($_POST['apellidos'])?limpiar($_POST['apellidos']):'';
$email = isset($_POST['email'])?limpiar($_POST['email']):'';
$telefono = isset($_POST['telefono'])?limpiar($_POST['telefono']):'';
$password = isset($_POST['password'])?limpiar(md5($_POST['password'])):'';
$confirm_password = isset($_POST['confirm_password'])?limpiar(md5($_POST['confirm_password'])):'';
$fp_code = isset($_POST['fp_code'])?$_POST['fp_code']:'';
$foto_usuario = isset($_POST['foto_usuario'])?$_POST['foto_usuario']:'user-default.jpg';
$idUsuario = isset($_POST['idUsuario'])?$_POST['idUsuario']:'';
$modificado = date("Y-m-d H:i:s");


$idElUsuario = isset($_POST['id'])?$_POST['id']:'';

$op = isset($_GET['op'])?limpiar($_GET['op']):'No';
$sessData = array();

// Aqui verifico las opciones
switch ($op) {
	case 'No':
	echo "No puedes entrar de esta manera";
	break;

	case 'entrar':
    $usuarioNormal->entrar($email,$password);
    sleep(2);
    break;
    case 'entrar2':
    $usuarioAdministrador->entrar2($email, $password);
    sleep(2);
    break;
    case 'registrar':
    $usuarioNormal->registrar($nombre,$apellido,$email,$telefono,$password,$confirm_password,$foto_usuario);
    sleep(2);
    break;

    case 'restauracontrasena':
    $usuarioGeneral->restaurarcontrasena($email);
    sleep(2);
    break;

    case 'enviarContrasena':
    $usuarioGeneral->enviarContrasena($password,$confirm_password,$fp_code);
    sleep(2);
    break;

    case 'salir':
    if(!empty($_REQUEST['op'])){
        unset($_SESSION['DatosUsuario']);
        session_destroy();
    }
    sleep(2);
    break;

    case 'mostrarUsuario':
    $usuarioNormal->mostrarUsuario($idUsuario);
    sleep(0); 
    break;

    case 'editarUsuarioCompleto':
    $usuarioNormal->editarUsuarioCompleto($idUsuario,$nombre,$apellido,$email,$password,$modificado,$telefono,$foto_usuario);
    break;

    case 'verUsuarioNormal':
    $usuarioAdministrador->verUsuarioNormal();
    break;

    case 'verUsuarioAdministrador':
    $usuarioAdministrador->verUsuarioAdministrador();
    break;
    

    case 'cambiarAdministrador':
    $usuarioAdministrador->cambiarAdministrador($idUsuario);
    break;

    case 'cambiarNormal':
    $usuarioAdministrador->cambiarNormal($idUsuario);
    break;

    case 'DesactivarUsuario':
    $usuarioAdministrador->DesactivarUsuario($idUsuario);
    break;

    case 'ActivarUsuario':
    $usuarioAdministrador->ActivarUsuario($idUsuario);
    break;
    

    case 'VerArchivosDelUsuario':
    $usuarioAdministrador->VerArchivosDelUsuario($idElUsuario);
    break;

    default:
	break;

}

?>
