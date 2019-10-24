<?php 
include_once 'funciones.php';

class Archivo
{
    public function __construct(){}


public function mostrarTipoDocumentoAdministrador(){
$requestData = $_POST;
$columns = array( 
    0 =>'idTipoDocumento'
);

$sql1 = "SELECT COUNT(idTipoDocumento) as total FROM tipodocumento";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}

$sql = "SELECT idTipoDocumento, nombreTipo, descripcion FROM tipodocumento";
    $data = Array();

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" WHERE nombreTipo LIKE '%".addslashes($requestData['search']['value'])."%' ";
}

$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

    $prevUser = ejecutarConsulta($sql);
    if($prevUser){
    /* obtener el array de objetos */
    while ($obj = $prevUser->fetch_object()) {
        $data[]=array( "0"=>'

<div class="container-fluid">
<div class="row">
<div class="col-8">
<p>Nombre de tipo de Documento: <strong>'.$obj->nombreTipo.'</strong></p><p>Descripción: <strong>'.$obj->descripcion.'</strong></p>
</div>
<div class="col-4">
<p>Eliminar tipo de Documento <button class="btn btn-danger" onclick="eliminarTipoDocumento(\''.$obj->idTipoDocumento.'\');"><i class="fa fa-trash-o fa-2x"></i></button></p>
<p>Editar tipo de Documento<button class="btn btn-success" onclick="editarTipoDocumento(\''.$obj->idTipoDocumento.'\');" data-toggle="modal" data-target="#dataUpdate"><i class="fa fa-edit fa-2x"></i></button></p>
</div>
</div>
</div>'
                    );
            }
        $results = array(
        "sEcho"=>intval( $requestData['draw'] ), //Informacion para el datatables
        "iTotalRecords"=>intval( $totalData ), //enviamos el total de registros al datatable 
        "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
        "aaData"=>$data
                        );
        
    }else{ echo 'hubo un errror';}

        echo json_encode($results);
}


// Aqui muestro todos los archivos en estado 1 en el index.php
public function listarSoloEstado1($datos){

$datosBusqueda = empty($datos)?'d.titulo':$datos;
$requestData = $_POST;
$columns = array( 
    0 =>'d.creado'
);

$sql1 = "SELECT COUNT(d.idDocumento) AS total FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario INNER JOIN tipodocumento t ON d.tipoDocumento = t.idTipoDocumento WHERE d.estado = '1'";

$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}

    $sql2 = "SELECT d.titulo, d.autor, d.resumen, d.foto_documento, d.url_archivo, d.ubicacion_fisica_documento,d.creado,d.modificado, d.estado, u.nombres, u.apellidos, u.foto_usuario, t.nombreTipo FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario INNER JOIN tipodocumento t ON d.tipoDocumento = t.idTipoDocumento WHERE d.estado = '1'";

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql2.=" AND ".$datosBusqueda." LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=ejecutarConsulta($sql2);
$totalFiltered = $query->num_rows;

$sql2.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

    $sql3 = "SELECT u.nombres, u.apellidos FROM aprobaciondocumento a INNER JOIN usuarios u ON u.id = a.usuario_idUsuario INNER JOIN documento d ON d.idDocumento = a.documento_idDocumento WHERE d.estado = '1' AND u.permiso = '1'";


