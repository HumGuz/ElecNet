<section class="content-header">
	<h1><i class="fa fa-cart-arrow-down"></i> Compras <small></small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
		</li>
		<li class="active">
			Compras
		</li>
	</ol>
</section>
<section class="content">
	<div class="box box-info catalog">
		<div class="box-header">
			<h3 class="box-title"> Lista de compras</h3>
			<div class="box-tools pull-right">
				<div class="input-group input-group-sm" style="width: 500px;">
					<input type="text" name="busqueda-cmp" id="busqueda-cmp" class="form-control pull-right" placeholder="buscar....">
					<div class="input-group-btn box-filter-parent">
						<button type="button" class="btn btn-default filter"  title="Filtro avanzado">
							<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
						</button>
						<?php include_once 'filter.php'; ?>
						
						<button type="button" class="btn btn-success"   title="Nueva compra" data-scr="cmp" data-fn="nuevaCompra">
										<i class="fa fa-plus"></i>
									</button>
					</div>
				</div>
			</div>
		</div>
		<div id="catalogo-cmp"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="cmp" data-scr="cmp" data-fn="clean" >
			<table id="tbl-cmp" class="table fixed">
				<thead>
					<tr>
						<th width="120px">Fecha Reg.</th>
						<th width="80px">Folio</th>
						<th width="90px">Factura</th>
						<th>Proveedor</th>
						<th width="45px" class="right">Prod.</th>
						<th width="100px"  class="right">Subtotal</th>
						<th width="77px"  class="right">Descuento</th>
						<th width="100px"  class="right">Iva</th>
						<th width="100px"  class="right">Total</th>
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