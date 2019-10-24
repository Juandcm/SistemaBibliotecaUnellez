<?php 
include_once 'funciones.php';

class Mensaje
{
	
	public function __construct(){}

public function cargarNotificaciones($idUsuario){
$sql1 = "UPDATE mensaje SET estado = '1' WHERE estado = '0' AND usuario_idUsuario = '$idUsuario' ";	
ejecutarConsulta($sql1);

$sql2 = "SELECT m.idMensaje, m.mensaje, m.fecha FROM mensaje m INNER JOIN usuarios u ON u.id = m.usuario_idUsuario WHERE u.id = '$idUsuario' ORDER BY m.idMensaje DESC limit 5";
$result2 = ejecutarConsulta($sql2);

$response='';
    /* obtener el array de objetos */
while ($obj = $result2->fetch_object()) {
	/* Formate fecha */

	$fechaOriginal = $obj->fecha;
	$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
	$response = $response ."<div class='dropdown-divider'></div><a href='#' class='dropdown-item' onclick='verMensaje(\"".$obj->idMensaje."\");' data-toggle='modal' data-target='#modalMensaje'><div class='media'><div class='media-body'>
  <h3 class='dropdown-item-title'><p class='text-sm'>".getSubString($obj->mensaje)."</p>
  </h3><p class='text-sm text-muted'><i class='fa fa-clock-o mr-1'></i>".$fechaFormateada."</p></div></div></a>";
}
if(!empty($response)) {
	print $response;
	}
}


public function mostrarCantidadNotificaciones($idUsuario){
$respuesta='';

$sql3="SELECT COUNT(*) total FROM mensaje m INNER JOIN usuarios u ON u.id = m.usuario_idUsuario WHERE u.id = '$idUsuario' AND m.estado = '0' ";
$resultado=ejecutarConsultaSimpleFila($sql3);

if ($resultado > 0) {
 $respuesta = $resultado['total'];
}

if(!empty($respuesta)) {
	print $respuesta;
	}
}

// Aqui muestro todos los mensajes del usario normal
public static function mostrarNotificacionNormal($idUsuario,$permiso){

    $sql2 = "SELECT m.idMensaje, m.usuario_idUsuario2, m.mensaje, m.fecha FROM mensaje m WHERE m.usuario_idUsuario = '$idUsuario' ORDER BY m.idMensaje DESC";
    $data2 = Array();

$prevUser2 = ejecutarConsulta($sql2);

    if($prevUser2){
       
/* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
	$fechaOriginal = $obje->fecha;
	$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));

    $usuario_idUsuario2 = $obje->usuario_idUsuario2;
   if($usuario_idUsuario2=='0' || $usuario_idUsuario2==''){

$data2[]=array(  "0"=>'
<div class="container-fluid">
<div class="row col-spacing">

    <div class="col-12 col-md-6 col-lg-6">
        <p>Mensaje: <strong>'.$obje->mensaje.'</strong></p>
        <p>Fecha: <strong>'.$fechaFormateada.'</strong></p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
<p><strong>Eliminar mensaje </strong><button class="btn btn-danger" onclick="eliminarMensaje(\''.$obje->idMensaje.'\');"><i class="fa fa-trash"></i></button></p>
    </div>

</div>
</div>
'
);
}else{

$sqlFinal = "SELECT u.id, u.nombres, u.apellidos, u.foto_usuario FROM usuarios u WHERE u.id = '$usuario_idUsuario2' LIMIT 1";
$prevUserFinal = ejecutarConsultaSimpleFila($sqlFinal);

if ($prevUserFinal>0 && $permiso=='0' || $permiso=='') {
$nombres = $prevUserFinal['nombres'];
$apellidos = $prevUserFinal['apellidos'];
$id = $prevUserFinal['id'];
$foto = $prevUserFinal['foto_usuario'];

$data2[]=array(  "0"=>'
<div class="container-fluid">
<div class="row col-spacing">

    <div class="col-12 col-md-6 col-lg-6">
    <p>Mensaje enviado por el administrador: <strong>'.$nombres.' '.$apellidos.'</strong> </p>
        <p>Mensaje: <strong>'.$obje->mensaje.'</strong></p>
        <p>Fecha: <strong>'.$fechaFormateada.'</strong></p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
<p><strong>Eliminar mensaje </strong><button class="btn btn-danger" onclick="eliminarMensaje(\''.$obje->idMensaje.'\');"><i class="fa fa-trash"></i></button></p>
<p><strong>Enviar mensaje de respuesta </strong><button class="btn btn-success" onclick="enviarMensaje(\''.$id.'\');" data-toggle="modal" data-target="#enviarMensajeAdministrador"><i class="fa fa-send"></i></button></p>
    </div>

</div>
</div>

    
<div class="media messages-container media-clearfix-xs-min media-grid">
<div class="media-body">
    <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated="">
    <div class="panel-body">
      <div class="media v-middle">
      <div class="media-left">
        <img src="SubidArchivos/archivos/fotosUsuario/'.$foto.'" alt="person" class="media-object img-circle width-50">
      </div>
      <div class="media-body message">
        <h4 class="text-subhead margin-none">Administrador: '.$nombres.' '.$apellidos.' 
        <div class="float-right">
<button class="btn btn-danger" onclick="eliminarMensaje(\''.$obje->idMensaje.'\');"><i class="fa fa-trash"></i></button>
<button class="btn btn-success" onclick="enviarMensaje(\''.$id.'\');" data-toggle="modal" data-target="#enviarMensajeAdministrador"><i class="fa fa-send"></i></button>
        </div>
        </h4>
       
        <p class="text-caption"><i class="fa fa-clock-o"></i> '.$fechaFormateada.'</p>
      </div>
      </div>
        <p>
          '.$obje->mensaje.'
        </p>
      </div>
      </div>
</div>
    
</div>

'
);
}elseif ($prevUserFinal>0 && $permiso=='1') {
$nombres = $prevUserFinal['nombres'];
$apellidos = $prevUserFinal['apellidos'];
$id = $prevUserFinal['id'];

$data2[]=array(  "0"=>'
<div class="container-fluid">
<div class="row col-spacing">

    <div class="col-12 col-md-6 col-lg-6">
    <p>Mensaje enviado por el usuario: <strong>'.$nombres.' '.$apellidos.'</strong> </p>
        <p>Mensaje: <strong>'.$obje->mensaje.'</strong></p>
        <p>Fecha: <strong>'.$fechaFormateada.'</strong></p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
<p><strong>Eliminar mensaje </strong><button class="btn btn-danger" onclick="eliminarMensaje(\''.$obje->idMensaje.'\');"><i class="fa fa-trash"></i></button></p>
<p><strong>Enviar mensaje de respuesta </strong><button class="btn btn-success" onclick="enviarMensaje(\''.$id.'\');" data-toggle="modal" data-target="#enviarMensajeAdministrador"><i class="fa fa-send"></i></button></p>
    </div>

</div>
</div>
'
);
}else{}

}

}
$results2 = array(
    "sEcho"=>1, //Informacion para el datatables
    "iTotalRecords"=>count($data2), //enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>count($data2),//enviamos el total registros a visualizar 
    "aaData"=>$data2
);     
    }else{ echo 'hubo un errror';}

	echo json_encode($results2);

}

public function eliminarMensaje($idMensaje){
$sql2 = "DELETE FROM mensaje WHERE idMensaje = '$idMensaje'";
$eliminar = ejecutarConsulta($sql2);

    if($eliminar){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha eliminado el mensaje';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
echo json_encode($sessData);	
}

public function EnviarMensajeAdministrador($idUsuarioDelMensaje,$idUsuario,$mensaje){
$sql2 = "INSERT INTO mensaje(idMensaje,usuario_idUsuario,usuario_idUsuario2,mensaje,estado) VALUES ('','$idUsuarioDelMensaje','$idUsuario','$mensaje','0')";

$registrar = ejecutarConsulta($sql2);

    if($registrar){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha enviado el mensaje.';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
echo json_encode($sessData);
}

public function verMensaje($idMensaje,$permiso){

    $sql2 = "SELECT m.idMensaje,m.usuario_idUsuario2, m.mensaje, m.fecha FROM mensaje m WHERE m.idMensaje = '$idMensaje' LIMIT 1";
        
    $sessData = Array();
    $prevUser2 = ejecutarConsultaSimpleFila($sql2);

if ($prevUser2>0) {

    $idMensaje = $prevUser2['idMensaje'];
    $usuario_idUsuario2 = $prevUser2['usuario_idUsuario2'];
    $mensaje = $prevUser2['mensaje'];
    $fechaOriginal = $prevUser2['fecha'];
    $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));

    if ($usuario_idUsuario2=='' || $usuario_idUsuario2=='0') {

    $sessData['datos']['tipoDeUsuario'] = 'Notificación del sistema';
    $sessData['datos']['msg'] = '<div class="container-fluid">
<div class="row col-spacing">

    <div class="col-12 col-md-6 col-lg-6">
        <p>Mensaje: <strong>'.$mensaje.'</strong></p>
        <p>Fecha: <strong>'.$fechaFormateada.'</strong></p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
<p><strong>Eliminar mensaje </strong><button class="btn btn-danger" onclick="eliminarMensaje(\''.$idMensaje.'\');"><i class="fa fa-trash"></i></button></p>
    </div>

</div>
</div>

';

}else{

    $sqlFinal = "SELECT u.id, u.nombres, u.apellidos FROM usuarios u WHERE u.id = '$usuario_idUsuario2' LIMIT 1";
    $prevUserFinal = ejecutarConsultaSimpleFila($sqlFinal);

if ($prevUserFinal>0) {
    $nombres = $prevUserFinal['nombres'];
    $apellidos = $prevUserFinal['apellidos'];
    $id = $prevUserFinal['id'];

    $estadoTipoUsuario=($permiso=='0'|| $permiso=='')?'<p>Mensaje enviado por el administrador: <strong>'.$nombres.' '.$apellidos.'</strong> </p>':'<p>Mensaje enviado por el usuario: <strong>'.$nombres.' '.$apellidos.'</strong> </p>';

    $sessData['datos']['tipoDeUsuario'] = $estadoTipoUsuario;
    $sessData['datos']['msg'] = '<div class="container-fluid">
<div class="row col-spacing">
    <div class="col-12 col-md-6 col-lg-6">
        <p>Mensaje: <strong>'.$mensaje.'</strong></p>
        <p>Fecha: <strong>'.$fechaFormateada.'</strong></p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
<p><strong>Eliminar mensaje </strong><button class="btn btn-danger" onclick="eliminarMensaje(\''.$idMensaje.'\');"><i class="fa fa-trash"></i></button></p>
<p><strong>Enviar mensaje de respuesta </strong><button class="btn btn-success" onclick="enviarMensaje(\''.$id.'\');" data-toggle="modal" data-target="#enviarMensajeAdministrador"><i class="fa fa-send"></i></button></p>
    </div>

</div>
</div>';
}else{}

}
}else{}
echo json_encode($sessData);
}

}

?>