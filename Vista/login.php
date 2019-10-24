<script type="text/template" id="qq-template-validation">
  <?php include "PlantillaSubidaFiles.php"; ?>
</script>

<div class="text-center pt-5">
<p class="mb-1">    
		<a href="index.php?vista=MostrarDocumentos"><button class="btn btn-primary alert-warning">Mostrar los Documentos del sistema</button></a>
</p>
</div>
<div class="login-box">
  <div class="login-logo">
<h2><b>LOGIN DE LA PÁGINA</b></h2>

  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-center">Acceder a mi Cuenta como un usuario normal</p>


<div class="regisFrm" id="regisFrm">
<form id="frmAcceso">

<div class="form-group">
<div class="input-group mb-6">
	<input type="email" class="form-control" id="email" name="email" placeholder="EMAIL" required>
	<div class="input-group-append">
    	<span class="input-group-text"><i class="fa fa-envelope"></i></span>
	</div>
</div>
</div>

<div class="form-group">
<div class="input-group mb-6">
	<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
	<div class="input-group-append">
    	<span class="input-group-text"><i class="fa fa-lock"></i></span>
	</div>
</div>
</div>

<div class="row">
	<!-- <div class="col-8">
    <div class="checkbox icheck">
    	<label>
        <input type="checkbox"> Remember Me
        </label>
	</div>
	</div> -->
<!-- /.col -->
<!-- <div class="col-4"></div> -->
<div class="col-4">
<div class="send-button">
	<input class="btn btn-primary" type="submit" name="loginSubmit" value="INICIAR SESIÓN">
</div>
</div>
<!-- /.col -->
</div>

</form>
</div>

<hr>

<p>Para iniciar como Administrador tienes que dar click <a href="index.php?vista=EntrarAdministrador">aqui</a></p>

      <p class="mb-1">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#enviarCorreo">
    Reiniciar Contraseña          
        </button>
      </p>
      <p class="mb-0">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#registroUsuario">
    Registrarme          
        </button>
<!--         <p>No tienes una cuenta? <a href="index.php?vista=registrar" id="botonRegistrar">Registrarme</a></p> -->
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->




<?php 
include('registro.php');
include('enviarcontrasena.php');
?>  