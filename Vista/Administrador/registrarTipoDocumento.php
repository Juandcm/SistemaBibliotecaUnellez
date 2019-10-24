<!-- Registrar tipo documento -->
<form>
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tipo de Documento</h4>
      </div>
      <div class="modal-body">
        <span class="alert-danger" id="error1"></span>
          <div class="form-group">
            <label for="nombreTipo" class="control-label">Nombre del Tipo de Documento:</label>
            <input type="text" class="form-control" id="nombreTipo" name="nombreTipo" required>
          </div>

          <div class="form-group">
            <label for="descripcionTipo" class="control-label">Descripción:</label>
            <input type="text" class="form-control" id="descripcionTipo" name="descripcionTipo" required maxlength="45">
          </div>
          
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarDatos">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>