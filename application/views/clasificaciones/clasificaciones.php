<div id="seccion-cls">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;Clasificación de productos</h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
				Clasificación de productos
			</li>
		</ol>
	</section>
	<section class="content">
		<div id="clasTbl" class="row">
			<div class="col-xs-4 col-sm-4">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"> Departamentos</h3>
						<div class="box-tools" >
							<form id="depSrchFrm">
								<div class="input-group input-group-sm" style="width: 180px;">
									<input type="text" name="busqueda" id="busqueda" class="form-control pull-right  bus-cat" placeholder="buscar....">
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"  title="Realizar busqueda">
											<i class="fa fa-search"></i>
										</button>
										<button type="button" class="btn btn-success"  title="Nuevo departamento"  data-scr="cls"  data-fn="nuevaClasificacion" data-op="1">
											<i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div id="depList" class="box-body box-body-list box-body-catalogo  table-responsive no-padding" >

					</div>
				</div>
			</div>
			<div class="col-xs-4 col-sm-4">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"> Categorías</h3>
						<div class="box-tools" >
							<form id="catSrchFrm">
								<div class="input-group input-group-sm" style="width: 180px;">
									<input type="text" name="busqueda" id="busqueda" class="form-control pull-right  bus-cat" placeholder="buscar....">
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"  title="Realizar busqueda">
											<i class="fa fa-search"></i>
										</button>
										<button type="button" class="btn btn-success"  title="Nueva categoría"  data-scr="cls"  data-fn="nuevaClasificacion"  data-op="2">
											<i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div  id="catList" class="box-body box-body-list box-body-catalogo  table-responsive no-padding" >
						<blockquote>
							<p>
								<i class="fa fa-info text-aqua"></i>&nbsp;&nbsp;&nbsp;Seleccione un departamento
							</p>
						</blockquote>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<div class="col-xs-4 col-sm-4">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"> Subcategorías</h3>
						<div class="box-tools" >
							<form id="subCatSrchFrm">
								<div class="input-group input-group-sm" style="width: 180px;">
									<input type="text" name="busqueda" id="busqueda" class="form-control pull-right bus-cat" placeholder="buscar....">
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"  title="Realizar busqueda">
											<i class="fa fa-search"></i>
										</button>
										<button type="button" class="btn btn-success"  title="Nueva subcategoría" data-scr="cls" data-fn="nuevaClasificacion" data-op="3">
											<i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div id="subCatList" class="box-body box-body-list box-body-catalogo  table-responsive no-padding" >
						<blockquote>
							<p>
								<i class="fa fa-info text-aqua"></i>&nbsp;&nbsp;&nbsp;Seleccione una categoría
							</p>
						</blockquote>
					</div>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>
</div>