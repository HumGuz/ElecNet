<div class="modal fade" id="prd-alm-modal" data-width="800px">
	<div class="modal-content" <?php echo $prd ?>>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title">Nuevo producto</h4>
		</div>
		<form id="nvoPrdAlmFrm" class="nvo">
			<div class="modal-body">
				<div class="row">
					<div class="clearfix"></div>
					<p class="margin ">
						Información Principal
					</p>

					<div class="form-group col-sm-3">
						<label for="clave">Clave</label>
						<input type="text" class="form-control required alphanumeric nowhitespace" id="clave" name="clave">
					</div>

					<div class="form-group col-sm-3">
						<label for="clave_secundaria">Clave Secundaria</label>
						<input type="text" class="form-control alphanumeric nowhitespace" id="clave_secundaria" name="clave_secundaria">
					</div>

					<div class="form-group col-sm-3">
						<label for="marca">Marca</label>
						<input type="text" class="form-control required" id="marca" name="marca">
					</div>

					<div class="form-group col-sm-3">
						<label for="modelo">Modelo</label>
						<input type="text" class="form-control required" id="modelo" name="modelo">
					</div>

					<div class="form-group col-sm-8">
						<label for="descripcion">Concepto</label>
						<input type="text" class="form-control required" id="concepto" name="concepto">
					</div>

					<div class="form-group col-sm-4">
						<label for="id_categoria_padre">Colores</label>
						<select  class="form-control selectpicker required" id="colores" name="colores" data-container="body" multiple="multiple">
							<option value="#FFFFFF" style="background-color:#FFFFFF">Blanco</option>
							<option value="#333333" style="background-color:#333333;color:#FFFFFF">Negro</option>
							<option value="#9f9f9f" style="background-color:#9f9f9f;color:#FFFFFF">Gris</option>
							<option value="#10b9b9" style="background-color:#10b9b9;color:#FFFFFF">Azul</option>
							<option value="#8BC44A" style="background-color:#8BC44A;color:#FFFFFF">Verde</option>
							<option value="#ff9000" style="background-color:#ff9000;color:#FFFFFF">Naranja</option>
						</select>
					</div>

					<div class="form-group col-sm-12">
						<label for="descripcion">Descripción</label>
						<textarea type="text" rows="3" style="resize: none" class="form-control" id="descripcion" name="descripcion"></textarea>
					</div>

					<div class="clearfix"></div>
					<p class="margin ">
						Clasificación
					</p>

					<div class="form-group col-sm-4">
						<label for="id_departamento">Departamento</label>
						<select  class="form-control selectpicker required" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">
							<?php
							if (!empty($dep)) {
								echo '<option value="">-- seleccione --</option>';
								foreach ($dep as $key => $s) {
									echo '  <option value="' . $s['id_departamento'] . '" > [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-sm-4">
						<label for="id_categoria_padre">Categoría</label>
						<select  class="form-control selectpicker required categorias" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">
							<?php
							if (!empty($cat)) {
								echo '<option value="">-- seleccione --</option>';
								foreach ($cat as $key => $s) {
									if ($s['id_categoria_padre'] == 0)
										echo '<option value="' . $s['id_categoria'] . '" data-id_departamento="' . $s['id_departamento'] . '" > [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-sm-4">
						<label for="id_categoria">Subcategoría</label>
						<select  class="form-control selectpicker required categorias" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">
							<?php
							if (!empty($cat)) {
								echo '<option value="">-- seleccione --</option>';
								foreach ($cat as $key => $s) {
									if ($s['id_categoria_padre'] <> 0)
										echo '  <option value="' . $s['id_categoria'] . '" data-id_departamento="' . $s['id_departamento'] . '" data-id_categoria_padre="' . $s['id_categoria_padre'] . '"> [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
								}
							}
							?>
						</select>
					</div>

					<div class="clearfix"></div>
					<p class="margin ">
						Costeo
					</p>

					<div class="form-group col-sm-3">
						<label for="id_unidad_medida_entrada">Unidad de compra</label>
						<select  class="form-control selectpicker required" id="id_unidad_medida_entrada" name="id_unidad_medida_entrada" data-container="body" data-live-search="true">
							<?php
							if (!empty($um)) {
								ksort($um);
								echo '<option value="">-- seleccione --</option>';
								foreach ($um as $mg => $ums) {
									ksort($ums);
									echo '<optgroup  label="' . $mg . '">';
									foreach ($ums as $k => $u) {
										echo '  <option value="' . $u['id_unidad_medida'] . '"> [ ' . $u['id_unidad_medida'] . ' ] ' . $u['nombre'] . '</option> ';
									}
									echo '</optgroup>';
								}
							}
							?>
						</select>
					</div>

					<div class="form-group col-sm-3">
						<label for="id_unidad_medida_salida">Unidad de venta</label>
						<select  class="form-control selectpicker required" id="id_unidad_medida_salida" name="id_unidad_medida_salida" data-container="body" data-live-search="true">
							<?php
							if (!empty($um)) {
								ksort($um);
								echo '<option value="">-- seleccione --</option>';
								foreach ($um as $mg => $ums) {
									ksort($ums);
									echo '<optgroup  label="' . $mg . '">';
									foreach ($ums as $k => $u) {
										echo '  <option value="' . $u['id_unidad_medida'] . '"> [ ' . $u['id_unidad_medida'] . ' ] ' . $u['nombre'] . '</option> ';
									}
									echo '</optgroup>';
								}
							}
							?>
						</select>
					</div>

					<div class="form-group col-sm-2">
						<label for="factor_unidades">Factor</label>
						<input type="text" class="form-control required number" id="factor_unidades" name="factor_unidades">
					</div>

					<div class="form-group col-sm-2">
						<label for="stock_min">Stock mín.</label>
						<input type="text" class="form-control required number" id="stock_min" name="stock_min">
					</div>

					<div class="form-group col-sm-2">
						<label for="stock_max">Stock máx.</label>
						<input type="text" class="form-control required number" id="stock_max" name="stock_max">
					</div>

					<div class=" col-sm-6 margin-up-down">
						Especificaciones
					</div>
					<div class=" col-sm-6 margin-up-down">
						Venta y garantía
					</div>

					<div class="form-group col-sm-3">
						<label for="dimenciones">Dimenciones</label>
						<input type="text" class="form-control " id="dimensiones" name="dimensiones" placeholder="largoXanchoXalto">
					</div>

					<div class="form-group col-sm-3">
						<label for="peso">Peso</label>
						<input type="text" class="form-control " id="peso" name="peso" >
					</div>

					<div class="form-group col-sm-3">
						<label for="precio_venta">Precio de venta.</label>
						<input type="text" class="form-control required number" id="precio_venta" name="precio_venta">
					</div>

					<div class="form-group col-sm-3">
						<label for="tiempo_garantia">Días Garantía.</label>
						<input type="text" class="form-control required number" id="tiempo_garantia" name="tiempo_garantia">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm close-modal" >Cancelar</button>					
				<button id="sb-prd" name="sb-prd" type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
			</div>
		</form>
	</div>
</div>