$prevUser2 = ejecutarConsulta($sql2);
$prevUser3 = ejecutarConsulta($sql3);
/* obtener el array de objetos */
    $data2 = Array();

    if($prevUser2){

    if ($prevUser3) {
       
    while ($obje = $prevUser2->fetch_object()) {
    $obje2 = $prevUser3->fetch_object();


$fechas = ($obje->creado==$obje->modificado)?'<p><strong>Fecha de Creación: </strong>'.$obje->creado.'</p>':'<p><strong>Fecha de Creación: </strong>'.$obje->creado.'</p>
<p><strong>Fecha de Actualización: </strong>'.$obje->modificado.'</p>';

    $foto = empty($obje->foto_usuario)?'user-default.jpg':$obje->foto_usuario;
        $data2[]=array(  "0"=>'
<div class="container-fluid">
<div class="row col-spacing justify-content-center align-items-center"> 
<div class="col-12 col-md-6 col-lg-6 col-centered">
<article class="card">
<img class="card-img-top img-thumbnail img-fluid imagenUsuario" src="SubidArchivos/archivos/fotosUsuario/'.$foto.'">
<div class="card-body">
<div class="card-subtitle mb-2 text-muted">Subido al sistema por <b>'.$obje->nombres.' '.$obje->apellidos.'</b> el '.$obje->creado.'</div>
<h4 class="card-title">Titulo del Documento: <strong>'.$obje->titulo.'</strong></h4>
<p><strong>Autor(es): </strong>'.$obje->autor.'</p>
<p class="card-text"><strong>Resumen: </strong>'.$obje->resumen.'</p>
<p><strong>Tipo de Documento: </strong>'.$obje->nombreTipo.' </p>
<p><strong>Ubicación física del documento: </strong>'.$obje->ubicacion_fisica_documento.'</p>
'.$fechas.'
<p><strong>Tipo de Archivo: </strong><i class="fa fa-'.$obje->foto_documento.' fa-3x"></i></p>
<p>Documento aprobado por: <strong>'.$obje2->nombres.' '.$obje2->apellidos.'</strong></p>
<p><strong>Descargar el archivo: </strong><a href="SubidArchivos/archivos/archivosUsuario/'.$obje->url_archivo.'" download> <button class="btn btn-3d btn-warning"><i class="fa fa-download"></i></button></a></p>
<!--Revisar esto despues <div class="text-right">                                
<a href="#" class="card-more" data-toggle="read" data-id="1">Leer más... <i class="ion-ios-arrow-right"></i></a>
</div> -->
</div>
</article>
</div>
</div>
</div>'
);
}
        $results2 = array(
        "sEcho"=>intval( $requestData['draw'] ), //Informacion para el datatables
        "iTotalRecords"=>intval( $totalData ), //enviamos el total de registros al datatable 
        "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
        "aaData"=>$data2
                        );

    }else{
        echo "hubo un error";
    }
    
        
    }else{ echo 'hubo un errror';}

        echo json_encode($results2);
}

// Lista todos los documentos del usuario en session con estado 0
public function listar0($idUsuario){
$requestData = $_POST;
$columns = array( 
    0 =>'d.creado'
);
// getting total number records without any search
$sql1 = "SELECT  count(d.idDocumento) total FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario INNER JOIN tipodocumento t ON d.tipoDocumento = t.idTipoDocumento WHERE u.id = '$idUsuario' AND d.estado = '0'";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}
$sql = "SELECT d.idDocumento, d.titulo, d.autor, d.resumen, d.foto_documento, d.url_archivo, d.ubicacion_fisica_documento,d.creado,d.modificado, d.estado, t.nombreTipo FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario INNER JOIN tipodocumento t ON d.tipoDocumento = t.idTipoDocumento WHERE u.id = '$idUsuario' AND d.estado = '0'";
// getting records as per search parameters
if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND d.titulo LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=ejecutarConsulta($sql);

$data = array();
while( $row=$query->fetch_object() ) {  // preparing an array
$fechas = ($row->creado==$row->modificado)?'<p><strong>Fecha de Creación: </strong>'.$row->creado.'</p>':'<p><strong>Fecha de Creación: </strong>'.$row->creado.'</p>
<p><strong>Fecha de Actualización: </strong>'.$row->modificado.'</p>';

    $data[] = array('0' =>'<div class="container-fluid">
<div class="row col-spacing justify-content-center align-items-center"> 
<div class="col-12 col-md-6 col-lg-6 col-centered">
<article class="card">
<div class="card-body">
<h4 class="card-title">Titulo del Documento: <strong>'.$row->titulo.'</strong></h4>
<p><strong>Autor(es): </strong>'.$row->autor.'</p>
<p class="card-text"><strong>Resumen: </strong>'.$row->resumen.'</p>
<p><strong>Tipo de Documento: </strong>'.$row->nombreTipo.' </p>
<p><strong>Ubicación física del documento: </strong>'.$row->ubicacion_fisica_documento.'</p>
'.$fechas.'
<p><strong>Tipo de Archivo: </strong><i class="fa fa-'.$row->foto_documento.' fa-3x"></i></p>
</div>
</article>
</div>
<div class="col-12 col-md-6 col-lg-6 col-centered">



  <p><strong>Descargar el archivo: </strong><a href="SubidArchivos/archivos/archivosUsuario/'.$row->url_archivo.'" download> <button class="btn btn-warning" id="descargar"><i class="fa fa-download fa-3x"></i></button></a></p>
<p><strong>Eliminar Documento</strong> <button class="btn btn-danger" onclick="eliminarDocumento(\''.$row->idDocumento.'\');"><i class="fa fa-trash fa-3x"></i></button></p>
<p><strong>Editar Documento</strong> <button class="btn btn-success" onclick="editarDocumento(\''.$row->idDocumento.'\');" data-toggle="modal" data-target="#editarDocumento"><i class="fa fa-edit fa-3x"></i></button></p>
</div>
</div>
</div>');
}

$json_data = array(
      "sEcho"=>intval( $requestData['draw'] ),  //Informacion para el datatables
    "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
    "aaData"=>$data
    );
echo json_encode($json_data);  // send data as json format

}
// Lista todos los documentos del usuario en session con estado 0
public function listar1($idUsuario){
$requestData = $_POST;
$columns = array( 
    0 =>'d.creado'
);
// getting total number records without any search
$sql1 = "SELECT  count(d.idDocumento) total FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario INNER JOIN tipodocumento t ON d.tipoDocumento = t.idTipoDocumento WHERE u.id = '$idUsuario' AND d.estado = '1'";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}
$sql = "SELECT d.idDocumento, d.titulo, d.autor, d.resumen, d.foto_documento, d.url_archivo, d.ubicacion_fisica_documento,d.creado,d.modificado, d.estado, t.nombreTipo FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario INNER JOIN tipodocumento t ON d.tipoDocumento = t.idTipoDocumento WHERE u.id = '$idUsuario' AND d.estado = '1'";
// getting records as per search parameters
if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND d.titulo LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=ejecutarConsulta($sql);

