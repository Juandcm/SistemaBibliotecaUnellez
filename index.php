<?php session_start();
include('Vista/header.php');
// No me va a ningun error que puede tener el codigo php
error_reporting(-1);



// $valorestado=isset($_POST['valorestado'])?$_POST['valorestado']:'';
// $valormsg=isset($_POST['valormsg'])?$_POST['valormsg']:'';
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$permiso = isset($DataUsuario['usuario']['permiso'])?$DataUsuario['usuario']['permiso']:'';
$vista = isset($_REQUEST['vista'])?$_REQUEST['vista']:'No';

// function cerrarPost(){
// 	if(isset($_SESSION['contador'])){
// 		$_SESSION['contador']++;
// 	}else{
// 		$_SESSION['contador'] = 1;
// 	} 
// 	if ($_SESSION['contador'] >= 2) {
// 		$direccionActual = $_SERVER['PHP_SELF'];
// 		header("Location:".$direccionActual);
// 		unset($_SESSION['contador']);
// 	}	
// }
// Verifica si hay variable tipo post, si lo hay cuando recargue la pagina van a desaparecer
// if ($_POST) {cerrarPost();}

?>
<?php      
// Aqui muestra los valores de la session
// session_destroy();
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

// Este codigo sirve para probar la velocidad del servidor en la creacion de contraseñas
// $timeTarget = 0.05; // 50 milisegundos 
// $coste = 8;
// do {
//     $coste++;
//     $inicio = microtime(true);
//     password_hash("test", PASSWORD_BCRYPT, ["cost" => $coste]);
//     $fin = microtime(true);
// } while (($fin - $inicio) < $timeTarget);
 
// echo "Coste conveniente encontrado: " . $coste;


?>

<div id="todo" class="col-12">

<div class="menuprincipal">


<?php

if (empty($DataUsuario)) {
switch ($vista) {
    case 'No':
        include('Vista/login.php');
    break;
    
    case 'comprobarcontrasena':
        include('Vista/reiniciarcontrasena.php');
    break;
     
    case 'MostrarDocumentos':
        include('Vista/MostrarDocumentos.php');    
    break;
    case 'EntrarAdministrador':
        include('Vista/entradAdministrador.php');    
    break;
    default:
    include('Vista/login.php');
    break;
}
}else{  



// Aqui compruebo los permisos del usuario, cuando esta en 0 es un usuario TIPO normal, cuando esta en 1 es un usuario TIPO Administrador
    if ($permiso =='0') {
    include('Vista/normal.php');

    }elseif ($permiso == '1') {
        include('Vista/administrador.php');
    }
}
?>
</div>
</div>   

<!-- Aqui muestro el gif de carga cuando se hace una peticion AJAX -->


<div class="mx-auto text-center">
<div id="loader3"></div>
</div>      

<?php include('Vista/footer.php');?>


<!-- 
Esto va a ser para despues
Tambien tengo que poder poner al usuario normal, enviar mensajes de dudas y sugerencias al administrador para que este le pueda mandar mensajes personalizados al administrador del sistema

el administrador podra enviar mensajes personalizados a los usuarios normales, claro que tendra una lista con todos los usuarios registrados en el sistema, cuando se envie el mensaje el usuario podra verlo en el area de notificaciones claro que tengo que hacer un area de notificaciones de mensajes mucho mejor
el administrador podra enviar msm a todos los usuarios a la ves o simplemente a uno
el usuairo normal no podra responderle,

Tengo que poder exportar en pdf todos los usuarios y los archivos registrados en el sistema cuando el usuario es administrador
cuando el usuario es normal solo podra exportar solo los documentos que el haya subido al sistema
-->