<div class="modal fade" id="nuevoProducto">
	<div class="modal-dialog">
		<div class="modal-content" <?php echo $prd ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nuevo producto</h4>
			</div>
			<form id="nvoPrdFrm" class="nvo">
				<div class="modal-body modal-info">					
					<div class="row">
						
						<div class="clearfix"></div>
						<p class="margin ">Información Principal </p>
												
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="clave">Clave</label>
			                  <input type="text" class="form-control required" id="clave" name="clave">
			                </div>
						</div>						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="clave_secundaria">Clave Secundaria</label>
			                  <input type="text" class="form-control required" id="clave_secundaria" name="clave_secundaria">
			                </div>
						</div>	
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="marca">Marca</label>
			                  <input type="text" class="form-control required" id="marca" name="marca">
			                </div>
						</div>	
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="descripcion">Concepto</label>
			                  <input type="text" class="form-control required" id="concepto" name="concepto">
			                </div>
						</div>		
						
						
						<div class="clearfix"></div>
						<p class="margin ">Clasificación </p>
																	
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="id_departamento">Departamento</label>
			                  <select  class="form-control selectpicker required" id="id_departamento" name="id_departamento" data-container="body">			                  	
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
						</div>							
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="id_categoria_padre">Categoría</label>
			                  <select  class="form-control selectpicker required categorias" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-hide-disabled="true">			                  	
			                  	<?php
			                  		if(!empty($cat)){
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($cat as $key => $s) {
			                  				if($s['id_categoria_padre']==0)
												echo '  <option value="'.$s['id_sucursal'].'" data-id_departamento="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
										}
			                  		}
			                  	?>
			                  </select>
			                </div>
						</div>							
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="id_categoria">Subcategoría</label>
			                  <select  class="form-control selectpicker required categorias" id="id_categoria" name="id_categoria" data-container="body"  data-hide-disabled="true">			                  	
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
						</div>	
						
						<div class="clearfix"></div>
						<p class="margin ">Control de existencias y costeo</p>
												
						<div class="col-sm-4 col-sm-offset-2">
							<div class="form-group">
			                  <label for="stock_min">Stock mín.</label>
			                  <input type="text" class="form-control required number" id="stock_min" name="stock_min">
			                </div>
						</div>	
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="stock_max">Stock máx.</label>
			                  <input type="text" class="form-control requiredn number" id="stock_max" name="stock_max">
			                </div>
						</div>							
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="id_unidad_medida_entrada">Unidad de entrada</label>
			                  <select  class="form-control selectpicker required" id="id_unidad_medida_entrada" name="id_unidad_medida_entrada" data-container="body">			                  	
			                  	<?php
			                  		if(!empty($um)){
			                  			ksort($um);
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($um as $mg => $ums) {
			                  				ksort($ums);
			                  				echo '<optgroup  label="'.$mg.'">';
											foreach ($ums as $k => $u) {
												echo '  <option value="'.$s['id_unidad_medida'].'"> [ '.$s['id_unidad_medida'].' ] '.$s['nombre'].'</option> ';
											}														                  				
											echo '</optgroup>';
										}
			                  		}
			                  	?>
			                  </select>
			                </div>
						</div>							
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="id_unidad_medida_salida">Unidad de salida</label>
			                  <select  class="form-control selectpicker required" id="id_unidad_medida_salida" name="id_unidad_medida_salida" data-container="body">			                  	
			                  	<?php
			                  		if(!empty($um)){
			                  			ksort($um);
			                  			echo '<option value="">-- seleccione --</option>';
			                  			foreach ($um as $mg => $ums) {
			                  				ksort($ums);
			                  				echo '<optgroup  label="'.$mg.'">';
											foreach ($ums as $k => $u) {
												echo '  <option value="'.$s['id_unidad_medida'].'"> [ '.$s['id_unidad_medida'].' ] '.$s['nombre'].'</option> ';
											}														                  				
											echo '</optgroup>';
										}
			                  		}
			                  	?>
			                  </select>
			                </div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="factor_unidades">Factor entre unidades</label>
			                  <input type="text" class="form-control required number" id="factor_unidades" name="factor_unidades">
			                </div>
						</div>	
						
						<div class="clearfix"></div>
						<p class="margin ">Venta y garantía </p>
						
						<div class="col-sm-4 col-sm-offset-2">
							<div class="form-group">
			                  <label for="precio_min_venta">Precio mín. de vta.</label>
			                  <input type="text" class="form-control required" id="precio_min_venta" name="precio_min_venta">
			                </div>
						</div>						
												
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="tiempo_garantia">Días Garantía.</label>
			                  <input type="text" class="form-control required number" id="tiempo_garantia" name="tiempo_garantia">
			                </div>
						</div>
						
						<div class="clearfix"></div>
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="observaciones">Observaciones</label>
			                  <textarea type="text" rows="2" style="resize: none" class="form-control" id="observaciones" name="observaciones"></textarea>
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