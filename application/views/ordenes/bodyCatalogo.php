 <div class="row">  
 	<div class="col-xs-12">
          <div class="box box-info catalog">
            <div class="box-header">
              <h3 class="box-title"> Lista de ordenes de compra</h3>
              	<div class="box-tools pull-right ">		      
	                <div class="input-group input-group-sm" style="width: 500px;">
	                  <input type="text" name="busqueda_out" id="busqueda_out" class="form-control pull-right" placeholder="buscar....">
	                  <div class="input-group-btn box-filter-parent">
	                    <?php echo $sucursales_select; ?>
	                    <button type="button" class="btn btn-default filter" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="Filtro avanzado"><i class="fa fa-filter"></i> <i class="fa fa-caret-down"></i></button>
	                    <?php include_once FCPATH.'application/views/ordenes/filter.php'; ?>
                    	<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Nueva orden de compra" data-fn="nuevaOrden"><i class="fa fa-plus"></i></button>
                       </div>
	                </div> 
		    	</div>                         
            </div>
            <!-- fixed table header -->
             <table class="table table-bordered table-condensed fixed">
                <tbody>
                	<tr>	
                	  <th width="120px">Fecha Reg.</th> 					              
	                  <th width="80px">Folio</th>
	                   <th width="90px">Vencimiento</th>	     
	                  <th>Proveedor</th>
	                  <th width="70px" class="right">Productos</th>	                  
	                  <th width="100px"  class="right">Subtotal</th>
	                  <th width="100px"  class="right">Descuento</th>
	                  <th width="100px"  class="right">Gastos Envio</th>
	                  <th width="100px"  class="right">Iva</th>
	                  <th width="100px"  class="right">Total</th>
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
                </tbody>
            </table> 
            <!-- /.box-header -->
            <div class="box-body box-body-catalogo table-responsive no-padding" >
              <table class="table table-hover table-condensed table-striped table-body table-bordered" id="ordTbl">
                <tbody> </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="overlay" style="display: none"> <i class="fa fa-spinner fa-spin fa-2x" ></i></div>
          </div>
          <!-- /.box -->
        </div>
 </div>