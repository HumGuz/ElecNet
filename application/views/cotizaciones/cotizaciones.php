<<<<<<< HEAD
<div id="seccion-cot">
	<section class="content-header">
		<h1><i class="fa fa-file-text-o"></i> Cotizaciones <small></small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
            	Cotizaciones
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info catalog">
			<div class="box-header">
				<h3 class="box-title"> Lista de cotizaciones</h3>
				<div class="box-tools" >
					<div class="input-group input-group-sm" style="width: 350px;">
						<input type="text" name="busqueda-cot" id="busqueda-cot" class="form-control pull-right" placeholder="buscar....">
						<div class="input-group-btn box-filter-parent">
									<button type="button" class="btn btn-default filter" title="Filtro avanzado">
										<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
									</button>
									<?php include_once 'filter.php'; ?>
									<button type="button" class="btn btn-success"   title="Nuevo Cotización" data-scr="cot" data-fn="nuevaCotizacion">
										<i class="fa fa-plus"></i>
									</button>
								</div>
					</div>
				</div>
			</div>
			<div id="catalogo-cot"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="cot" data-scr="cot" data-fn="clean" >
				<table id="tbl-cot" class="table fixed">
					<thead>
                    <tr>	
                    <th width="25px">#</th>
                	  <th width="120px">Fecha Reg.</th> 					              
	                  <th width="80px">Folio</th>		                  
	                  <th width="120px">Vencimiento</th>		                                       
	                  <th>Clientes</th>
	                  <th width="45px" class="right">Prod.</th>	 
	                  <th width="100px"  class="right">Subtotal</th>
	                  <th width="77px"  class="right">Descuento</th>
	                  <th width="100px"  class="right">Envío</th>
	                  <th width="100px"  class="right">Iva</th>
	                  <th width="100px"  class="right">Total</th>
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
					</thead>
				</table>
			</div>
			<div class="overlay" style="display: none">
				<i class="fa fa-spinner fa-spin fa-2x" ></i>
			</div>
		</div>
	</section>
=======
<div id="seccion-cot">
	<section class="content-header">
		<h1><i class="fa fa-file-text-o"></i> Cotizaciones <small></small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
			</li>
			<li class="active">
            	Cotizaciones
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info catalog">
			<div class="box-header">
				<h3 class="box-title"> Lista de cotizaciones</h3>
				<div class="box-tools" >
					<div class="input-group input-group-sm" style="width: 350px;">
						<input type="text" name="busqueda-cot" id="busqueda-cot" class="form-control pull-right" placeholder="buscar....">
						<div class="input-group-btn box-filter-parent">
									<button type="button" class="btn btn-default filter" title="Filtro avanzado">
										<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
									</button>
									<?php include_once 'filter.php'; ?>
									<button type="button" class="btn btn-success"   title="Nuevo Cotización" data-scr="cot" data-fn="nuevaCotizacion">
										<i class="fa fa-plus"></i>
									</button>
								</div>
					</div>
				</div>
			</div>
			<div id="catalogo-cot"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="cot" data-scr="cot" data-fn="clean" >
				<table id="tbl-cot" class="table fixed">
					<thead>
                    <tr>	
                    <th width="25px">#</th>
                	  <th width="120px">Fecha Reg.</th> 					              
	                  <th width="80px">Folio</th>		                  
	                  <th width="120px">Vencimiento</th>		                                       
	                  <th>Clientes</th>
	                  <th width="45px" class="right">Prod.</th>	 
	                  <th width="100px"  class="right">Subtotal</th>
	                  <th width="77px"  class="right">Descuento</th>
	                  <th width="100px"  class="right">Envío</th>
	                  <th width="100px"  class="right">Iva</th>
	                  <th width="100px"  class="right">Total</th>
	                  <th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span> </th>
	                </tr> 
					</thead>
				</table>
			</div>
			<div class="overlay" style="display: none">
				<i class="fa fa-spinner fa-spin fa-2x" ></i>
			</div>
		</div>
	</section>
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
</div>