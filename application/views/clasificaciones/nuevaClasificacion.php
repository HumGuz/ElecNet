<div class="modal fade" id="nuevaClasificacion">
	<div class="modal-dialog">
		<div class="modal-content" <?php echo $obj ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><?php echo $title ?></h4>
			</div>
			<form id="nvoClasFrm" class="nvo">
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
						
						<?php if($d['op']==2 || $d['op']==3 ): ?>
							<div class="col-sm-12">
								<div class="form-group">
				                  <label for="id_departamento">Departamento</label>
				                  <select  class="form-control selectpicker required" id="id_departamento" name="id_departamento" data-container="body">			                  	
				                  	<?php
				                  		if(!empty($dep)){
				                  			echo '<option value="">-- seleccione --</option>';
				                  			foreach ($dep as $key => $s) {
												echo '  <option value="'.$s['id_departamento'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
											}
				                  		}
				                  	?>
				                  </select>
				                </div>
							</div>	
						<?php endif; 
						
						if($d['op']==3): ?>
							<div class="col-sm-12">
								<div class="form-group">
				                  <label for="id_categoria_padre">Categoría Padre</label>
				                  <select  class="form-control selectpicker required" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-hide-disabled="true">			                  	
				                  	<?php
				                  		if(!empty($cat)){
				                  			echo '<option value="">-- seleccione --</option>';
				                  			foreach ($cat as $key => $s) {
												echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
											}
				                  		}
				                  	?>
				                  </select>
				                </div>
							</div>	
						<?php endif; ?>
						
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="encargado">Descripción</label>
			                  <input type="text" class="form-control required" id="descripcion" name="descripcion">
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