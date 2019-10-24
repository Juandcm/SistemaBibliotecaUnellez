<?php session_start();
include_once '../Modelo/Archivos.php';

$archivoGeneral = new Archivo();
$archivoUsuarioNormal = new Archivo();
$archivoUsuarioAdministrador = new Archivo();

// Variables
$titulo = isset($_POST['titulo'])?limpiar($_POST['titulo']):'';
$autor = isset($_POST['autor'])?limpiar($_POST['autor']):'';
$resumen = isset($_POST['resumen'])?limpiar($_POST['resumen']):'';
$ubicacionfisica = isset($_POST['ubicacionfisica'])?limpiar($_POST['ubicacionfisica']):'';
$url_archivo = isset($_POST['url_archivo'])?$_POST['url_archivo']:'';
$idDocumento = isset($_POST['idDocumento'])?$_POST['idDocumento']:'';
$idTipoDocumento = isset($_POST['idTipoDocumento'])?$_POST['idTipoDocumento']:'';

$nombreTipo = isset($_POST['nombreTipo'])?limpiar($_POST['nombreTipo']):'';
$descripcionTipo = isset($_POST['descripcionTipo'])?limpiar($_POST['descripcionTipo']):'';
// esta es la variable cuando cambio el option
$datos = isset($_POST['datos'])?limpiar($_POST['datos']):'No';

$imagenDocumento = basename($url_archivo);
$tipoImagenCopiada = pathinfo($imagenDocumento, PATHINFO_EXTENSION);

// Session Usuario
$DataUsuario = !empty($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$id = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';

$SeleccionarAno = isset($_GET['SeleccionarAno'])?$_GET['SeleccionarAno']:'';
$sessData = array();
// Fechas
$creado = date("Y-m-d H:i:s");
$modificado = date("Y-m-d H:i:s");

$op = isset($_GET['op'])?limpiar($_GET['op']):'No';

switch ($datos) {
    case 'No':
    $datos='';
    break;
    case '0':
    $datos='d.titulo';
    break;
    case '1':
    $datos='d.autor';
    break;
    case '2':
    $datos='d.foto_documento';
    break;
    default:
    $datos='';
    break;
}

switch ($tipoImagenCopiada) {
	case 'pdf':
    $foto_documento = 'file-pdf-o';	
    break;
    case 'txt':
    $foto_documento = 'file-text-o';
    break;
    case 'docx':
    $foto_documento = 'file-word-o';
    break;
    case 'doc':
    $foto_documento = 'file-word-o';
    break;
    case 'xls':
    $foto_documento = 'file-excel-o';
    break;
    case 'ppt':
    $foto_documento = 'file-powerpoint-o';
    break;
	default:
    $foto_documento = $tipoImagenCopiada;
	break;
}

switch ($op) {
	case 'No':
	   echo "No puedes entrar de esta manera";
	break;

	case 'subirDocumentos':
    $archivoUsuarioNormal->subirDocumentos($id,$titulo,$autor,$resumen,$foto_documento,$url_archivo,$ubicacionfisica,$creado,$modificado,$idTipoDocumento);
    break;

    case 'listarSoloEstado1':
    $archivoGeneral->listarSoloEstado1($datos);
    break;

    case 'listar0':
    $archivoUsuarioNormal->listar0($idUsuario);
    break;

    case 'listar1':
    $archivoUsuarioNormal->listar1($idUsuario);
    break;

    case 'listarTodosEn0':
    $archivoUsuarioAdministrador->listarTodosEn0();
    break;

    case 'listarTodosEn1':
    $archivoUsuarioAdministrador->listarTodosEn1($idUsuario);
    break;

    case 'aprobar':
    $archivoUsuarioAdministrador->aprobar($idUsuario,$idDocumento);
    break;    
    
    case 'desaprobar':
    $archivoUsuarioAdministrador->desaprobar($idUsuario,$idDocumento);
    break;

    case 'selectCategoria':
    $archivoUsuarioNormal->mostrarTipoDocumento();
    break;

    case 'mostrarTipoDocumentoAdministrador':
    $archivoUsuarioAdministrador->mostrarTipoDocumentoAdministrador();   
    break;

    case 'eliminarDocumento':
    $archivoUsuarioNormal->eliminarDocumento($idDocumento);
    break;

    case 'eliminarTipoDocumento':
    $archivoUsuarioAdministrador->eliminarTipoDocumento($idTipoDocumento);  
    break;

    case 'guardarTipoDocumento':
    $archivoUsuarioAdministrador->guardarTipoDocumento($nombreTipo,$descripcionTipo);
    break;

    case 'mostrarTipoDocumento':
    $archivoUsuarioAdministrador->mostrarTipoDocumento2($idTipoDocumento);
    break;

    case 'editarTipoDocumento':
    $archivoUsuarioAdministrador->editarTipoDocumento($idTipoDocumento,$nombreTipo,$descripcionTipo);     
    break;

    case 'mostrarDocumento':
    $archivoUsuarioNormal->mostrarDocumento($idDocumento); 
    break;

    case 'editarDocumento':
    $modificado = date("Y-m-d H:i:s");
    $archivoUsuarioNormal->editarDocumento($idDocumento,$titulo,$autor,$resumen,$foto_documento,$url_archivo,$ubicacionfisica,$modificado,$idTipoDocumento);
    break;

    case 'MostrarGraficaArchivos':
    $archivoUsuarioAdministrador->MostrarGraficaArchivos();
    break;

    case 'MostrarGraficaArchivosMes':
    $archivoUsuarioAdministrador->MostrarGraficaArchivosMes($SeleccionarAno);
    break;

    case 'graficaGeneralAdministrador':
    $archivoUsuarioAdministrador->graficaGeneralAdministrador();      
    break;

    case 'graficaTotalArchivosNormal':
    $archivoUsuarioNormal->graficaTotalArchivosNormal($idUsuario);
    break;

    case 'MostrarGraficaArchivosNormal':
    $archivoUsuarioNormal->MostrarGraficaArchivosNormal($idUsuario);
    break;

    case 'MostrarGraficaArchivosMesNormal':
    $archivoUsuarioNormal->MostrarGraficaArchivosMesNormal($SeleccionarAno,$idUsuario);
    break;

    case 'contarTipoDocumentos':
    $archivoUsuarioAdministrador->contarTipoDocumentos();
    break;


	default:
	break;

}

?>