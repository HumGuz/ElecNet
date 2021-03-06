 <div class="row">  
 	<div class="col-xs-12">
          <div class="box box-info catalog">
            <div class="box-header">
              <h3 class="box-title"> Lista de servicios</h3>
             	<div class="box-tools pull-right">		      
	                <div class="input-group input-group-sm" style="width: 500px;">
	                  <input type="text" name="busqueda_out" id="busqueda_out" class="form-control pull-right" placeholder="buscar....">
	                  <div class="input-group-btn box-filter-parent">
	                    <?php echo $sucursales_select; ?>
	                    <button type="button" class="btn btn-default filter" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="Filtro avanzado"><i class="fa fa-filter"></i> <i class="fa fa-caret-down"></i></button>
	                    <?php include_once FCPATH.'application/views/servicios/filter.php';?>
                    	<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Nuevo Servicio" data-fn="nuevoServicio"><i class="fa fa-plus"></i></button>
                       </div>
	                </div> 
		    	</div>                           
            </div>
            <!-- fixed table header -->
            <table class="table fixed table-bordered table-condensed">
                <tbody>
                	<tr>
	                  <th width="150px">Clave</th>		                 
	                  <th>Nombre / Descripción</th>        
	                  <th width="100px" class="center">Dep.-Cat.-Sub</th>
	                  <th width="90px" class="right">Ventas</th>
	                  <th width="100px" class="right">Precio Vta.</th>
	                  <th width="60px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
                </tbody>
            </table>  
            <!-- /.box-header -->
            <div class="box-body box-body-catalogo table-responsive no-padding" >
              <table class="table table-hover table-condensed table-striped table-body" id="srvTbl">
                <tbody> </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="overlay" style="display: none"> <i class="fa fa-spinner fa-spin fa-2x" ></i></div> 
          </div>
          <!-- /.box -->
        </div>
 </div>