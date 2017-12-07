 <div class="row">  
 	<div class="col-xs-12">
          <div class="box box-info catalog">
            <div class="box-header">
              <h3 class="box-title"> Lista de almacenes</h3>
              <div class="box-tools" >
                <form id="srchFrm">
	                <div class="input-group input-group-sm" style="width: 350px;">
	                  <input type="text" name="busqueda" id="busqueda" class="form-control pull-right" placeholder="buscar....">
	                  <div class="input-group-btn">
	                    <button type="submit" class="btn btn-default" data-toggle="tooltip" title="Realizar busqueda"><i class="fa fa-search"></i></button>
	                    <button type="button" class="btn btn-success" data-toggle="tooltip" title="Nuevo almacen"><i class="fa fa-plus"></i></button>
	                  </div>
	                </div>
                </form>
              </div>                          
            </div>
            <!-- fixed table header -->
             <table class="table fixed">
                <tbody>
                	<tr>
	                  <th width="25px" align="center">#</th>
	                  <th width="60px">Clave</th>	                  
	                  <th>Nombre</th>
	                  <th width="150px">Encargado</th>
	                  <th width="90px" align="right">Elementos</th>	                  
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
                </tbody>
            </table> 
            <!-- /.box-header -->
            <div class="box-body box-body-catalogo table-responsive no-padding" >
              <table class="table table-hover table-condensed table-striped table-body" id="almTbl">
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
           