<?php 
require_once 'global.php';

setlocale(LC_ALL, 'es_VE');
// Setea el huso horario del servidor...
date_default_timezone_set('America/Caracas');

//Crear conexion con la abse de datos
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
        
// Cerciorar la conexion
if($conexion->connect_error){
	die("Conexion fallida: " . $conexion->connect_error);
}


 ?>