$data = array();
while( $row=$query->fetch_object() ) {  // preparing an array
$fechas = ($row->creado==$row->modificado)?'<p><strong>Fecha de Creación: </strong>'.$row->creado.'</p>':'<p><strong>Fecha de Creación: </strong>'.$row->creado.'</p>
<p><strong>Fecha de Actualización: </strong>'.$row->modificado.'</p>';

    $data[] = array('0'=>'<div class="container-fluid">
<div class="row col-spacing justify-content-center align-items-center"> 
<div class="col-12 col-md-6 col-lg-6 col-centered">
<article class="card">
<div class="card-body">
<h4 class="card-title">Titulo del Documento: <strong>'.$row->titulo.'</strong></h4>
<p><strong>Autor(es): </strong>'.$row->autor.'</p>
<p class="card-text"><strong>Resumen: </strong>'.$row->resumen.'</p>
<p><strong>Tipo de Documento: </strong>'.$row->nombreTipo.' </p>
<p><strong>Ubicación física del documento: </strong>'.$row->ubicacion_fisica_documento.'</p>
'.$fechas.'
<p><strong>Tipo de Archivo: </strong><i class="fa fa-'.$row->foto_documento.' fa-3x"></i></p>
</div>
</article>
</div>
<div class="col-12 col-md-6 col-lg-6 col-centered">
  <p><strong>Descargar el archivo: </strong><a href="SubidArchivos/archivos/archivosUsuario/'.$row->url_archivo.'" download> <button class="btn btn-warning" id="descargar"><i class="fa fa-download fa-3x"></i></button></a></p>
<p><strong>Eliminar Documento</strong> <button class="btn btn-danger" onclick="eliminarDocumento(\''.$row->idDocumento.'\');"><i class="fa fa-trash fa-3x"></i></button></p>
<p><strong>Editar Documento</strong> <button class="btn btn-success" onclick="editarDocumento(\''.$row->idDocumento.'\');" data-toggle="modal" data-target="#editarDocumento"><i class="fa fa-edit fa-3x"></i></button></p>

</div>
</div>
</div>');
}

$json_data = array(
      "sEcho"=>intval( $requestData['draw'] ),  //Informacion para el datatables
    "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
    "aaData"=>$data
    );
echo json_encode($json_data);  // send data as json format
}

// Aqui apruebo los documentos como administrador
public function aprobar($idUsuario,$idDocumento){
$arrayNuevo = array();

$sql = "SELECT estado FROM documento WHERE idDocumento='$idDocumento'";
$prevUser = ejecutarConsultaSimpleFila($sql);
if($prevUser > 0){
    $sql2 = "UPDATE documento SET estado = '1' WHERE idDocumento = '$idDocumento'";

    $sql3 = "INSERT INTO aprobaciondocumento (idAprobacion, usuario_idUsuario, documento_idDocumento) VALUES ('', '$idUsuario', '$idDocumento')";

    $sql5 = "SELECT u.id, d.titulo  FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario WHERE d.idDocumento = '$idDocumento'";

    
    $update = ejecutarConsulta($sql2);
    $insertar = ejecutarConsulta($sql3);
    
    if($update && $insertar){

$resultado = ejecutarConsultaSimpleFila($sql5);

if ($resultado > 0) {

 $idUsuario2 = $resultado['id'];
 $mensaje = "El documento ".$resultado['titulo']." ha sido aprobado";

  $sql4="INSERT INTO mensaje(idMensaje,usuario_idUsuario,usuario_idUsuario2,mensaje,estado) VALUES ('','$idUsuario2','','$mensaje','0')";
    $ultimo = ejecutarConsulta($sql4);
    if ($ultimo) {
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha aprobado el documento';
    }else{
       $sessData['estado']['type'] = 'error';
       $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
    }
}else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se encontro el usuario de ese documento.';
}

    }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }

        }else{
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se encontro el documento.';
            }

