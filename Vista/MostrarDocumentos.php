<div class="container-fluid">
	<div class="row">

<div class="col-sm-2">
          <select class="form-control input-sm selectpicker" id="id_campo" data-live-search="true">
            <option value="0" selected>Titulo</option>
            <option value="1">Autor</option>
            <option value="2">Tipo de Archivo</option>
          </select>
</div>

<!-- Botones de busqueda y de inicio -->
  <div class="col-sm-2">
      <input type="text" class="form-control input-sm" id="valor_a_comparar" placeholder="Buscar titulo del documento">
  </div>
  <div class="col-sm-4">
      <input type="button" class="btn btn-primary btn-sm" id="boton_buscar" value="Buscar" disabled>
      <input type="button" class="btn btn-warning btn-sm" id="boton_resetear" value="Resetear búsqueda" disabled>
  </div>
  <div class="col-sm-4"></div>
<div class="mx-auto pt-5 pb-5">
<a href="index.php"><button class="btn btn-success">Inicio</button></a>
</div>
<!--  -->

<div class="col-12">    
<div class="panel-body">
<table cellpadding="0" cellspacing="0" border="0" id="example" class="display table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Contenido</th>
                </thead>
                <tbody class="cuerpo">
                </tbody>
              </table>

</div>
		</div>
	</div>
</div>
