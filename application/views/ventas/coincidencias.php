<<<<<<< HEAD
<div id="coin-modal" class="modal " tabindex="-1"  data-width="1000" >	
	<div class="modal-dialog" style="width:1000px">
		<div class="modal-content" >
			<div class="modal-header">				
				<h4 class="modal-title"> Resultados de la Busqueda</h4>
			</div>		
			<div class="modal-body modal-info">					
				<h4>Multiples resultados para <b>"<?php echo $busqueda ?>"</b> </h4>
				<p> La busqueda realizada arrojo coincidencias de productos y/o servicios en multiples almacenes, seleccione de la lista el producto o servicio deseado para agregarlo a la compra. </p>
				<table class="table table-stripped fixed table-bordered table-condensed">
	                <tbody>
	                	<tr class="ellipsis-tr">
		                  <th width="150px">Clave</th>		                 
		                  <th>Concepto</th>	                  	          
		                 <th width="120px" class="center">Dep.-Cat.-Sub</th>
		                  <th width="110px" class="right">Factor</th>		                  
		                  <th width="82px" class="right">Existencia</th>
		                  <th width="200px" >Almacén</th>
		                  <th width="50px" class="center"><span class="glyphicon glyphicon-cog"></span> </th>
		                </tr> 
	                </tbody>
	                <tbody>
	                	<?php
	                		foreach ($coins_list as $key => $p) {
									echo '<tr class="pointer" data-id="'.$p['tipo'].$p['id_producto'].'">
					                  <td width="150px" class="bold">'.$p['clave'].'</td>		                 
					                  <td class="ellipsis-td" title="'.$p['concepto'].'">'.$p['concepto'].'</td>	                  	          
					                  <td width="120px" class="center">'.$p['dep'].' - '.$p['cat'].' - '.$p['subcat'].'</td>
					                  <td width="110px" class="right bold">'.$p['factor_unidades'].' '.$p['us'].' / '.$p['ue'].'</td>
					                  <td width="82px" class="right bold">'.number_format($p['existencia_ue'],2).' '.$p['ue'].'</td>
					                  <td width="200px" >[ '.$p['clave_almacen'].' ] '.$p['almacen'].'</td>
					                  <td width="50px" class="center no-padding">
					                 	 <a class="btn btn-xs green-meadow" href="javascript:;"><i class="fa fa-plus"></i></a>
									  </td>
					                </tr> ';
							} 
	                	?>
	                </tbody>
	            </table> 
			</div>	
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm close-modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
=======
<div id="coin-modal" class="modal " tabindex="-1"  data-width="1000" >	
	<div class="modal-dialog" style="width:1000px">
		<div class="modal-content" >
			<div class="modal-header">				
				<h4 class="modal-title"> Resultados de la Busqueda</h4>
			</div>		
			<div class="modal-body modal-info">					
				<h4>Multiples resultados para <b>"<?php echo $busqueda ?>"</b> </h4>
				<p> La busqueda realizada arrojo coincidencias de productos y/o servicios en multiples almacenes, seleccione de la lista el producto o servicio deseado para agregarlo a la compra. </p>
				<table class="table table-stripped fixed table-bordered table-condensed">
	                <tbody>
	                	<tr class="ellipsis-tr">
		                  <th width="150px">Clave</th>		                 
		                  <th>Concepto</th>	                  	          
		                 <th width="120px" class="center">Dep.-Cat.-Sub</th>
		                  <th width="110px" class="right">Factor</th>		                  
		                  <th width="82px" class="right">Existencia</th>
		                  <th width="200px" >Almacén</th>
		                  <th width="50px" class="center"><span class="glyphicon glyphicon-cog"></span> </th>
		                </tr> 
	                </tbody>
	                <tbody>
	                	<?php
	                		foreach ($coins_list as $key => $p) {
									echo '<tr class="pointer" data-id="'.$p['tipo'].$p['id_producto'].'">
					                  <td width="150px" class="bold">'.$p['clave'].'</td>		                 
					                  <td class="ellipsis-td" title="'.$p['concepto'].'">'.$p['concepto'].'</td>	                  	          
					                  <td width="120px" class="center">'.$p['dep'].' - '.$p['cat'].' - '.$p['subcat'].'</td>
					                  <td width="110px" class="right bold">'.$p['factor_unidades'].' '.$p['us'].' / '.$p['ue'].'</td>
					                  <td width="82px" class="right bold">'.number_format($p['existencia_ue'],2).' '.$p['ue'].'</td>
					                  <td width="200px" >[ '.$p['clave_almacen'].' ] '.$p['almacen'].'</td>
					                  <td width="50px" class="center no-padding">
					                 	 <a class="btn btn-xs green-meadow" href="javascript:;"><i class="fa fa-plus"></i></a>
									  </td>
					                </tr> ';
							} 
	                	?>
	                </tbody>
	            </table> 
			</div>	
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm close-modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