echo json_encode($sessData);
// echo json_encode($arrayNuevo);
}
// Aqui desapruebo los documentos como administrador
public function desaprobar($idUsuario,$idDocumento){


$sql4 = "SELECT * FROM aprobaciondocumento a WHERE a.usuario_idUsuario = '$idUsuario' AND a.documento_idDocumento = '$idDocumento'"; 
$comprobar = ejecutarConsultaSimpleFila($sql4);
// Comprobar con la tabla aprobaciondocumento
if($comprobar > 0){
    // Elimino el registro de la tabla ya que estoy cambiando el documento a un estado 0
    $sql3 = "DELETE FROM aprobaciondocumento WHERE usuario_idUsuario = '$idUsuario' AND documento_idDocumento = '$idDocumento'";
    ejecutarConsulta($sql3);
}else{}

$sql = "SELECT estado FROM documento WHERE idDocumento='$idDocumento'";
$prevUser = ejecutarConsultaSimpleFila($sql);
if($prevUser > 0){


    $sql2 = "UPDATE documento SET estado = '0' WHERE idDocumento = '$idDocumento'";
    $sql5 = "SELECT u.id, d.titulo  FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario WHERE d.idDocumento = '$idDocumento'";
    
    $update = ejecutarConsulta($sql2);
    
    if($update){

$resultado = ejecutarConsultaSimpleFila($sql5);

if ($resultado > 0) {

 $idUsuario2 = $resultado['id'];
 $mensaje = "El documento ".$resultado['titulo']." ha sido desaprobado";

  $sql4="INSERT INTO mensaje(idMensaje,usuario_idUsuario,usuario_idUsuario2,mensaje,estado) VALUES ('','$idUsuario2','','$mensaje','0')";
    $ultimo = ejecutarConsulta($sql4);
    if ($ultimo) {
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha desaprobado el documento';
    }else{
       $sessData['estado']['type'] = 'error';
       $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
    }
}else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se encontro el usuario de ese documento.';
}


            }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }

        }else{
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se encontro el documento.';
            }

echo json_encode($sessData);
}

