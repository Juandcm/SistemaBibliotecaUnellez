<?php 
include_once 'funciones.php';

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sessData = array();

class Usuario
{
    public function __construct(){}

// Aqui verifico la entrada del usuario normal
public function entrar($email,$password){

    // Aqui verifico si el usuario esta activo en el sistema
    $sql = "SELECT id,nombres,apellidos,email,password,telefono,creado,foto_usuario,permiso FROM usuarios WHERE email='$email' AND estado='1' LIMIT 1";
    $prevUser = ejecutarConsultaSimpleFila($sql);

    // Aqui verifico si el usuario esta inactivo en el sistema
    $sql2 = "SELECT email FROM usuarios WHERE email='$email' AND estado='0' LIMIT 1";
    $prevUser2 = ejecutarConsultaSimpleFila($sql2);

    //Aqui verifico solo el correo
    $sql3 = "SELECT email FROM usuarios WHERE email='$email' LIMIT 1";
    $prevUser3 = ejecutarConsultaSimpleFila($sql3);

    if($prevUser > 0){
    $sql4="SELECT email,permiso FROM usuarios WHERE email='$email' AND permiso='1' LIMIT 1";
    $prevUser4 = ejecutarConsultaSimpleFila($sql4);
   
    if($prevUser4 > 0){
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'No puedes entrar como un usuario normal ya que eres un administrador';
    }else{

if (password_verify($password, $prevUser['password'])) {
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Bienvenido '.$prevUser['nombres'].'!';

    // Aqui asigno la id del usuario a la session
    $sessionUsuario['usuario']['id'] = $prevUser['id'];
    $sessionUsuario['usuario']['nombre'] = $prevUser['nombres'];
    $sessionUsuario['usuario']['apellido'] = $prevUser['apellidos'];
    $sessionUsuario['usuario']['email'] = $prevUser['email']; 
    $sessionUsuario['usuario']['telefono'] = $prevUser['telefono'];
    $sessionUsuario['usuario']['foto_usuario']=$prevUser['foto_usuario'];
    $sessionUsuario['usuario']['permiso']=$prevUser['permiso'];
    $sessionUsuario['usuario']['creado']=$prevUser['creado'];
    $_SESSION['DatosUsuario'] = $sessionUsuario;
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'El email es correcto pero la contraseña no lo es, intenta de nuevo con otra contraseña';
}

    
    }
    }elseif($prevUser2>0) {
            
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'No puedes entrar ya que estas desactivado, revisa tu correo para poder entrar a la página web';

    }else{
        if ($prevUser3>0) {            
        }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'El Email que ingreso no se encuentra en el sistema, por favor ingrese el correo correctamente'; 
        }
    }
    echo json_encode($sessData);
}

// Aqui verifico la entrada del administrador
public function entrar2($email, $password){
    // Aqui verifico si el usuario esta activo en el sistema
    $sql = "SELECT id,nombres,apellidos,email,password,telefono,creado,foto_usuario,permiso FROM usuarios WHERE email='$email' AND estado='1'";
    $prevUser = ejecutarConsultaSimpleFila($sql);

    // Aqui verifico si el usuario esta inactivo en el sistema
    $sql2 = "SELECT email,estado FROM usuarios WHERE email='$email' AND estado='0'";
    $prevUser2 = ejecutarConsultaSimpleFila($sql2);

    //Aqui verifico solo el correo
    $sql3 = "SELECT email FROM usuarios WHERE email='$email'";
    $prevUser3 = ejecutarConsultaSimpleFila($sql3);

    if($prevUser > 0){

    $sql4="SELECT email,permiso FROM usuarios WHERE email='$email' AND permiso='0'";
    $prevUser4 = ejecutarConsultaSimpleFila($sql4);
    if($prevUser4 > 0){
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'No puedes entrar como un usuario administrador ya que eres un usuario normal';
    }else{

if (password_verify($password, $prevUser['password'])) {
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Bienvenido '.$prevUser['nombres'].'!';

    // Aqui asigno la id del usuario a la session
    $sessionUsuario['usuario']['id'] = $prevUser['id'];
    $sessionUsuario['usuario']['nombre'] = $prevUser['nombres'];
    $sessionUsuario['usuario']['apellido'] = $prevUser['apellidos'];
    $sessionUsuario['usuario']['email'] = $prevUser['email']; 
    $sessionUsuario['usuario']['telefono'] = $prevUser['telefono'];
    $sessionUsuario['usuario']['foto_usuario']=$prevUser['foto_usuario'];
    $sessionUsuario['usuario']['permiso']=$prevUser['permiso'];
    $sessionUsuario['usuario']['creado']=$prevUser['creado'];
    $_SESSION['DatosUsuario'] = $sessionUsuario;
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'El email es correcto pero la contraseña no lo es, intenta de nuevo con otra contraseña';
}
    }
    }elseif($prevUser2>0) {
            
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'No puedes entrar ya que estas desactivado, revisa tu correo para poder entrar a la página web';

    }else{
        if ($prevUser3>0) {            
        }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'El Email que ingreso no se encuentra en el sistema, por favor ingrese el correo correctamente'; 
        }
    }
    echo json_encode($sessData);
}

