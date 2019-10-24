<script type="text/template" id="qq-template-validation">
  <?php include "PlantillaSubidaFiles.php"; ?>
</script>
<?php 
$DataUsuario = !empty($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$vista = isset($_REQUEST['vista'])?$_REQUEST['vista']:'No';
$personalizar='';
$personalizar2='';
$personalizar3='';

$vistaPersonalizar=isset($_REQUEST['vista'])?$_REQUEST['vista']:'No';
switch($vistaPersonalizar){
    case 'No':
    $personalizar3='active';
    break;
    case 'VerTodosLosUsuariosEn1':
    $personalizar2='active';
    break;
    case 'ArchivosUsuarios':
    $personalizar='active';
    break;
    case 'mostrarNotificacionAdministrador':
    $personalizarNotificacion='active';
      break;
    default:
    $personalizar3='active';
    break;
}


if (!empty($DataUsuario['usuario']['nombre']) || !empty($DataUsuario['usuario']['apellido']) || !empty($DataUsuario['usuario']['email']) || !empty($DataUsuario['usuario']['telefono'])) {

  $id = $DataUsuario['usuario']['id'];
  $nombre = $DataUsuario['usuario']['nombre'];
  $apellido = $DataUsuario['usuario']['apellido'];
  $email = $DataUsuario['usuario']['email'];
  $telefono = $DataUsuario['usuario']['telefono'];
  $foto_usuario = !empty($DataUsuario['usuario']['foto_usuario'])?$DataUsuario['usuario']['foto_usuario']:'user-default.jpg';

  $fechaOriginal = $DataUsuario['usuario']['creado'];
  $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
  $creado=$fechaFormateada;
?>


<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

     <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" id="botonMensajes">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge d-none"><div class="notification-count"></div></span>
        </a>


        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><div>Todas las Notificaciones</div></span>

<div id="notification-latest"></div>


          <div class="dropdown-divider"></div>
          <a href="index.php?vista=mostrarNotificacionAdministrador" class="dropdown-item dropdown-footer">Mostrar todos las Notificaciones</a>
        </div>

      </li>
    </ul>
    
<div class="dropdown-divider"></div>
<!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="SubidArchivos/archivos/fotosUsuario/<?=$foto_usuario?>" class="img-circle brand-image elevation-2" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="font-weight-light text-capitalize"><?php echo $nombre.' '.$apellido; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="SubidArchivos/archivos/fotosUsuario/<?=$foto_usuario?>" class="img-circle" alt="User Image">

                <p>
                  <span class="text-capitalize"><?php echo $nombre.' '.$apellido; ?></span>
                  <small>Miembro desde el: <?=$creado ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-left">
                  <button class="btn btn-success" onclick="editarUsuario(<?php echo $id; ?>);" data-toggle="modal" data-target="#editarUsuario"><i class="fa fa-pencil"> Editar Perfil</i></button>
                </div>

                <div class="pull-right">
                  <button id="logout" class="btn btn-default btn-flat">
                  <a href="index.php">Cerrar Sesión<i class="fa fa-sign-out"></i></a>
                  </button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="SubidArchivos/archivos/fotosUsuario/user-default.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Logo BIBLIOTECA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar animacionInicial blur">

      <!-- Sidebar Menu -->
      <nav class="mt-2 d-none blur">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link <?= $personalizar3 ?>">
              <i class="nav-icon fa fa-bar-chart"></i>
              <p>
                Escritorio
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?vista=ArchivosUsuarios" class="nav-link <?= $personalizar ?>">
              <i class="nav-icon fa fa-folder"></i>
              <p>
                Archivos de los Usuarios
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?vista=VerTodosLosUsuariosEn1" class="nav-link <?=$personalizar2 ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Usuarios
                <span class="right badge badge-danger">Todos</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?vista=mostrarNotificacionAdministrador" class="nav-link <?=$personalizarNotificacion ?>">
              <i class="nav-icon fa fa-bell-o"></i>
              <p>
                Notificaciones
                <span class="right badge badge-danger">Todas</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><b></b></h1>
          </div><!-- /.col -->
          <div class="col-6">
          </div><!-- /.col -->
      </div><!-- /.row -->
      </div><!-- /.container-fluid -->

<div class="row justify-content-center">

<?php 
switch ($vista) {
  case 'No':
  ?>
<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Eliminar</h3>
    <p>archivos basura del sistema</p>
  </div>
<div class="icon">
  <i class="fa fa-trash"></i>
</div>
  <button type="button" class="btn btn-danger" id="EliminarArchivosViejos" style="width: 100%;"><i class='fa fa-trash'></i> Eliminar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Agregar</h3>
    <p>Tipo de Documento</p>
  </div>
<div class="icon">
  <i class="fa fa-plus"></i>
</div>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dataRegister" style="width: 100%;"><i class='fa fa-plus'></i> Agregar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Archivos</h3>
    <p>Ver todos los archivos</p>
  </div>
<div class="icon">
  <i class="fa fa-folder"></i>
</div>
  <a href="index.php?vista=ArchivosUsuarios"><button type="button" class="btn btn-secondary" style="width: 100%;"><i class='fa fa-folder'></i> Ver usuarios <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Usuarios</h3>
    <p>Ver todos los usuarios</p>
  </div>
<div class="icon">
  <i class="fa fa-users"></i>
</div>
  <a href="index.php?vista=VerTodosLosUsuariosEn1"><button type="button" class="btn btn-block" style="width: 100%;"><i class='fa fa-users'></i> Ver usuarios <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>

  <?php
  break;
  case 'VerTodosLosUsuariosEn1':
?>
<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Eliminar</h3>
    <p>archivos basura del sistema</p>
  </div>
<div class="icon">
  <i class="fa fa-trash"></i>
</div>
  <button type="button" class="btn btn-danger" id="EliminarArchivosViejos" style="width: 100%;"><i class='fa fa-trash'></i> Eliminar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Agregar</h3>
    <p>Tipo de Documento</p>
  </div>
<div class="icon">
  <i class="fa fa-plus"></i>
</div>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dataRegister" style="width: 100%;"><i class='fa fa-plus'></i> Agregar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Escritorio</h3>
    <p>Ver las Gráficas</p>
  </div>
<div class="icon">
  <i class="fa fa-bar-chart"></i>
</div>
  <a href="index.php"><button type="button" class="btn btn-block" style="width: 100%;"><i class='fa fa-bar-chart'></i> Ver gráficas <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Archivos</h3>
    <p>Ver todos los archivos</p>
  </div>
<div class="icon">
  <i class="fa fa-folder"></i>
</div>
  <a href="index.php?vista=ArchivosUsuarios"><button type="button" class="btn btn-secondary" style="width: 100%;"><i class='fa fa-folder'></i> Ver usuarios <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>
<?php
  break;
  case 'ArchivosUsuarios':
?>
<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Eliminar</h3>
    <p>archivos basura del sistema</p>
  </div>
<div class="icon">
  <i class="fa fa-trash"></i>
</div>
  <button type="button" class="btn btn-danger" id="EliminarArchivosViejos" style="width: 100%;"><i class='fa fa-trash'></i> Eliminar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Agregar</h3>
    <p>Tipo de Documento</p>
  </div>
<div class="icon">
  <i class="fa fa-plus"></i>
</div>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dataRegister" style="width: 100%;"><i class='fa fa-plus'></i> Agregar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Escritorio</h3>
    <p>Ver las Gráficas</p>
  </div>
<div class="icon">
  <i class="fa fa-bar-chart"></i>
</div>
  <a href="index.php"><button type="button" class="btn btn-block" style="width: 100%;"><i class='fa fa-bar-chart'></i> Ver gráficas <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Usuarios</h3>
    <p>Ver todos los usuarios</p>
  </div>
<div class="icon">
  <i class="fa fa-users"></i>
</div>
  <a href="index.php?vista=VerTodosLosUsuariosEn1"><button type="button" class="btn btn-block" style="width: 100%;"><i class='fa fa-users'></i> Ver usuarios <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>
<?php


  break;
  default:
?>
<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Eliminar</h3>
    <p>archivos basura del sistema</p>
  </div>
<div class="icon">
  <i class="fa fa-trash"></i>
</div>
  <button type="button" class="btn btn-danger" id="EliminarArchivosViejos" style="width: 100%;"><i class='fa fa-trash'></i> Eliminar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Agregar</h3>
    <p>Tipo de Documento</p>
  </div>
<div class="icon">
  <i class="fa fa-plus"></i>
</div>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dataRegister" style="width: 100%;"><i class='fa fa-plus'></i> Agregar <i class="fa fa-arrow-circle-right"></i></button>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Archivos</h3>
    <p>Ver todos los archivos</p>
  </div>
<div class="icon">
  <i class="fa fa-folder"></i>
</div>
  <a href="index.php?vista=ArchivosUsuarios"><button type="button" class="btn btn-secondary" style="width: 100%;"><i class='fa fa-folder'></i> Ver usuarios <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>

<div class="col-lg-3 col-6 col-xs-6 pt-3">
<!-- small box -->
<div class="small-box bg-info">
  <div class="inner">
    <h3>Usuarios</h3>
    <p>Ver todos los usuarios</p>
  </div>
<div class="icon">
  <i class="fa fa-users"></i>
</div>
  <a href="index.php?vista=VerTodosLosUsuariosEn1"><button type="button" class="btn btn-block" style="width: 100%;"><i class='fa fa-users'></i> Ver usuarios <i class="fa fa-arrow-circle-right"></i></button></a>
</div>
</div>

  <?php
  break;
}

?>

</div>





    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">

<?php 

switch ($vista) {

  case 'No':
  include('Administrador/EscritorioAdministrador.php');
  break;

  case 'ArchivosUsuarios':
  include("Administrador/vistaDocumentoAdministrador.php");
  include("Administrador/editarTipoDocumento.php");
  break;
  
  case 'VerTodosLosUsuariosEn1':
  include('Administrador/verUsuariosNormal.php');
  include('Administrador/documentosUsuario.php');
  break;

  case 'mostrarNotificacionAdministrador':
  include('Administrador/mostrarNotificacionAdministrador.php');  
  break;
  
  default:
  include('Administrador/EscritorioAdministrador.php');
  break;
}

include("Administrador/registrarTipoDocumento.php");
include('General/editarUsuario.php');
include("General/modalNotificacion.php");
include('Administrador/enviarMensajeAdministrador.php');

?> 
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
  <div class="panel-footer text-center"><a href="#">Footer (Juan Colmenares) Footer</a>
    <strong>Copyright &copy; 2018</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<?php 



}else{
    header('location:index.php');
}
?>