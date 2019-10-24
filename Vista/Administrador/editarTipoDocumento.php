<!-- Editar tipo documento -->
<form id="guardarDatos3">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Editar Tipo de Documento</h4>
      </div>
      <div class="modal-body">
        <span class="alert-danger" id="error"></span>
          <div class="form-group">
            <label for="nombreTipo2" class="control-label">Nombre del Tipo de Documento:</label>
            <input type="hidden" name="idTipoDocumento" id="idTipoDocumento" value="">
            <input type="text" class="form-control" id="nombreTipo2" name="nombreTipo2" required>
          </div>

          <div class="form-group">
            <label for="descripcionTipo2" class="control-label">Descripción:</label>
            <input type="text" class="form-control" id="descripcionTipo2" name="descripcionTipo2" required maxlength="45">
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarDatos2">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>