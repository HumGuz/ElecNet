<div class="box box-primary box-filter">
	<div class="box-header with-border">
		<h3 class="box-title">Filtro avanzado</h3>
	</div>
	<form id="srchFrm" role="form">
		<div class="box-body box-body-filter row">
			
			<div class="form-group col-sm-12" >
				<label for="descripcion">Busqueda</label>
				<input type="text" class="form-control" id="busqueda" name="busqueda">
			</div>
			
			<div class="clearfix"></div>	
			
			<div class="form-group col-sm-12" >
				<label for="descripcion">Clave de producto</label>
				<input type="text" class="form-control" id="producto" name="producto">
			</div>
			
			<div class="clearfix"></div>	
			
			<div class="form-group col-sm-12">
				<label for="id_departamento">Proveedor</label>
				<select  class="form-control selectpicker" id="id_proveedor" name="id_proveedor" data-container="body" data-live-search="true" multiple="multiple">
					<?php
						if(!empty($prv)) {							
							foreach($prv as $key=>$s) {
								echo '  <option value="'.$s['id_proveedor'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
							}
						}
					?>
				</select>
			</div>			
			<div class="clearfix"></div>				
			
			 <div class="form-group col-sm-12">
                <label>Rango de fechas:</label>
                <div class="input-group" style="width: 100%">
                  <button type="button"  class="btn btn-default pull-right ignore" id="daterange-btn" style="width: 100%">
                    <span>
                      <i class="fa fa-calendar"></i>
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>
			
			  <input type="hidden" id="fecha_inicial" name="fecha_inicial">
			  <input type="hidden" id="fecha_final" name="fecha_final">
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