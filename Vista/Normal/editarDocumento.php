<!-- Editar  documento -->
<form enctype=multipart/form-data data-parsley-validate>
<div class="modal fade" id="editarDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel1">Editar Documento</h4>
      </div>
      <div class="modal-body">
        <span class="alert-danger" id="error"></span>
          <div class="form-group">
            <label for="titulo" class="control-label">Titulo del documento:</label>
            <input type="text" name="titulo" id="titulo" placeholder="" required>
            <input type="hidden" name="idDocumento" id="idDocumento" value="">
          </div>
        <div class="form-group">
          <label for="autor">Autor del documento:</label>
          <input type="text" name="autor" id="autor" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="resumen">Resumen del documento:</label>
          <textarea name="resumen" id="resumen" minlength="0" maxlength="500" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="ubicacionfisica">Ingrese la ubicación física del archivo:</label>
          <input type="text" class="form-control" name="ubicacionfisica" id="ubicacionfisica" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="idTipoDocumento">Tipo de Documento </label>
<select  id="idTipoDocumento" name="idTipoDocumento" class="form-control selectpicker" data-live-search="true" required>
      </select>
        </div>
        <div class="form-group">
          <label style="margin-top: 30px">Los archivos permitidos son: (PDF, TXT, DOC, DOCX, XLS, PPT)</label>
          <div id="fine-uploader-validation2"></div>
          <input type="hidden" name="url_archivo" id="url_archivo" value=""/>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarDatos3">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>