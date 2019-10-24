<div class="container-fluid">

<!-- Editar  Usuario -->
<form id="frmRegistro" class="demo-form" enctype=multipart/form-data data-parsley-validate>
<div class="modal fade" id="registroUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Registro de Usuario</h4>
        <button class="btn btn-toolbar" data-dismiss="modal" id="cerrarModal">(x)</button>
      </div>
      <div class="modal-body">

<span class="alert-danger" id="error3"></span>

<div class="form-group example">

  <div class="form-section">
        <span class="alert-danger" id="error3"></span>
          <div class="form-group">
          <input type="hidden" name="idUsuario" id="idUsuario" value=""/>
          <div class="input">
          <label for="email">Ingrese el Correo:</label>
          <input class="correo form-control" type="email" name="email" id="email1" placeholder="EMAIL" required>
          </div>
          </div>

        <div class="form-group">
        <div class="input">
        <label for="nombres">Ingrese el Nombre:</label>
        <input type="text" name="nombres" class="form-control" id="nombres" placeholder="NOMBRES" required>
        </div>
        </div>

        <div class="form-group">
        <div class="input">
        <label for="apellidos">Ingrese el Apellido:</label>
        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="APELLIDOS" required>
        </div>
        </div>
  </div>

  <div class="form-section">
        <div class="form-group">
        <div class="input">
        <label for="telefono">Ingrese el Telefono:</label>
        <input class="phone_number form-control" type="text" name="telefono" id="telefono" placeholder="TELEFONO" required>
        </div>
        </div>

        <div class="form-group">
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
        <div class="input">
        <label for="password">Ingrese la Contraseña:</label>
        <input type="password" name="password" id="password1" class="form-control" placeholder="PASSWORD" required>
        </div>
        </div>

        <div class="col-6 col-lg-6 col-sm-6 col-md-6 col-xl-6">
        <div class="input">
        <label for="confirm_password">Repite la Contraseña:</label> 
        <input type="password" name="confirm_password" id="confirm_password1" class="form-control" placeholder="CONFIRMA PASSWORD" required>
        </div>
        </div>
        </div>
        </div>
  </div>
      <!-- </div> -->

  <div class="form-section">
      <div class="form-group">
      <label style="margin-top: 30px">Los archivos permitidos son: (JPEG, JPG, PNG, GIF)</label>
      <div id="fine-uploader-validation"></div>
      <input type="hidden" name="foto_usuario" id="foto_usuario" value=""/>
      </div>
  </div>


      <!-- </div> -->
<div class="modal-footer">
<div class="form-navigation">
    <button type="button" class="previous btn btn-info pull-left">&lt; Anterior</button>
    <button type="button" class="next btn btn-info pull-right">Siguiente &gt;</button>
    <button type="button" id="botonRegistro" class="btn btn-success pull-right">Crear Cuenta</button>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</form>
</div>