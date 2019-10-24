<?php 
// Incluir la conexion a la base de datos
require_once "../Config/Conexion.php";

function getSubString($string, $length=NULL){
  //Si no se especifica la longitud por defecto es 50
  if ($length == NULL)
    $length = 40;
  // quitamos las etiquetas HTML
  $stringDisplay = strip_tags($string);
  // solo se recorta si la longitud es mayor que el limite
  if (strlen($stringDisplay) > $length) {
    // obtenemos la posicion a partir de la cual se cortara
    $indiceCorte = strrpos($stringDisplay, " ", $length - strlen($stringDisplay));
    // montamos una nueva cadena con el corte primero y la elipsis
    $stringDisplay = substr($stringDisplay, 0, $indiceCorte) . "...";
  }
  return $stringDisplay;
}

function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
    '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }
 
function limpiar($input) {
	global $conexion;
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = limpiar($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysqli_real_escape_string($conexion,trim($input));
    }
    return htmlspecialchars($output);
}

	function ejecutarConsulta($sql){
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
		cerrarConexion();
	}
	function ejecutarConsultaSimpleFila($sql){
		global $conexion;
		$query = $conexion->query($sql);
		$row = $query->fetch_assoc();
		return $row;
		cerrarConexion();
	}
	function ejecutarConsulta_retornrID($sql){
		global $conexion;
		$query = $conexion->query($sql);
		return $conexion->insert_id;
		cerrarConexion();
	}
	function cerrarConexion(){
		global $conexion;
		return $conexion->close();
	}
 ?>