// Aqui registro a un usuario normal
public function registrar($nombre,$apellido,$email,$telefono,$password,$confirm_password,$foto_usuario){

$creado = date("Y-m-d H:i:s");


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'El correo no es valido'; 
}elseif ($password !== $confirm_password) {
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Confirmar que la contraseña debe coincidir con la contraseña.'; 
}else{
    // Aqui verifico de que el correo no este dentro del sistema
    $sql = "SELECT email FROM usuarios WHERE email='$email'";
    $prevUser = ejecutarConsultaSimpleFila($sql);

if($prevUser > 0){
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Email existe, Por favor ingrese otro email.';
}else{


// En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
// Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
$opciones = ['cost' => 12];
$contrasenaFinal = password_hash($password, PASSWORD_BCRYPT,$opciones);


    // Aqui registro al usuario en el sistema
    $sql = "INSERT INTO usuarios (id, nombres, apellidos, email, password, telefono, olvido_pass_iden, creado, modificado, estado,foto_usuario,permiso) VALUES ('', '$nombre', '$apellido', '$email', '$contrasenaFinal', '$telefono','','$creado','' , '1','$foto_usuario','0')";
    $insert = ejecutarConsulta($sql);

if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Te registraste exitosamente, inicia sesión con tus credenciales.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
}
}
    echo json_encode($sessData);
}

