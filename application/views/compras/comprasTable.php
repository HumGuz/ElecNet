<?php 
if(!empty($cmp)){		
	foreach ($cmp as $k => $p) {		
		echo '
			<tr class="ellipsis-td" >
				<td width="120px" class="bold">'.App::dateFormat($p['fecha_cambio'],2).'</td>			
				<td width="80px"  class="bold">'.$p['folio'].'</td>			
				<td width="90px" class="bold">'.$p['factura'].'</td>	
				<td>[ '.$p['clave_proveedor'].' ] '.$p['nombre_proveedor'].'</td>
				<td width="45px" class="right">'.$p['productos'].'</td>
				<td width="100px" class="right bold">$ '.number_format($p['subtotal'],2).'</td>
				<td width="77px" class="right bold">$ '.number_format($p['total_descuento'],2).'</td>
				<td width="100px" class="right bold">$ '.number_format($p['iva'],2).'</td>
				<td width="100px" class="right bold">$ '.number_format($p['total'],2).'</td>
				<td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
						  <li><a href="#" onclick="cot.exportDialog('.$p['id_compra'].',\''.$p['folio'].'\',\'pdf\')" ><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar Compra PDF </a></li>		                     
						  <li><a href="#" onclick="cot.exportDialog('.$p['id_compra'].',\''.$p['folio'].'\',\'pdf\',1)" ><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar Catálogo de Conceptos PDF </a></li>
		                    <li><a href="#" data-scr="cmp" data-id_compra="'.$p['id_compra'].'" data-fn="nuevaCompra"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $p['borrar'] ? '<li class="divider"></li><li><a href="#"  data-scr="cmp"  data-id_compra="'.$p['id_compra'].'" data-fn="borrarCompra"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        	</td>
	        </tr>';
	}
	
}