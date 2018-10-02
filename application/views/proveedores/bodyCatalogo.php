 <div class="row">  
 	<div class="col-xs-12">
          <div class="box box-info catalog">
            <div class="box-header">
              <h3 class="box-title"> Lista de proveedores</h3>
              <div class="box-tools" >
                <form id="srchFrm">
	                <div class="input-group input-group-sm" style="width: 350px;">
	                  <input type="text" name="busqueda" id="busqueda" class="form-control pull-right" placeholder="buscar....">
	                  <div class="input-group-btn">
	                    <button type="submit" class="btn btn-default" data-toggle="tooltip" title="Realizar busqueda"><i class="fa fa-search"></i></button>
	                    <button type="button" class="btn btn-success" data-toggle="tooltip" title="Nuevo proveedor"><i class="fa fa-plus"></i></button>
	                  </div>
	                </div>
                </form>
              </div>                          
            </div>
            <!-- fixed table header -->
             <table class="table fixed">
                <tbody>
                	<tr>
	                  <th width="25px">#</th>
	                  <th width="40px">Clave</th>
	                  <th width="100px">RFC</th>	                  
	                  <th>Nombre</th>
	                  <th width="150px">Encargado</th>
	                  <th width="90px">Tel. Fijo</th>
	                  <th width="90px">Tel. Cel</th>
	                  <th width="250px">Email</th>
	                  <th width="110px">Mto. compras</th>
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
                </tbody>
            </table> 
            <!-- /.box-header -->
            <div class="box-body box-body-catalogo table-responsive no-padding" >
              <table class="table table-hover table-condensed table-striped table-body" id="prvTbl">
                <tbody> </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <!-- <div class="overlay">
			  <i class="fa fa-spinner fa-spin fa-2x" ></i>
			</div> -->
          </div>
          <!-- /.box -->
        </div>
 </div>