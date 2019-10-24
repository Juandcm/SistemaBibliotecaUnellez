<div class="login-box">
  <div class="login-logo">
<h2><b>Cambiar la contraseña de la cuenta </b></h2>

  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-center">Reiniciar contraseña de su cuenta</p>


<div class="regisFrm" id="regisFrm">
<form id="frmAcceso">
<div class="form-group">
		<label for="password">Escribe la contraseña</label>

<div class="input-group mb-6">
	<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
	<div class="input-group-append">
    	<span class="input-group-text"><i class="fa fa-lock"></i></span>
	</div>
</div>
</div>

<div class="form-group">
	<label for="confirm_password">Escribe la contraseña de nuevo</label>
<div class="input-group mb-6">
	<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repite la contraseña" required>
	<div class="input-group-append">
    	<span class="input-group-text"><i class="fa fa-lock"></i></span>
	</div>
</div>
</div>

	<div class="send-button">
		<input type="hidden" name="fp_code" id="fp_code" value="<?php echo $_REQUEST['fp_code']; ?>"/>
		<button type="button" class="btn btn-success" id="frmReinciarPassword">REINICIAR PASSWORD</button>
	</div>
</form>
</div>
<hr>
      <p class="mb-1">
        <a href="index.php?"><button class="btn btn-secondary" data-toggle="modal" data-target="#enviarCorreo">
    Volver al inicio         
        </button>
    	</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->