// Aqui se envia el email al usuario general, puede ser administrador o normal
public function restaurarcontrasena($email){

$mail = new PHPMailer();
// Fechas
$modificado = date("Y-m-d H:i:s");
// Aqui verifico de que el correo este dentro del sistema
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$prevUser = ejecutarConsultaSimpleFila($sql);

if($prevUser > 0){
    $uniqidStr = md5(uniqid(mt_rand()));
    $olvido_pass_iden = $uniqidStr;

try{
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->CharSet="UTF-8";
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Host = 'smtp.gmail.com'; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->Username = '97juandcm11@gmail.com'; // Correo completo a utilizar
$mail->Password = 'Juandcm1197*'; // Contraseña
$mail->Port = 25; // Puerto a utilizar
$mail->From = '97juandcm11@gmail.com'; // Desde donde enviamos (Para mostrar)
$mail->FromName = 'Juan Colmenares';
$mail->SetLanguage('es', '../assets/PHPMailer/language/');
// Aqui actualizo el estado del usuario a 0, ya que va a estar desactivado hasta que se reinicie la contraseña
$sql2 = "UPDATE usuarios SET olvido_pass_iden = '$olvido_pass_iden',modificado = '$modificado', estado='0' WHERE email = '$email'";
// if($update){
// Esta url cambiara cuando se suba a internet:
$resetPassLink = 'http://localhost/HechoPorMi/Recuperarcontrase%c3%b1a/index.php?vista=comprobarcontrasena&fp_code='.$uniqidStr;

$mail->AddAddress($prevUser['email']); // Esta es la dirección a donde enviamos
$mail->Subject = 'Solicitud de actualización de contraseña'; // Este es el titulo del email.
$body = 'Estimado '.$prevUser['nombres'];
$body .= ',<br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada. <br/>Para restablecer su contraseña, visite el siguiente enlace: ';
$body .= '<a href="'.$resetPassLink.'">'.$resetPassLink.'</a>';
$body .= '<br/><br/>Saludos,<br/>Juan Colmenaraes';
$mail->Body = $body; // Mensaje a enviar 

// $mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");  //Esto es para enviar imagenes o otro tipo de archivo
$enviar = $mail->Send(); // Envía el correo.
$intentos=1; 
// Aqui hago 5 intentos hasta que se pueda enviar el email, de lo contrario me mostrara el error
while((!$enviar)&&($intentos<5)&&($mail->ErrorInfo!="Error SMTP: Datos no aceptados.")){
    // sleep(3);
    $enviar = $mail->Send();
    $intentos=$intentos+1;               
}
    if ($mail->ErrorInfo=="Error SMTP: Datos no aceptados.") {
    $update = ejecutarConsulta($sql2);
    $enviar=true;
    }   

    // El problema se encuentra en la UNELLEZ, problema resuelto
    if(!$enviar)
    {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo realizar la solicitud de reincio de contraseña, debido a: '. $mail->ErrorInfo; 
    }
    else
    {
        $update = ejecutarConsulta($sql2);
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Solicitud de actualización de contraseña correcta, revisa el correo'; 
    }
    $mail->ClearAddresses();    
        // } Fin del update
    }catch (Exception $e) {
     $sessData['estado']['type'] = 'error';
         $sessData['estado']['msg'] = 'No se pudo realizar la solicitud de reincio de contraseña, debido a:'. $mail->ErrorInfo; 
        }
    }else{
         $sessData['estado']['type'] = 'error';
         $sessData['estado']['msg'] = 'El correo electrónico dado no está asociado con ninguna cuenta.'; 
    }
echo json_encode($sessData);
}

// Aqui compruebo la url del correo, para restaurar la contraseña
public function enviarContrasena($password,$confirm_password,$fp_code){
    
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Confirmar que la contraseña debe coincidir con la contraseña.'; 
        }else{

        $sql5 = "SELECT olvido_pass_iden FROM usuarios WHERE olvido_pass_iden='$fp_code'";
        $prevUser = ejecutarConsultaSimpleFila($sql5);

        if($prevUser > 0){

        $contraseNew=md5($_POST['confirm_password']);

        $sql6 = "UPDATE usuarios SET password = '$contraseNew',olvido_pass_iden='', estado='1' WHERE olvido_pass_iden = '$fp_code'";
        $update = ejecutarConsulta($sql6);
            if($update){
                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'La contraseña de su cuenta se ha restablecido con éxito. Por favor inicie sesión con su nueva contraseña.';
            }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }

        }else{
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No está autorizado a restablecer una nueva contraseña de esta cuenta.';
            }
        }
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Todos los campos son obligatorios, por favor complete todos los campos.'; 
    }

echo json_encode($sessData);
}


public function mostrarUsuario($idUsuario){
    $sql = "SELECT u.id, u.nombres, u.apellidos, u.email, u.telefono FROM usuarios u WHERE u.id = '$idUsuario'";
$data2 = Array();
$prevUser2 = ejecutarConsulta($sql);
    if($prevUser2){
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
        $data2['datos']=array(  "0"=>$obje->id,
                            "1"=>$obje->nombres,
                            "2"=>$obje->apellidos,
                            "3"=>$obje->email,
                            "4"=>$obje->telefono                        
);
}        
    }else{ echo 'hubo un errror';}
    echo json_encode($data2);
}