public function eliminarDocumento($idDocumento){
$sql2 = "DELETE FROM documento WHERE idDocumento = '$idDocumento'";
$eliminar = ejecutarConsulta($sql2);

    if($eliminar){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha eliminado el documento';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
echo json_encode($sessData);
}

public function eliminarTipoDocumento($idTipoDocumento){
$sql2 = "DELETE FROM tipodocumento WHERE idTipoDocumento = '$idTipoDocumento'";
$eliminar = ejecutarConsulta($sql2);

    if($eliminar){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha eliminado el tipo de documento';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
echo json_encode($sessData);
}



// Esta es la funcion que me permite subir documentos al sistema como usuario normal
public function subirDocumentos($id,$titulo,$autor,$resumen,$foto_documento,$url_archivo,$ubicacionfisica,$creado,$modificado,$idTipoDocumento){

// Aqui verifico de que el correo no este dentro del sistema
    $sql = "SELECT titulo FROM documento WHERE titulo='$titulo'";
    $prevUser = ejecutarConsultaSimpleFila($sql);

if($prevUser > 0){
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Titulo del Documento ya existe, por favor ingrese otro titulo';
}else{
    // Aqui registro al usuario en el sistema
    $sql = "INSERT INTO documento (idDocumento, usuario_idUsuario, titulo, autor, resumen, foto_documento, url_archivo, ubicacion_fisica_documento, creado, modificado, estado, tipoDocumento) VALUES ('', '$id', '$titulo', '$autor', '$resumen', '$foto_documento','$url_archivo','$ubicacionfisica','$creado' ,'$modificado','0', '$idTipoDocumento')";

    $insert = ejecutarConsulta($sql);

if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Se subio el documento al sistema, tienes que esperar que el administrador lo apruebe.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
}
echo json_encode($sessData);
}

// Lista los documentos en estado 1 en la vista administrador
public function listarTodosEn1($idUsuario){
$results2 = array();
$requestData = $_POST;
$columns = array( 
    0 =>'d.creado'
);

$sql1 = "SELECT COUNT(d.idDocumento) as total FROM aprobaciondocumento a INNER JOIN usuarios u ON a.usuario_idUsuario = u.id INNER JOIN documento d ON a.documento_idDocumento = d.idDocumento WHERE d.estado = '1' AND u.id = '$idUsuario'";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}

$sql = "SELECT d.idDocumento ,d.titulo, d.autor, d.resumen, d.foto_documento, d.url_archivo, d.ubicacion_fisica_documento,d.creado,d.modificado, d.estado, u.nombres, u.apellidos, u.foto_usuario FROM aprobaciondocumento a INNER JOIN usuarios u ON a.usuario_idUsuario = u.id INNER JOIN documento d ON a.documento_idDocumento = d.idDocumento WHERE d.estado = '1' AND u.id = '$idUsuario'";

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND d.titulo LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

$prevUser2 = ejecutarConsulta($sql);
    if($prevUser2){
    /* obtener el array de objetos */
    $data2 = Array();
    while ($obje = $prevUser2->fetch_object()) {

$fechas = ($obje->creado==$obje->modificado)?'<p><strong>Fecha de Creación: </strong>'.$obje->creado.'</p>':'<p><strong>Fecha de Creación: </strong>'.$obje->creado.'</p>
<p><strong>Fecha de Actualización: </strong>'.$obje->modificado.'</p>';
     $foto = empty($obje->foto_usuario)?'user-default.jpg':$obje->foto_usuario;
        $data2[]=array(  "0"=>'

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
<article id="mostrandoDocumentos">
<h5 class="text-danger">Titulo del Documento: '.$obje->titulo.'</h5>
<p><strong>Resumen: </strong>'.$obje->resumen.'</p>
<p><strong>Autor(es): </strong>'.$obje->autor.'</p>
<p><strong>Subido por el usuario: </strong>'.$obje->nombres.' '.$obje->apellidos.'</p>
<img class="img-thumbnail" src="SubidArchivos/archivos/fotosUsuario/'.$foto.'">
<p><strong>Ubicación física del documento: </strong>'.$obje->ubicacion_fisica_documento.'</p>
'.$fechas.'
<p><strong>Tipo de documento: </strong><i class="fa fa-'.$obje->foto_documento.' fa-3x"></i></p>
</article>
        </div>
        <div class="col-4">

<p><strong>Descargar el archivo: </strong><a href="SubidArchivos/archivos/archivosUsuario/'.$obje->url_archivo.'" download> <button class="btn btn-warning" id="descargar"><i class="fa fa-download"></i></button></a></p>
Desaprobar <button class="btn btn-danger" onclick="desaprobar(\''.$obje->idDocumento.'\');"><i class="fa fa-hand-o-down fa-3x"></i></button>
        </div>
    </div>
</div>'
);
}
        $results2 = array(
        "sEcho"=>intval( $requestData['draw'] ), //Informacion para el datatables
        "iTotalRecords"=>intval( $totalData ), //enviamos el total de registros al datatable 
        "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
        "aaData"=>$data2
);
        
}else{ echo 'hubo un errror';}
echo json_encode($results2);
}


// Lista los documentos en estado 0 en la vista administrador
public function listarTodosEn0(){
$requestData = $_POST;
$columns = array( 
    0 =>'d.creado'
);
$sql1 = "SELECT COUNT(d.idDocumento) as total FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario WHERE d.estado = '0'";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}

$sql = "SELECT d.idDocumento ,d.titulo, d.autor, d.resumen, d.foto_documento, d.url_archivo, d.ubicacion_fisica_documento,d.creado,d.modificado, d.estado, u.nombres, u.apellidos, u.foto_usuario FROM usuarios u INNER JOIN documento d ON u.id = d.usuario_idUsuario WHERE d.estado = '0'";

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND d.titulo LIKE '%".addslashes($requestData['search']['value'])."%' ";
}

$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length


$prevUser2 = ejecutarConsulta($sql);
$data2 = Array();
    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
