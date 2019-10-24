<div class="modal fade" id="enviarMensajeAdministrador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Enviar mensaje al administrador</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
      <form>
      <div class="form-group">
      <input type="hidden" name="idUsuarioDelMensaje" id="idUsuarioDelMensaje" value="">
      
      <label for="mensaje" class="control-label">Escribe el mensaje a enviar:</label>
<textarea id="mensaje" class="form-control" wrap="hard" required="" placeholder="Escribe Tu Mensaje" maxlength="500" style="width:100%;max-height:300px;margin-bottom:10px;"></textarea>
      </div>



      </form>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="enviar">Enviar Mensaje</button>
      </div>
    </div>
  </div>
</div>