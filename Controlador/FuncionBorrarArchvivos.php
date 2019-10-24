<?php
include_once '../Modelo/BorrarArchivos.php';
// No me va a mostrar ningun error
error_reporting(0);

$eliminarDesdeAdministrador = isset($_GET['op'])?$_GET['op']:'';

$eliminarDocumentoUsuario = new EliminarArchivos();
$direccionArchivosUsuario='../SubidArchivos/archivos/archivosUsuario/';
$tipoArchivo='url_archivo';
$tabla='documento';


$eliminarFotoUsuario = new EliminarArchivos();
$direccionFotosUsuario='../SubidArchivos/archivos/fotosUsuario/';
$tipoArchivo2='foto_usuario';
$tablausuario='usuarios';



switch ($eliminarDesdeAdministrador) {
    case 'EliminarArchivosViejos':
    $eliminarDocumentoUsuario->eliminarArchivosUsuario($direccionArchivosUsuario,$tabla,$tipoArchivo);
    $eliminarFotoUsuario->eliminarArchivosUsuario($direccionFotosUsuario,$tablausuario,$tipoArchivo2);
    break;
    
    default:
    $eliminarDocumentoUsuario->eliminarArchivosUsuario($direccionArchivosUsuario,$tabla,$tipoArchivo);
    $eliminarFotoUsuario->eliminarArchivosUsuario($direccionFotosUsuario,$tablausuario,$tipoArchivo2);
    break;
}


?>