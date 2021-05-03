<div id="seccion-srv">
	<section class="content-header">
		<h1><i class="fa fa-cogs"></i> Servicios</h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
				Servicios
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info catalog">
					<div class="box-header">
						<h3 class="box-title"> Lista de servicios</h3>
						<div class="box-tools pull-right">
							<div class="input-group input-group-sm" style="width: 500px;">
								<input type="text" name="busqueda-srv" id="busqueda-srv" class="form-control pull-right" placeholder="buscar....">
								<div class="input-group-btn box-filter-parent">
									<button type="button" class="btn btn-default filter" title="Filtro avanzado">
										<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
									</button>
									<div class="box box-primary box-filter">
										<div class="box-header with-border">
											<h3 class="box-title">Filtro avanzado</h3>
										</div>
										<form id="srch-srv" role="form">
											<div class="box-body box-body-filter row">												
												<div class="form-group col-sm-12" >
													<label for="descripcion">Busqueda</label>
													<input type="text" class="form-control" id="busqueda" name="busqueda">
												</div>												
												<div class="clearfix"></div>			
												<p class="margin ">Clasificación</p>
												<div class="form-group col-sm-4">
													<label for="id_departamento">Departamento</label>
													<select  class="form-control selectpicker" id="id_departamento" name="id_departamento" data-container="body" data-live-search="true">
														<?php
															if(!empty($dep)) {
																echo '<option value="">-- seleccione --</option>';
																foreach($dep as $key=>$s) {
																	echo '  <option value="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
																}
															}
														?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="id_categoria_padre">Categoría</label>
													<select  class="form-control selectpicker  categorias" id="id_categoria_padre" name="id_categoria_padre" data-container="body" data-live-search="true" data-hide-disabled="true">
														<?php
															if(!empty($cat)) {
																echo '<option value="">-- seleccione --</option>';
																foreach($cat as $key=>$s) {
																	if($s['id_categoria_padre']==0)
																		echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
																}
															}
														?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="id_categoria">Subcategoría</label>
													<select  class="form-control selectpicker  categorias" id="id_categoria" name="id_categoria" data-container="body" data-live-search="true"  data-hide-disabled="true">
														<?php
															if(!empty($cat)) {
																echo '<option value="">-- seleccione --</option>';
																foreach($cat as $key=>$s) {
																	if($s['id_categoria_padre']<>0)
																		echo '  <option value="'.$s['id_categoria'].'" data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="'.$s['id_categoria_padre'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
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
									<button type="button" class="btn btn-success"   title="Nuevo Servicio" data-scr="srv" data-fn="nuevoServicio">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>					
					<div id="catalogo-srv"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="srv" data-scr="srv" data-fn="clean" >
						<table id="tbl-srv" class="table fixed">
							<thead>							
			                	<tr>
									<th width="150px">Clave</th>
									<th>Nombre / Descripción</th>
									<th width="100px" class="center">Dep.-Cat.-Sub</th>
									<th width="90px" class="right">Ventas</th>
									<th width="100px" class="right">Precio Vta.</th>
									<th width="60px" align="center"><span class="glyphicon glyphicon-cog"></span></th>
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