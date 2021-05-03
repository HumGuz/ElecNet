<div id="seccion-clt">
	<section class="content-header">
		<h1><i class="fa fa-truck"></i> Clientes <small></small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
				Clientes
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info catalog">
			<div class="box-header">
				<h3 class="box-title"> Lista de clientes</h3>
				<div class="box-tools" >
					<div class="input-group input-group-sm" style="width: 350px;">
						<input type="text" name="busqueda-clt" id="busqueda-clt" class="form-control pull-right" placeholder="buscar....">
						<div class="input-group-btn">
							<button type="button" class="btn btn-success" title="Nuevo cliente" data-scr="clt" data-fn="nuevoCliente">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div id="catalogo-clt"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="clt" data-scr="clt" data-fn="clean" >
				<table id="tbl-clt" class="table fixed">
					<thead>
						<tr>
							<th width="25px">#</th>
							<th width="40px">Clave</th>
							<th width="100px">RFC</th>
							<th>Nombre</th>
							<th width="150px">Contacto</th>
							<th width="90px">Tel. Cel</th>
							<th width="200px">Email</th>
							<th width="110px" class="right"> Mto. ventas</th>
							<th width="90px" class="right">Desc Gral.</th>
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