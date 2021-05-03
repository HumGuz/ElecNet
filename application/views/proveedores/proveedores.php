<div id="seccion-prv">
	<section class="content-header">
		<h1><i class="fa fa-truck"></i> Proveedores <small></small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
				Proveedores
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info catalog">
			<div class="box-header">
				<h3 class="box-title"> Lista de proveedores</h3>
				<div class="box-tools" >
					<form id="srchFrm">
						<div class="input-group input-group-sm" style="width: 350px;">
							<input type="text" name="busqueda-prv" id="busqueda-prv" class="form-control pull-right" placeholder="buscar....">
							<div class="input-group-btn">								
								<button type="button" class="btn btn-success"  title="Nuevo proveedor" data-scr="prv" data-fn="nuevoProveedor">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>			
			<div id="catalogo-prv"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="prv" data-scr="prv" data-fn="clean" >
				<table id="tbl-prv" class="table fixed">
					<thead>
						<tr>
							<th width="25px">#</th>
							<th width="60px">Clave</th>
							<th width="100px">RFC</th>
							<th>Nombre</th>
							<th width="150px">Encargado</th>
							<th width="90px">Tel. Cel</th>
							<th width="250px">Email</th>
							<th width="110px">Mto. compras</th>
							<th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span></th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="overlay" style="display: none">
				<i class="fa fa-spinner fa-spin fa-2x" ></i>
			</div>
		</div>
	</section>
</div>