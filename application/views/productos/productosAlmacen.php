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
	                    <?php include_once FCPATH.'application/views/productos/filter.php';?>
                    	<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Nuevo producto" data-id_almacen="<?php echo $alm['id_almacen'] ?>" data-id_sucursal="<?php echo $alm['id_sucursal'] ?>" data-fn="nuevoProducto"><i class="fa fa-plus"></i></button>
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
	                  <th width="100px" class="center">Dep.-Cat.-Sub</th>
	                  <th width="90px" class="right">Existencia</th>
	                  <th width="90px" class="right">Entradas</th>
	                  <th width="90px" class="right">Salidas</th>
	                  <th width="100px" class="right">Precio Vta.</th>
	                  <th width="100px" class="right">Costo Prom.</th>
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
                </tbody>
            </table> 
            <!-- /.box-header -->
            <div class="box-body box-body-modal table-responsive no-padding" >
              <table class="table table-hover table-condensed table-striped table-bordered table-body" id="scrTbl">
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

			