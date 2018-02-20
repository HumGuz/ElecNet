<div class="box box-primary box-filter">
	<div class="box-header with-border">
		<h3 class="box-title">Filtro avanzado</h3>
	</div>
	<form id="fltrAlmFrm" role="form">
		<div class="box-body box-body-filter row">
			
			<div class="form-group col-sm-12" >
				<label for="descripcion">Busqueda</label>
				<input type="text" class="form-control" id="busqueda" name="busqueda">
			</div>
			
			<div class="clearfix"></div>			
			<p class="margin ">Clasificación</p>
			<div class="form-group col-sm-4">
				<label for="id_departamento">Departamento</label>
				<select  class="form-control selectpicker" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">
					<?php
						if(!empty($dep)) {
							echo '<option value="">-- seleccione --</option>';
							foreach($dep as $key=>$s) {
								echo '  <option value="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
							}
						}
					?>
				</select>
			</div>
			<div class="form-group col-sm-4">
				<label for="id_categoria_padre">Categoría</label>
				<select  class="form-control selectpicker  categorias" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">
					<?php
						if(!empty($cat)) {
							echo '<option value="">-- seleccione --</option>';
							foreach($cat as $key=>$s) {
								if($s['id_categoria_padre']==0)
									echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
							}
						}
					?>
				</select>
			</div>
			<div class="form-group col-sm-4">
				<label for="id_categoria">Subcategoría</label>
				<select  class="form-control selectpicker  categorias" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">
					<?php
						if(!empty($cat)) {
							echo '<option value="">-- seleccione --</option>';
							foreach($cat as $key=>$s) {
								if($s['id_categoria_padre']<>0)
									echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="'.$s['id_categoria_padre'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
							}
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" name="src-btn" class="btn btn-primary">
				<i class="fa fa-filter"></i> Filtrar
			</button>
		</div>
		<div class="close-filter">
			<span class="fa fa-caret-square-o-up"></span>
		</div>
	</form>
</div>