public function editarUsuarioCompleto($idUsuario,$nombre,$apellido,$email,$password,$modificado,$telefono,$foto_usuario){

// En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
// Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
$opciones = ['cost' => 12];
$contrasenaFinal = password_hash($password, PASSWORD_BCRYPT,$opciones);

    // Aqui verifico de que el correo no este dentro del sistema
    $sqlCorreo = "SELECT id,nombres,apellidos,email,telefono,creado,foto_usuario,permiso FROM usuarios WHERE email='$email'";
    $revisarCorreo = ejecutarConsultaSimpleFila($sqlCorreo);

if($revisarCorreo > 0){
 	$idRevisar = $revisarCorreo['id'];
if ($idUsuario == $idRevisar) {

if ($foto_usuario=='user-default.jpg') {
// Actualizando el documento
$sql2 = "UPDATE usuarios SET nombres='$nombre', apellidos='$apellido', email='$email',password='$contrasenaFinal', modificado='$modificado', telefono='$telefono' WHERE id = '$idUsuario'";

$insert = ejecutarConsulta($sql2);
if($insert){
    $sql = "SELECT * FROM usuarios WHERE id='$idUsuario'";
    $prevUser = ejecutarConsultaSimpleFila($sql);
    if($prevUser > 0){
    // Aqui asigno la id del usuario a la session
    $sessionUsuario['usuario']['id'] = $prevUser['id'];
    $sessionUsuario['usuario']['nombre'] = $prevUser['nombres'];
    $sessionUsuario['usuario']['apellido'] = $prevUser['apellidos'];
    $sessionUsuario['usuario']['email'] = $prevUser['email']; 
    $sessionUsuario['usuario']['telefono'] = $prevUser['telefono'];
    $sessionUsuario['usuario']['foto_usuario']=$prevUser['foto_usuario'];
    $sessionUsuario['usuario']['permiso']=$prevUser['permiso'];
    $sessionUsuario['usuario']['creado']=$prevUser['creado'];
    $_SESSION['DatosUsuario'] = $sessionUsuario;
    }

    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Se actualizo el usuario.';


}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}
}else{
// Actualizando el documento
$sql2 = "UPDATE usuarios SET nombres='$nombre', apellidos='$apellido', email='$email',password='$contrasenaFinal', modificado='$modificado', telefono='$telefono', foto_usuario='$foto_usuario'  WHERE id = '$idUsuario'";

$insert = ejecutarConsulta($sql2);
if($insert){

$sql = "SELECT * FROM usuarios WHERE id='$idUsuario'";
    $prevUser = ejecutarConsultaSimpleFila($sql);
    if($prevUser > 0){
    // Aqui asigno la id del usuario a la session
    $sessionUsuario['usuario']['id'] = $prevUser['id'];
    $sessionUsuario['usuario']['nombre'] = $prevUser['nombres'];
    $sessionUsuario['usuario']['apellido'] = $prevUser['apellidos'];
    $sessionUsuario['usuario']['email'] = $prevUser['email']; 
    $sessionUsuario['usuario']['telefono'] = $prevUser['telefono'];
    $sessionUsuario['usuario']['foto_usuario']=$prevUser['foto_usuario'];
    $sessionUsuario['usuario']['permiso']=$prevUser['permiso'];
    $sessionUsuario['usuario']['creado']=$prevUser['creado'];
    $_SESSION['DatosUsuario'] = $sessionUsuario;
    }

    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Se actualizo el usuario.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
}


}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Este email ya esta en uso en el sistema por favor ingresa otro email.';
}
}else{
}

echo json_encode($sessData);

}

public function cambiarAdministrador($idUsuario){

$sql2 = "UPDATE usuarios SET permiso='1'  WHERE id = '$idUsuario'";
$insert = ejecutarConsulta($sql2);
if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'El usuario ya es administrador.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}

echo json_encode($sessData);
}

public function cambiarNormal($idUsuario){
$sql2 = "UPDATE usuarios SET permiso='0'  WHERE id = '$idUsuario'";
$insert = ejecutarConsulta($sql2);
if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'El usuario ya no es administrador.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}
echo json_encode($sessData);
}

public function verUsuarioAdministrador(){
$requestData = $_POST;
$columns = array( 
    0 =>'u.creado'
);
$sql1 = "SELECT COUNT(u.id) as total FROM usuarios u WHERE u.permiso = '1'";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}


