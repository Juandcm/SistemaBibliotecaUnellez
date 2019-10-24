<?php 
include_once 'funciones.php';

class EliminarArchivos
{

public function __construct(){}

public function eliminarArchivosUsuario($direccionArchivosUsuario,$tabla,$tipoArchivo){

$guardarArreglo=array();
$d = dir($direccionArchivosUsuario);
$arreglo=array();
$file=array();
$ultimoArreglo =array(); //carpetas en el servidor
$data = Array(); //carpetas en la BD
$cont=0;
// $otrocont=0;
$sql='';
$carpetaElminar='';
$contadorFinal=0;
$contadorFinal2=0;

// Aqui busco todos los archivos de la carpeta
while (($file = $d->read()) !== false )
{ 
    if(substr($file,0,1) !== '.' && $file !== '..' && $file !== 'index.php' && $file !== 'user-default.jpg')
    {
        $cont++;
        $arreglo['carpeta'][]=$file;
    }
}
$d->close(); 

// Aqui hago la peticion sql
for ($i=0; $i < $cont; $i++) { 
    if ($i==0) {
        $sql.="SELECT ".$tipoArchivo." FROM ".$tabla." WHERE ".$tipoArchivo." LIKE '%".$arreglo['carpeta'][$i]."%' ";
    }else{
    $sql .= " OR ".$tipoArchivo." LIKE '%".$arreglo['carpeta'][$i]."%'";
}
    $ultimoArreglo[]=$arreglo['carpeta'][$i];
}
$revisarArchivos = ejecutarConsulta($sql);
if ($revisarArchivos) { 
    while ($obj = $revisarArchivos->fetch_object()) {

switch ($tipoArchivo) {
    case 'url_archivo':
        $datos=$obj->url_archivo;
        list($carpeta,$archivo)=explode('/',$datos);
        $data[]=$carpeta;
        break;
    case 'foto_usuario':
        $datos=$obj->foto_usuario;
        list($carpeta,$archivo)=explode('/',$datos);
        $data[]=$carpeta;
    break;
    default:
    break;
}
}
}

// $otrocont = count($data);

// Aqui muestra todos los datos bien
// echo "<hr> Archivos de la tabla => ".$tabla." <hr>".$cont." es el Total de carpetas en el servidor<br><hr>";
// echo "<pre>";
// var_dump($ultimoArreglo);
// echo "</pre>";
// echo "<hr>".$otrocont." es el Total de carpetas en la base de datos<br><hr>";
// echo "<pre>";
// var_dump($data);
// echo "<hr>";

// $guardarArreglo['informacionTabla'] = array('0' => "Archivos de la tabla => ".$tabla." ".$cont." es el Total de carpetas en el servidor");
// $guardarArreglo['detallesTabla'] = $ultimoArreglo;

// $guardarArreglo['informacionCarpeta'] = array($otrocont." es el Total de carpetas en la base de datos ");
// $guardarArreglo['detallesCarpeta'] = $data;

foreach($ultimoArreglo as $valor){ //recorremos el array1 valor por valor
// y le asignamos el "valor" actual a $valor

//preguntamos: esta el valor en el que estamos posicionados actualmente, en el array 2?
if(array_search($valor, $data) !== false){}
else 
{
    $ArregloElimanar = array();
    $carpetaElminar = $valor."/";
    list($carpetasAElmininar,$archivos)=explode('/',$carpetaElminar);
    $ArregloElimanar[]= $direccionArchivosUsuario.$carpetasAElmininar."/";

foreach ($ArregloElimanar as $valor) {
    $direccionUbicacion2 = $valor;

if (is_dir($direccionUbicacion2)) {
$directorio = dir($direccionUbicacion2);
while (false !== ($entrando = $directorio->read())) {
   if( $entrando !== '.' && $entrando !== '..' )
   {
   
    // Aqui elimino los archivos de las carpetas que deseo eliminar
    unlink($direccionUbicacion2.$entrando);
   }else{}

}

$carpetaEliminarCompletamente = rmdir($direccionUbicacion2);
if ($carpetaEliminarCompletamente) {
    $contadorFinal2 += $contadorFinal+1;
    // echo "<pre>La carpeta ".$direccionUbicacion2." se elimino completamente";
    // $guardarArreglo['carpetaEliminadas'] = array('0' => "La carpeta ".$direccionUbicacion2." se elimino completamente");
}else{
    // echo "<pre>No se elimininaro las carpetas debido a un error desconocido</pre>";
    // $guardarArreglo['carpetaEliminadas'] = array('0' => "No se elimininaro las carpetas debido a un error desconocido");
}

$directorio->close();

}else{
    // echo "No se elimino la carpeta debido a que no es una direccion valida ".$valor;
    // $guardarArreglo['carpetaEliminadas'] = array('0' => "No se elimino la carpeta debido a que no es una direccion valida ".$valor);
}
}
}
}


switch ($tipoArchivo) {
    case 'url_archivo':
if ($contadorFinal2>0) {
    $valorS = ($contadorFinal2==1)?'Se encontro '.$contadorFinal2.' documento que fue eliminado':'Se encontraron '.$contadorFinal2.' documentos que fueron eliminados';

    $guardarArreglo['estado']['type'] = 'success';
    $guardarArreglo['estado']['msg'] = $valorS.', por otro lado, ';
}else{
    $guardarArreglo['estado']['type'] = 'success';
    $guardarArreglo['estado']['msg'] = 'No se encontro ningun documento a borrar, por otro lado, ';
   
}
    break;

    case 'foto_usuario':
if ($contadorFinal2>0) {
    $valorS = ($contadorFinal2==1)?'Se encontro '.$contadorFinal2.' foto que fue eliminada':'Se encontraron '.$contadorFinal2.' fotos que fueron eliminadas';

    $guardarArreglo['estado1']['type'] = 'success';
    $guardarArreglo['estado1']['msg'] = $valorS;
}else{
    $guardarArreglo['estado1']['type'] = 'success';
    $guardarArreglo['estado1']['msg'] = 'No se encontro ninguna foto que se deba borrar. ';
   
}
    break;
    
    default:
    break;
}



echo json_encode($guardarArreglo);
}


}
?>