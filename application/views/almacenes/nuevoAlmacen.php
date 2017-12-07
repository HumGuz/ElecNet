<div class="modal fade" id="nuevoAlmacen">
	<div class="modal-dialog">
		<div class="modal-content" <?php echo $alm ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nuevo Almacen</h4>
			</div>
			<form id="nvoAlmFrm" class="nvo">
				<div class="modal-body modal-info">					
					<div class="row">						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="clave">Clave</label>
			                  <input type="text" class="form-control required" id="clave" name="clave">
			                </div>
						</div>						
						<div class="col-sm-8">
							<div class="form-group">
			                  <label for="nombre">Nombre</label>
			                  <input type="text" class="form-control required" id="nombre" name="nombre">
			                </div>
						</div>						
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="encargado">Nombre del encargado</label>
			                  <input type="text" class="form-control required" id="encargado" name="encargado">
			                </div>
						</div>		
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="id_sucursal">Sucursal</label>
			                  <select  class="form-control selectpicker required" id="id_sucursal" name="id_sucursal" data-container="body">			                  	
			                  	<?php
			                  		if(!empty($scrs)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($scrs as $key => $s) {
											echo '  <option value="'.$s['id_sucursal'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>
			                </div>
						</div>	
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success  btn-sm"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar </button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>