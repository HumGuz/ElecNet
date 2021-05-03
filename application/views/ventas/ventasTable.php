<?php 
if(!empty($vnt)){		
	foreach ($vnt as $k => $p) {		
		echo '
			<tr >
			<td width="90px" class="bold">'.App::dateFormat($p['fecha_entrega']).'</td>
			<td width="90px" class="bold">'.App::dateFormat($p['fecha_limite_pago']).'</td>
			<td width="120px" class="bold">'.App::dateFormat($p['fecha_cambio'],2).'</td>			
			<td width="80px"  class="bold">'.$p['folio'].'</td>				
			<td width="80px"  class="bold">'.$p['cotizacion'].'</td>
			<td title="[ '.$p['clave_cliente'].' ]">'.$p['nombre_cliente'].'</td>
			<td width="45px" class="right">'.$p['productos'].'</td>
			<td width="100px" class="right bold">$ '.number_format($p['subtotal'],2).'</td>
			<td width="77px" class="right bold">$ '.number_format($p['total_descuento'],2).'</td>
			<td width="100px" class="right bold">$ '.number_format($p['iva'],2).'</td>
			<td width="100px" class="right bold">$ '.number_format($p['total'],2).'</td>
			<td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" onclick="vnt.exportDialog('.$p['id_venta'].',\''.$p['folio'].'\',\'pdf\',\''.$p['nombre_cliente'].' '.App::dateFormat($p['fecha_limite_pago'],7).' \')"><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar PDF </a></li>	
							
		                    <li><a href="#" data-id_venta="'.$p['id_venta'].'" data-scr="vnt" data-fn="nuevaVenta"><span class="fa fa-pencil"></span> Editar </a></li>
		                    <li><a href="#" data-id_venta="'.$p['id_venta'].'" data-scr="vnt" data-duplicar="1" data-fn="nuevaVenta"><span class="fa fa-copy"></span> Duplicar</a></li>	
		                    
		                    
		                    '.( $p['borrar'] ? '<li class="divider"></li><li><a href="#"  data-scr="vnt"  data-id_venta="'.$p['id_venta'].'" data-fn="borrarVenta"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
							</ul>
		     	</div>
			</td>
			</tr>';
		}
        
       
	}

?>


