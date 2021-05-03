<div id="seccion-alm">
	<section class="content-header">
		<h1><i class="fa fa-cube"></i> Almacenes</h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
				Almacenes
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"> Lista de Almacenes</h3>
						<div class="box-tools" >						
								<div class="input-group input-group-sm" style="width: 350px;">
									<input type="text" name="busqueda-alm" id="busqueda-alm" class="form-control pull-right" placeholder="buscar....">
									<div class="input-group-btn">
										<button type="button" class="btn btn-success" title="Nueva sucursal" data-scr="alm" data-fn="nuevoAlmacen"><i class="fa fa-plus"></i></button>
									</div>
								</div>						
						</div>
					</div>
					<div id="catalogo-alm"  class="box-body box-body-catalogo table-responsive no-padding" >
						<table id="tbl-alm" class="table fixed">
							<thead>							
			                	<tr>
				                  <th width="25px" class="center">#</th>
				                  <th width="60px">Clave</th>	                  
				                  <th>Nombre</th>
				                  <th width="150px">Encargado</th>
				                  <th width="90px" class="right">Elementos</th>	  
				                  <th width="120px" class="right">Entradas</th>	  
				                  <th width="120px" class="right">Salidas</th>	  
				                  <th width="120px" class="right">Inventario</th>	                  
				                  <th width="30px" class="center"><span class="glyphicon glyphicon-cog"></span> </th>
				                </tr>               
							</thead>
						</table>
					</div>
					<div class="overlay" style="display: none"><i class="fa fa-spinner fa-spin fa-2x" ></i></div>
				</div>
			</div>
		</div>
	</section>
</div>