$fechas = ($obje->creado==$obje->modificado)?'<p><strong>Fecha de Creación: </strong>'.$obje->creado.'</p>':'<p><strong>Fecha de Creación: </strong>'.$obje->creado.'</p>
<p><strong>Fecha de Actualización: </strong>'.$obje->modificado.'</p>';
    $foto = empty($obje->foto_usuario)?'user-default.jpg':$obje->foto_usuario;
        $data2[]=array(  "0"=>'

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
<article id="mostrandoDocumentos">
<h5 class="text-danger">Titulo del Documento: '.$obje->titulo.'</h5>
<p><strong>Resumen: </strong>'.$obje->resumen.'</p>
<p><strong>Autor(es): </strong>'.$obje->autor.'</p>
<p><strong>Subido por el usuario: </strong>'.$obje->nombres.' '.$obje->apellidos.'</p>
<img class="img-thumbnail" src="SubidArchivos/archivos/fotosUsuario/'.$foto.'">
<p><strong>Ubicación física del documento: </strong>'.$obje->ubicacion_fisica_documento.'</p>
'.$fechas.'
<p><strong>Tipo de documento: </strong><i class="fa fa-'.$obje->foto_documento.' fa-3x"></i></p>
</article>
        </div>
        <div class="col-4">
<p><strong>Descargar el archivo: </strong><a href="SubidArchivos/archivos/archivosUsuario/'.$obje->url_archivo.'" download> <button class="btn btn-warning" id="descargar"><i class="fa fa-download"></i></button></a></p>
Aprobar <button class="btn btn-success" onclick="aprobar(\''.$obje->idDocumento.'\');"><i class="fa fa-hand-o-up fa-3x"></i></button>  
        </div>
    </div>
</div>'


);
}
        $results2 = array(
        "sEcho"=>intval( $requestData['draw'] ), //Informacion para el datatables
        "iTotalRecords"=>intval( $totalData ), //enviamos el total de registros al datatable 
        "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
        "aaData"=>$data2
                        );
        
    }else{ echo 'hubo un errror';}

        echo json_encode($results2);
}


public function mostrarTipoDocumento(){
    $sql = 'SELECT idTipoDocumento, nombreTipo FROM tipodocumento';
    $resultado = ejecutarConsulta($sql);
    if ($resultado) {
    /* obtener el array de objetos */
    while ($obj = $resultado->fetch_object()) {
            echo "<option value=".$obj->idTipoDocumento.">".$obj->nombreTipo."</option>";
        }
    }
}

public function mostrarDocumento($idDocumento){
$sql = "SELECT d.idDocumento, d.titulo, d.autor, d.resumen, d.ubicacion_fisica_documento, d.tipoDocumento FROM documento d WHERE d.idDocumento = '$idDocumento'";
$data2 = Array();
$prevUser2 = ejecutarConsulta($sql);
    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
        $data2['datos']=array(  "0"=>$obje->idDocumento,
                            "1"=>$obje->titulo,
                            "2"=>$obje->autor,
                            "3"=>$obje->resumen,
                            "4"=>$obje->ubicacion_fisica_documento,
                            "5"=>$obje->tipoDocumento
                        
);
}        
    }else{ echo 'hubo un errror';}
    echo json_encode($data2);
}


public function guardarTipoDocumento($nombreTipo,$descripcionTipo){

$sql = "INSERT INTO tipodocumento (idTipoDocumento, nombreTipo, descripcion) VALUES ('', '$nombreTipo', '$descripcionTipo')";

$insert = ejecutarConsulta($sql);

if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Se registro correctamente el tipo de documento';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}

echo json_encode($sessData);

}

public function mostrarTipoDocumento2($idTipoDocumento){
$sql2 = "SELECT idTipoDocumento, nombreTipo, descripcion FROM tipodocumento WHERE idTipoDocumento = '$idTipoDocumento'";
$data2 = Array();
$prevUser2 = ejecutarConsulta($sql2);
    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
        $data2['datos']=array(  "0"=>$obje->idTipoDocumento,
                            "1"=>$obje->nombreTipo,
                            "2"=>$obje->descripcion
                        
);
}        
    }else{ echo 'hubo un errror';}
    echo json_encode($data2);
}

public function editarDocumento($idDocumento,$titulo,$autor,$resumen,$foto_documento,$url_archivo,$ubicacionfisica,$modificado,$idTipoDocumento){

if ($url_archivo=='') {
// Actualizando el documento
$sql2 = "UPDATE documento SET titulo='$titulo', autor='$autor', resumen='$resumen',ubicacion_fisica_documento='$ubicacionfisica', modificado='$modificado', tipoDocumento='$idTipoDocumento' WHERE idDocumento = '$idDocumento'";

$insert = ejecutarConsulta($sql2);
if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Se actualizo el documento.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}
}else{
// Actualizando el documento
$sql2 = "UPDATE documento SET titulo='$titulo', autor='$autor', resumen='$resumen', foto_documento='$foto_documento', url_archivo='$url_archivo',ubicacion_fisica_documento='$ubicacionfisica', modificado='$modificado', tipoDocumento='$idTipoDocumento' WHERE idDocumento = '$idDocumento'";

$insert = ejecutarConsulta($sql2);
if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Se actualizo el documento.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
}
echo json_encode($sessData);

}