$sql = "SELECT u.id, u.nombres, u.apellidos, u.email, u.telefono, u.creado, u.estado, u.foto_usuario FROM usuarios u WHERE u.permiso = '1'";
    $data = Array();

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND u.nombres LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

    $prevUser = ejecutarConsulta($sql);
    if($prevUser){
    /* obtener el array de objetos */
    while ($obje = $prevUser->fetch_object()) {
    $foto_usuario = !empty($obje->foto_usuario)?$obje->foto_usuario:'user-default.jpg';
    $estado=($obje->estado=='1')?'<span class="bg-success">Activado</span>':'<span class="bg-danger">Desactivado</span>';

    $estadoBoton=($obje->estado=='1')?'<p><strong>Bloquear o Desactivar </strong><button class="btn btn-danger" onclick="DesactivarUsuario(\''.$obje->id.'\');"><i class="fa fa-unlock-alt"></i></button></p>':'<p><strong>Desbloquear o Activar </strong><button class="btn btn-success" onclick="ActivarUsuario(\''.$obje->id.'\');"><i class="fa fa-unlock"></i></button></p>';

        $data[]=array(  "0"=>'<div class="container-fluid">
<div class="row col-spacing">

    <div class="col-12 col-md-6 col-lg-6">
        <p>Nombres: '.$obje->nombres.'</p>
        <p>Apellidos: '.$obje->apellidos.'</p>
        <p>Email: '.$obje->email.'</p>
        <p>Telefono: '.$obje->telefono.'</p>
        <p>Creado: '.$obje->creado.'</p>
        <p>Foto del Usuario: '.$foto_usuario.'</p>
        <p>Estado: '.$estado.'</p>
    </div>

    <div class="col-12 col-md-6 col-lg-6">

    <p><strong>Cambiar permiso del usuario a normal </strong><button class="btn btn-success" onclick="cambiarNormal(\''.$obje->id.'\');"><i class="fa fa-user-circle"></i></button></p>

    '.$estadoBoton.'

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
        
    }else{echo 'hubo un errror';}
echo json_encode($results);

}

public function verUsuarioNormal(){
$requestData = $_POST;
$columns = array( 
    0 =>'u.creado'
);

$sql1 = "SELECT COUNT(u.id) as total FROM usuarios u WHERE u.permiso = '0'";
$query=ejecutarConsulta($sql1);
if ($query) {
    $row=$query->fetch_object();
    $totalData = $row->total;
}

$sql = "SELECT u.id, u.nombres, u.apellidos, u.email, u.telefono, u.creado, u.estado,  u.foto_usuario FROM usuarios u WHERE u.permiso = '0'";
    $data = Array();

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND u.nombres LIKE '%".addslashes($requestData['search']['value'])."%' ";
}

$query=ejecutarConsulta($sql);
$totalFiltered = $query->num_rows;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

    $prevUser = ejecutarConsulta($sql);
    if($prevUser){
    /* obtener el array de objetos */
    while ($obje = $prevUser->fetch_object()) {

    $foto_usuario = !empty($obje->foto_usuario)?$obje->foto_usuario:'user-default.jpg';

    $estado=($obje->estado=='1')?'<span class="bg-success">Activado</span>':'<span class="bg-danger">Desactivado</span>';

    $estadoBoton=($obje->estado=='1')?'<p><strong>Bloquear o Desactivar </strong><button class="btn btn-danger" onclick="DesactivarUsuario(\''.$obje->id.'\');"><i class="fa fa-unlock-alt"></i></button></p>':'<p><strong>Desbloquear o Activar </strong><button class="btn btn-success" onclick="ActivarUsuario(\''.$obje->id.'\');"><i class="fa fa-unlock"></i></button></p>';

        $data[]=array(  "0"=>'

<div class="container-fluid">
<div class="row col-spacing">

    <div class="col-12 col-md-6 col-lg-6">
        <p>Nombres: '.$obje->nombres.'</p>
        <p>Apellidos: '.$obje->apellidos.'</p>
        <p>Email: '.$obje->email.'</p>
        <p>Telefono: '.$obje->telefono.'</p>
        <p>Creado: '.$obje->creado.'</p>
        <p>Foto del Usuario: '.$foto_usuario.'</p>
        <p>Estado: '.$estado.'</p>
    </div>

    <div class="col-12 col-md-6 col-lg-6">
    <p><strong>Ver todos los documentos subidos por el usuario </strong><button class="btn btn-primary" onclick="verDocumentos(\''.$obje->id.'\');" data-toggle="modal" data-target="#documentosUsuario"><i class="fa fa-folder-open"></i></button></p>

    <p><strong>Enviar un mensaje </strong><button class="btn btn-success" onclick="enviarMensaje(\''.$obje->id.'\');" data-toggle="modal" data-target="#enviarMensajeAdministrador"><i class="fa fa-envelope"></i></button></p>

    <p><strong>Cambiar permiso del usuario a administrador </strong><button class="btn btn-success" onclick="cambiarAdministrador(\''.$obje->id.'\');"><i class="fa fa-user-circle"></i></button></p>
    '.$estadoBoton.'
    </div>

</div>   
</div>'


        );
    }
        $results = array(
        "sEcho"=>intval( $requestData['draw'] ), //Informacion para el datatables
        "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
        "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
        "aaData"=>$data
                        );
        
    }else{echo 'hubo un errror';}
echo json_encode($results);
}

