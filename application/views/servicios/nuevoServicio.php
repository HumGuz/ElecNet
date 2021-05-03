<<<<<<< HEAD
<div class="modal fade" id="srv-modal" data-width="700px">	
		<div class="modal-content" <?php echo $srv ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nuevo servicio</h4>
			</div>
			<form id="nvoSrvFrm" class="nvo">
				<div class="modal-body">					
					<div class="row">						
						<div class="clearfix"></div>
						<p class="margin ">Información Principal </p>
												
						<div class="form-group col-sm-3">
			                  <label for="clave">Clave</label>
			                  <input type="text" class="form-control required alphanumeric nowhitespace" id="clave" name="clave">
						</div>		
										
						<div class="form-group col-sm-3">
			                  <label for="clave_secundaria">Clave Secundaria</label>
			                  <input type="text" class="form-control required  alphanumeric nowhitespace" id="clave_secundaria" name="clave_secundaria">
						</div>	
						<div class="clearfix"></div>
						<div class="form-group col-sm-12">
			                  <label for="descripcion">Concepto</label>
			                  <input type="text" class="form-control required" id="concepto" name="concepto">
			            </div>
						
						<div class="form-group col-sm-12">
			                <label for="descripcion">Descripción</label>
			                <textarea type="text" rows="3" style="resize: none" class="form-control" id="descripcion" name="descripcion"></textarea>
			            </div>						
												
						<div class="clearfix"></div>
						<p class="margin ">Clasificación </p>
																	
						<div class="form-group col-sm-4">
			                  <label for="id_departamento">Departamento</label>
			                  <select  class="form-control selectpicker required" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">			                  	
			                  	<?php
			                  		if(!empty($dep)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($dep as $key => $s) {
											echo '  <option value="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>
						</div>							
						<div class="form-group col-sm-4">
			                  <label for="id_categoria_padre">Categoría</label>
			                  <select  class="form-control selectpicker required categorias" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">			                  	
			                  	<?php
			                  		if(!empty($cat)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($cat as $key => $s) {
			                  				if($s['id_categoria_padre']==0)
												echo '<option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>			            
						</div>							
						<div class="form-group col-sm-4">
			                  <label for="id_categoria">Subcategoría</label>
			                  <select  class="form-control selectpicker required categorias" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">			                  	
			                  	<?php
			                  		if(!empty($cat)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($cat as $key => $s) {
			                  				if($s['id_categoria_padre']<>0)
												echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="'.$s['id_categoria_padre'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>
						</div>									
					
						<div class="clearfix"></div>
						<p class="margin ">Venta y garantía </p>
						
						<div class="form-group col-sm-3">
			                  <label for="precio_venta">Precio de venta.</label>
			                  <input type="text" class="form-control required number" id="precio_venta" name="precio_venta">
						</div>	
												
						<div class="form-group col-sm-3">
			                  <label for="tiempo_garantia">Días Garantía.</label>
			                  <input type="text" class="form-control required number" id="tiempo_garantia" name="tiempo_garantia">
						</div>	
						
						<div class="clearfix"></div>
						
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
				</div>
			</form>
		</div>		
=======
<div class="modal fade" id="srv-modal" data-width="700px">	
		<div class="modal-content" <?php echo $srv ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nuevo servicio</h4>
			</div>
			<form id="nvoSrvFrm" class="nvo">
				<div class="modal-body">					
					<div class="row">						
						<div class="clearfix"></div>
						<p class="margin ">Información Principal </p>
												
						<div class="form-group col-sm-3">
			                  <label for="clave">Clave</label>
			                  <input type="text" class="form-control required alphanumeric nowhitespace" id="clave" name="clave">
						</div>		
										
						<div class="form-group col-sm-3">
			                  <label for="clave_secundaria">Clave Secundaria</label>
			                  <input type="text" class="form-control required  alphanumeric nowhitespace" id="clave_secundaria" name="clave_secundaria">
						</div>	
						<div class="clearfix"></div>
						<div class="form-group col-sm-12">
			                  <label for="descripcion">Concepto</label>
			                  <input type="text" class="form-control required" id="concepto" name="concepto">
			            </div>
						
						<div class="form-group col-sm-12">
			                <label for="descripcion">Descripción</label>
			                <textarea type="text" rows="3" style="resize: none" class="form-control" id="descripcion" name="descripcion"></textarea>
			            </div>						
												
						<div class="clearfix"></div>
						<p class="margin ">Clasificación </p>
																	
						<div class="form-group col-sm-4">
			                  <label for="id_departamento">Departamento</label>
			                  <select  class="form-control selectpicker required" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">			                  	
			                  	<?php
			                  		if(!empty($dep)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($dep as $key => $s) {
											echo '  <option value="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>
						</div>							
						<div class="form-group col-sm-4">
			                  <label for="id_categoria_padre">Categoría</label>
			                  <select  class="form-control selectpicker required categorias" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">			                  	
			                  	<?php
			                  		if(!empty($cat)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($cat as $key => $s) {
			                  				if($s['id_categoria_padre']==0)
												echo '<option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>			            
						</div>							
						<div class="form-group col-sm-4">
			                  <label for="id_categoria">Subcategoría</label>
			                  <select  class="form-control selectpicker required categorias" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">			                  	
			                  	<?php
			                  		if(!empty($cat)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($cat as $key => $s) {
			                  				if($s['id_categoria_padre']<>0)
												echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="'.$s['id_categoria_padre'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>
						</div>									
					
						<div class="clearfix"></div>
						<p class="margin ">Venta y garantía </p>
						
						<div class="form-group col-sm-3">
			                  <label for="precio_venta">Precio de venta.</label>
			                  <input type="text" class="form-control required number" id="precio_venta" name="precio_venta">
						</div>	
												
						<div class="form-group col-sm-3">
			                  <label for="tiempo_garantia">Días Garantía.</label>
			                  <input type="text" class="form-control required number" id="tiempo_garantia" name="tiempo_garantia">
						</div>	
						
						<div class="clearfix"></div>
						
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
				</div>
			</form>
		</div>		
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
</div>