public function editarTipoDocumento($idTipoDocumento,$nombreTipo,$descripcionTipo){
$sql2 = "UPDATE tipodocumento SET nombreTipo='$nombreTipo', descripcion='$descripcionTipo' WHERE idTipoDocumento = '$idTipoDocumento'";

$update = ejecutarConsulta($sql2);
    if($update){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha editado correctamente el tipo de documento';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
    echo json_encode($sessData);
}

public function graficaGeneralAdministrador(){
$sql2 = "SELECT COUNT(u.id) as cantidadUsuario FROM usuarios u";
$sql3 = "SELECT COUNT(d.idDocumento) as cantidadDocumento FROM documento d";
$data = Array();
$prevUser2 = ejecutarConsulta($sql2);
$prevUser3 = ejecutarConsulta($sql3);
    if($prevUser2 && $prevUser3){
    /* obtener el array de objetos */
    $obje = $prevUser2->fetch_object();
    $obje2 = $prevUser3->fetch_object();

    $data[0]=array( "name"=>"Usuarios",
                    "y"=>$obje->cantidadUsuario
    );
    $data[1]=array( "name"=>"Archivos",
                    "y"=>$obje2->cantidadDocumento
    );        
    
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK); 

}

public function MostrarGraficaArchivos(){
$sql2 = "SELECT YEAR(d.creado) as Año, COUNT(YEAR(d.creado)) as ContadorDocumentosAño FROM documento d GROUP BY YEAR(d.creado) ORDER BY YEAR(d.creado) ASC ";

$data = Array();
$prevUser2 = ejecutarConsulta($sql2);

    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
    $data[]=array( "name"=>$obje->Año,
                    "y"=>$obje->ContadorDocumentosAño,
                "drilldown"=>$obje->Año 
    );
}        
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK);
}

public function MostrarGraficaArchivosMes($SeleccionarAno){
$sql2 = "SELECT MONTH(d.creado) as Mes, COUNT(MONTH(d.creado)) as ContadorDocumentosMes FROM documento d WHERE YEAR(d.creado) = '$SeleccionarAno' GROUP BY MONTH(d.creado) ORDER BY MONTH(d.creado) ASC ";
$data = Array();
$prevUser2 = ejecutarConsulta($sql2);
$mesLetras='';

    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
    
    switch($obje->Mes){
    case '1':
        $mesLetras='Enero';
    break;
    case '2':
        $mesLetras='Febrero';
    break;
    case '3':
        $mesLetras='Marzo';
    break;
    case '4':
        $mesLetras='Abril';
    break;
    case '5':
        $mesLetras='Mayo';
    break;
    case '6':
        $mesLetras='Junio';
    break;
    case '7':
        $mesLetras='Julio';
    break;
    case '8':
        $mesLetras='Agosto';
    break;
    case '9':
        $mesLetras='Septiembre';
    break;
    case '10':
        $mesLetras='Octubre';
    break;
    case '11':
        $mesLetras='Noviembre';
    break;
    case '12':
        $mesLetras='Diciembre';
    break;
    default:
    break;
    }

    $data[]=array( "name"=>$mesLetras,
                    "y"=>$obje->ContadorDocumentosMes
    );
}        
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK);
}

public function graficaTotalArchivosNormal($idUsuario){
$sql2 = "SELECT COUNT(d.estado) as ContadorEstado1 FROM documento d WHERE d.usuario_idUsuario='$idUsuario' AND d.estado='1' LIMIT 1";
$sql3 = "SELECT COUNT(d.estado) as ContadorEstado0 FROM documento d WHERE d.usuario_idUsuario='$idUsuario' AND d.estado='0' LIMIT 1";

$data = Array();
$prevUser2 = ejecutarConsulta($sql2);
$prevUser3 = ejecutarConsulta($sql3);
    if($prevUser2 && $prevUser3){
     // obtener el array de objetos 
    $obje = $prevUser2->fetch_object();
    $obje2 = $prevUser3->fetch_object();

    $data[0]=array( "name"=>"Archivos aprobados",
                    "y"=>$obje->ContadorEstado1
    );
    $data[1]=array( "name"=>"Archivos no aprobados",
                    "y"=>$obje2->ContadorEstado0
    );        
    
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK);  
}