public function ActivarUsuario($idUsuario)
{
        $sql2 = "UPDATE usuarios SET olvido_pass_iden='', estado='1'  WHERE id = '$idUsuario'";
$insert = ejecutarConsulta($sql2);
if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'El usuario ya esta activo en el sistema.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}
echo json_encode($sessData);
}

public function DesactivarUsuario($idUsuario){
    $sql2 = "UPDATE usuarios SET estado='0'  WHERE id = '$idUsuario'";
$insert = ejecutarConsulta($sql2);
if($insert){
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'El usuario ya esta desactivado en el sistema.';
}else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
}
echo json_encode($sessData);
}

public function VerArchivosDelUsuario($idElUsuario){
$sql2 = "SELECT d.idDocumento, d.titulo, d.resumen,d.foto_documento, d.estado, d.url_archivo FROM documento d WHERE d.usuario_idUsuario = '$idElUsuario'"; 
$data = Array();
$prevUser2 = ejecutarConsulta($sql2);
$prevUser3 = ejecutarConsultaSimpleFila($sql2);

if($prevUser3>0){
if ($prevUser2) {
    /* obtener el array de objetos */
    while ($obje = $prevUser2->fetch_object()) {
    $estado=($obje->estado=='1')?"<div class='bg-success'>Activado</div>":"<div class='bg-danger'>Desactivado</div>";

    $estadoBoton=($obje->estado=='1')?'<p><strong>Desaprobar</strong> <button class="btn btn-danger" onclick="desaprobar(\''.$obje->idDocumento.'\');"><i class="fa fa-hand-o-down fa-3x"></i></button></p>':'<p><strong>Aprobar</strong><button class="btn btn-success" onclick="aprobar(\''.$obje->idDocumento.'\');"><i class="fa fa-hand-o-up fa-3x"></i></button></p>';


echo "<hr style='width: 100%; height: 5px; background: red;'>
            <div class='col-12'>
            <p class='text-center text-capitalize'><strong>".$obje->titulo."</strong></p>  
            <p class='text-justify'>".$obje->resumen."</p>
            <p><strong>Tipo de documento: </strong><i class='fa fa-".$obje->foto_documento." fa-3x'></i></p>
            <p><strong>Descargar el archivo: </strong><a href='SubidArchivos/archivos/archivosUsuario/".$obje->url_archivo."' download> <button class='btn btn-3d btn-warning'><i class='fa fa-download'></i></button></a></p>
            <div class='float-left'>
            <p>Estado: ".$estado."</p>
            </div>
            <div class='float-right'>".$estadoBoton."</div>  
            </div>";
}          
}
}else{ 
    echo "<div class='col-12'>
        <p class='text-center'><strong>No se encontro ningun archivo de este usuario</strong></p></div>";
    }    
}


}

?>