<div id="prodAlm-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-productos-almacen" role="document">
    <div class="modal-content">      
        <div class="box main-box">
		  <div class="box-header with-border">
		    <h3 class="box-title">[ <?php echo $alm['clave'] ?> ]  <?php echo $alm['nombre'] ?></h3>
		    <div class="box-tools pull-right">		      
	                <div class="input-group input-group-sm" style="width: 350px;margin-right: 20px">
	                  <input type="text" name="busqueda_out" id="busqueda_out" class="form-control pull-right" placeholder="buscar....">
	                  <div class="input-group-btn box-filter-parent">
	                    <button type="button" class="btn btn-default filter" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="Filtro avanzado"><i class="fa fa-filter"></i> <i class="fa fa-caret-down"></i></button>
	                    	<div class="box box-primary box-filter">
					            <div class="box-header with-border">
					              <h3 class="box-title">Filtro avanzado</h3>
					            </div>
					            <!-- /.box-header -->
					            <!-- form start -->
					            <form role="form">
					              <div class="box-body box-body-filter row">
					               
									<div class="form-group col-sm-12" >
						                 <label for="descripcion">Busqueda</label>
						                 <input type="text" class="form-control" id="busqueda" name="busqueda">
						            </div>					                
					                					                
					                <div class="clearfix"></div>
									<p class="margin ">Clasificación </p>
					             
									<div class="form-group col-sm-4">
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
									<div class="form-group col-sm-4">
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
									<div class="form-group col-sm-4">
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
					                
					                <div class="clearfix"></div>
									<p class="margin ">Unidades de medida</p>		
								
									<div class="form-group col-sm-6">
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
								
									<div class="form-group col-sm-6">
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
					              <!-- /.box-body -->					
					              <div class="box-footer">
					                <button type="submit" name="src-btn" class="btn btn-primary"><i class="fa fa-filter"></i> Filtrar</button>
					              </div>
					              <div class="close-filter"><span class="fa fa-caret-square-o-up"></span> </div>
					            </form>
					          </div>
                    	<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Nuevo producto" data-id_almacen="<?php echo $alm['id_almacen'] ?>" data-fn="nuevoProducto"><i class="fa fa-plus"></i></button>
                    	
	                  </div>
	                </div> 
		    </div>
		    <button type="button" class="close" aria-label="Close" data-dismiss="modal" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Cerrar ventana"><span aria-hidden="true">&times;</span></button>               
		  </div>
		  <!-- fixed table header -->
             <table class="table fixed table-bordered table-condensed">
                <tbody>
                	<tr>
	                  <th width="150px">Clave</th>		                 
	                  <th>Nombre / Descripción</th>
	                  <th width="130px">Marca</th>	          
	                  <th width="100px">Dep.-Cat.-Sub</th>
	                  <th width="90px">Existencia</th>
	                  <th width="100px">U.E - U.S</th>
	                  <th width="1070px">Factor</th>
	                  <th width="110px">Precio Vta.</th>
	                  <th width="110px">Costo Prom.</th>
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
                </tbody>
            </table> 
            <!-- /.box-header -->
            <div class="box-body box-body-modal table-responsive no-padding" >
              <table class="table table-hover table-condensed table-striped table-body" id="scrTbl">
                <tbody> </tbody>
              </table>
            </div>
		  <div class="box-footer">
		    The footer of the box
		  </div>		
		</div>
    </div>
  </div>
</div>

			