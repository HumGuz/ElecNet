<<<<<<< HEAD
<div id="seccion-prd">
	<section class="content-header">
		<h1><i class="fa fa-book"></i> Catalogo de Productos <small></small></h1>
		<ol class="breadcrumb">
			<li> <a href="#"><i class="fa fa-dashboard"></i> Inicio</a> </li>			
			<li class="active"> Catálogo de Productos  </li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools pull-right">
							<div class="input-group input-group-sm" style="width: 400px;">
								<input type="text" name="busqueda-prd" id="busqueda-prd" class="form-control pull-right" placeholder="buscar....">
								<div class="input-group-btn box-filter-parent">									
									<button type="button" class="btn btn-default filter" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="Filtro avanzado">
										<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
									</button>
									<div class="box box-primary box-filter">
										<div class="box-header with-border">
											<h3 class="box-title">Filtro avanzado</h3>
										</div>
										<form id="srch-prd" role="form">
											<div class="box-body box-body-filter row">									
												<div class="form-group col-sm-12" >
													<label for="descripcion">Busqueda</label>
													<input type="text" class="form-control" id="busqueda" name="busqueda">
												</div>									
												<div class="clearfix"></div>
												<p class="margin ">
													Clasificación
												</p>
												<div class="form-group col-sm-4">
													<label for="id_departamento">Departamento</label>
													<select  class="form-control selectpicker no-multiple" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">
														<?php
														if (!empty($dep)) {
															echo '<option value="">-- seleccione --</option>';
															foreach ($dep as $key => $s) {
																echo '  <option value="' . $s['id_departamento'] . '" > [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
															}
														}
														?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="id_categoria_padre">Categoría</label>
													<select  class="form-control selectpicker  categorias no-multiple" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">
														<?php
														if (!empty($cat)) {
															echo '<option value="">-- seleccione --</option>';
															foreach ($cat as $key => $s) {
																if ($s['id_categoria_padre'] == 0)
																	echo '  <option value="' . $s['id_categoria'] . '" data-id_departamento="' . $s['id_departamento'] . '" > [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
															}
														}
														?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="id_categoria">Subcategoría</label>
													<select  class="form-control selectpicker  categorias no-multiple" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">
														<?php
														if (!empty($cat)) {
															echo '<option value="">-- seleccione --</option>';
															foreach ($cat as $key => $s) {
																if ($s['id_categoria_padre'] <> 0)
																	echo '  <option value="' . $s['id_categoria'] . '" data-id_departamento="' . $s['id_departamento'] . '" data-id_categoria_padre="' . $s['id_categoria_padre'] . '"> [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
															}
														}
														?>
													</select>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="box-footer">
												<button type="submit" name="prd-btn" class="btn btn-primary">
													<i class="fa fa-filter"></i> Filtrar
												</button>
												<button type="reset" name="prd-rst" class="btn btn-default" style="margin-left:5px">
													<i class="fa fa-eraser"></i>
												</button>
											</div>
											<div class="close-filter">
												<span class="fa fa-caret-square-o-up"></span>
											</div>
										</form>
									</div>
									<!-- <button type="button" class="btn btn-success" data-scr="prd" data-fn="nuevoProducto" title="Nuevo Producto">
										<i class="fa fa-plus"></i>
									</button> -->
								</div>
							</div>
						</div>
					</div>				
					<div id="catalogo-prd"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="prd" data-scr="prd" data-fn="clean" >
						<table id="tbl-prd" class="table fixed">
							<thead>							
			                	<tr>
									<th width="150px">Clave</th>
									<th>Nombre / Descripción</th>
									<th width="130px">Marca Modelo</th>
									<th width="130px" class="center">Dep.-Cat.-Sub</th>
									<th width="90px">Dimensiones</th>
									<th width="70px">Peso</th>
									<th width="70px">Garantía</th>
									<th width="90px" class="right">Precio Vta.</th>
									<th width="90px" class="right">Costo Prom.</th>
									<th width="60px" class="center"><span class="glyphicon glyphicon-cog"></span></th>
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
=======
<div id="seccion-prd">
	<section class="content-header">
		<h1><i class="fa fa-book"></i> Catalogo de Productos <small></small></h1>
		<ol class="breadcrumb">
			<li> <a href="#"><i class="fa fa-dashboard"></i> Inicio</a> </li>			
			<li class="active"> Catálogo de Productos  </li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools pull-right">
							<div class="input-group input-group-sm" style="width: 400px;">
								<input type="text" name="busqueda-prd" id="busqueda-prd" class="form-control pull-right" placeholder="buscar....">
								<div class="input-group-btn box-filter-parent">									
									<button type="button" class="btn btn-default filter" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="Filtro avanzado">
										<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
									</button>
									<div class="box box-primary box-filter">
										<div class="box-header with-border">
											<h3 class="box-title">Filtro avanzado</h3>
										</div>
										<form id="srch-prd" role="form">
											<div class="box-body box-body-filter row">									
												<div class="form-group col-sm-12" >
													<label for="descripcion">Busqueda</label>
													<input type="text" class="form-control" id="busqueda" name="busqueda">
												</div>									
												<div class="clearfix"></div>
												<p class="margin ">
													Clasificación
												</p>
												<div class="form-group col-sm-4">
													<label for="id_departamento">Departamento</label>
													<select  class="form-control selectpicker no-multiple" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">
														<?php
														if (!empty($dep)) {
															echo '<option value="">-- seleccione --</option>';
															foreach ($dep as $key => $s) {
																echo '  <option value="' . $s['id_departamento'] . '" > [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
															}
														}
														?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="id_categoria_padre">Categoría</label>
													<select  class="form-control selectpicker  categorias no-multiple" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">
														<?php
														if (!empty($cat)) {
															echo '<option value="">-- seleccione --</option>';
															foreach ($cat as $key => $s) {
																if ($s['id_categoria_padre'] == 0)
																	echo '  <option value="' . $s['id_categoria'] . '" data-id_departamento="' . $s['id_departamento'] . '" > [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
															}
														}
														?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="id_categoria">Subcategoría</label>
													<select  class="form-control selectpicker  categorias no-multiple" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">
														<?php
														if (!empty($cat)) {
															echo '<option value="">-- seleccione --</option>';
															foreach ($cat as $key => $s) {
																if ($s['id_categoria_padre'] <> 0)
																	echo '  <option value="' . $s['id_categoria'] . '" data-id_departamento="' . $s['id_departamento'] . '" data-id_categoria_padre="' . $s['id_categoria_padre'] . '"> [ ' . $s['clave'] . ' ] ' . $s['nombre'] . '</option> ';
															}
														}
														?>
													</select>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="box-footer">
												<button type="submit" name="prd-btn" class="btn btn-primary">
													<i class="fa fa-filter"></i> Filtrar
												</button>
												<button type="reset" name="prd-rst" class="btn btn-default" style="margin-left:5px">
													<i class="fa fa-eraser"></i>
												</button>
											</div>
											<div class="close-filter">
												<span class="fa fa-caret-square-o-up"></span>
											</div>
										</form>
									</div>
									<!-- <button type="button" class="btn btn-success" data-scr="prd" data-fn="nuevoProducto" title="Nuevo Producto">
										<i class="fa fa-plus"></i>
									</button> -->
								</div>
							</div>
						</div>
					</div>				
					<div id="catalogo-prd"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="prd" data-scr="prd" data-fn="clean" >
						<table id="tbl-prd" class="table fixed">
							<thead>							
			                	<tr>
									<th width="150px">Clave</th>
									<th>Nombre / Descripción</th>
									<th width="130px">Marca Modelo</th>
									<th width="130px" class="center">Dep.-Cat.-Sub</th>
									<th width="90px">Dimensiones</th>
									<th width="70px">Peso</th>
									<th width="70px">Garantía</th>
									<th width="90px" class="right">Precio Vta.</th>
									<th width="90px" class="right">Costo Prom.</th>
									<th width="60px" class="center"><span class="glyphicon glyphicon-cog"></span></th>
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
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
