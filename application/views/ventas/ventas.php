<section class="content-header">
	<h1><i class="fa fa-cart-arrow-down"></i> ventas <small></small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="#"><i class="fa fa-dashboard"></i> Inicio</a>
		</li>
		<li class="active">
			ventas
		</li>
	</ol>
</section>
<section class="content">
	<div class="box box-info catalog">
		<div class="box-header">
			<h3 class="box-title"> Lista de ventas</h3>
			<div class="box-tools pull-right">
				<div class="input-group input-group-sm" style="width: 500px;">
					<input type="text" name="busqueda-vnt" id="busqueda-vnt" class="form-control pull-right" placeholder="buscar....">
					<div class="input-group-btn box-filter-parent">
						<button type="button" class="btn btn-default filter"  title="Filtro avanzado">
							<i class="fa fa-filter"></i><i class="fa fa-caret-down"></i>
						</button>
						<?php include_once 'filter.php'; ?>
						
						<button type="button" class="btn btn-success"   title="Nueva venta" data-scr="vnt" data-fn="nuevaVenta">
										<i class="fa fa-plus"></i>
									</button>
					</div>
				</div>
			</div>
		</div>
		<div id="catalogo-vnt"  class="box-body box-body-catalogo table-responsive no-padding" data-tag="vnt" data-scr="vnt" data-fn="clear" >
		      <table id="tbl-vnt" class="table fixed">
      <thead>
                	<tr>	
                	  <th width="90px">Fecha Entr.</th> 
                	  <th width="90px">Fecha Lim.</th> 
                	  <th width="120px">Fecha Reg.</th> 					              
	                  <th width="80px">Folio</th>		                   					              
	                  <th width="80px">Cotización</th>	
	                  <th>Cliente</th>
	                  <th width="45px" class="right">Prod.</th>	                  
	                  <th width="100px"  class="right">Subtotal</th>
	                  <th width="77px"  class="right">Descuento</th>
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