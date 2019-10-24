		<h4>Subir un Documento Nuevo</h4>
		<div class="regisFrm col-md-12">

<span class="clearfix"><hr></span>
<div class="form-group example">
<form id="frmRegistroDocumento" class="demo-form" enctype=multipart/form-data data-parsley-validate>
<div class="form-section">
	<div class="form-group">
 			<label for="titulo">Ingrese el titulo del documento:</label>
				<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo" required>

			<label for="autor">Ingrese el autor del documento:</label>
				<input type="text" name="autor" id="autor" class="form-control" placeholder="Autor" required>

			<label for="resumen">Ingrese el resumen del documento:</label>
			<textarea name="resumen" id="resumen" class="form-control" placeholder="Resumen corto del documento" minlength="0" maxlength="500"></textarea>
	</div>
</div>
				
<div class="form-section">
	<div class="form-group">
 			<label for="ubicacionfisica">Ingrese la ubicación física del archivo:</label>
			<input type="text" name="ubicacionfisica" id="ubicacionfisica" class="form-control" placeholder="Ubicación" required>
			
			<label for="idTipoDocumento">Tipo de Documento </label>
            <select  id="idTipoDocumento" class="form-control" name="idTipoDocumento" class="form-control selectpicker" data-live-search="true" required>
			</select>
			
			<label style="margin-top: 30px">Los archivos permitidos son: (PDF, TXT, DOC, DOCX, XLS, PPT)</label>

			<div id="fine-uploader-validation2"></div>
	</div>
</div>

			<input type="hidden" name="url_archivo" id="url_archivo" value=""/>

  			<div class="form-navigation">
    <button type="button" class="previous btn btn-info pull-left">&lt; Anterior</button>
    <button type="button" class="next btn btn-info pull-right">Siguiente &gt;</button>
	<!-- <div class="send-button"> -->
    	<input type="submit" class="btn btn-success pull-right" name="subirDocumento" value="Subir Documento" />


	<!-- </div> -->
 		</div>

			</form>
		</div>
	</div>