public function MostrarGraficaArchivosNormal($idUsuario){
$sql2 = "SELECT YEAR(d.creado) as Año, COUNT(YEAR(d.creado)) as ContadorDocumentosAño FROM documento d WHERE d.usuario_idUsuario='$idUsuario' GROUP BY YEAR(d.creado) ORDER BY YEAR(d.creado) ASC ";

$data = Array();
$prevUser2 = ejecutarConsulta($sql2);

    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
    $data[]=array( "name"=>$obje->Año,
                    "y"=>$obje->ContadorDocumentosAño,
                "drilldown"=>$obje->Año 
    );
}        
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK);
}


public function MostrarGraficaArchivosMesNormal($SeleccionarAno,$idUsuario){
$sql2 = "SELECT MONTH(d.creado) as Mes, COUNT(MONTH(d.creado)) as ContadorDocumentosMes FROM documento d WHERE YEAR(d.creado) = '$SeleccionarAno' AND d.usuario_idUsuario='$idUsuario'  GROUP BY MONTH(d.creado) ORDER BY MONTH(d.creado) ASC ";
$data = Array();
$prevUser2 = ejecutarConsulta($sql2);
$mesLetras='';

    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
    
    switch($obje->Mes){
    case '1':
        $mesLetras='Enero';
    break;
    case '2':
        $mesLetras='Febrero';
    break;
    case '3':
        $mesLetras='Marzo';
    break;
    case '4':
        $mesLetras='Abril';
    break;
    case '5':
        $mesLetras='Mayo';
    break;
    case '6':
        $mesLetras='Junio';
    break;
    case '7':
        $mesLetras='Julio';
    break;
    case '8':
        $mesLetras='Agosto';
    break;
    case '9':
        $mesLetras='Septiembre';
    break;
    case '10':
        $mesLetras='Octubre';
    break;
    case '11':
        $mesLetras='Noviembre';
    break;
    case '12':
        $mesLetras='Diciembre';
    break;
    default:
    break;
    }

    $data[]=array( "name"=>$mesLetras,
                    "y"=>$obje->ContadorDocumentosMes
    );
}        
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK);
}


public function contarTipoDocumentos(){
$sql = "SELECT COUNT(d.foto_documento) as totaltxt FROM documento d WHERE d.foto_documento LIKE '%text%'";
$sql1 = "SELECT COUNT(d.foto_documento) as totalpdf FROM documento d WHERE d.foto_documento LIKE '%pdf%'";
$sql2 = "SELECT COUNT(d.foto_documento) as totalword FROM documento d WHERE d.foto_documento LIKE '%word%'";
$sql3 = "SELECT COUNT(d.foto_documento) as totalexcel FROM documento d WHERE d.foto_documento LIKE '%excel%'";
$sql4 = "SELECT COUNT(d.foto_documento) as totalpowerpoint FROM documento d WHERE d.foto_documento LIKE '%powerpoint%'";

$data = Array();
$prevUser = ejecutarConsulta($sql);
$prevUser1 = ejecutarConsulta($sql1);
$prevUser2 = ejecutarConsulta($sql2);
$prevUser3 = ejecutarConsulta($sql3);
$prevUser4 = ejecutarConsulta($sql4);
    if($prevUser2 && $prevUser1 && $prevUser2 && $prevUser3 && $prevUser4){
     // obtener el array de objetos 
$obje = $prevUser->fetch_object();
$obje1 = $prevUser1->fetch_object();
$obje2 = $prevUser2->fetch_object();
$obje3 = $prevUser3->fetch_object();
$obje4 = $prevUser4->fetch_object();


    $data[0]=array( "name"=>"TXT",
                    "y"=>$obje->totaltxt
    );
    $data[1]=array( "name"=>"PDF",
                    "y"=>$obje1->totalpdf
    );   
    $data[2]=array( "name"=>"WORD",
                    "y"=>$obje2->totalword
    );      
    $data[3]=array( "name"=>"EXCEL",
                    "y"=>$obje3->totalexcel
    );     
    $data[4]=array( "name"=>"POWERPOINT",
                    "y"=>$obje4->totalpowerpoint
    );           
    
}else{ echo 'hubo un errror';}               
echo json_encode(array($data), JSON_NUMERIC_CHECK);  
}

}

?>