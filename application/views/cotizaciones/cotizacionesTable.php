<?php 
if(!empty($cot)){		
	foreach ($cot as $k => $p) {		
		echo '
			<tr >
			<td width="120px" class="bold">'.App::dateFormat($p['fecha_cambio'],2).'</td>			
			<td width="80px"  class="bold">'.$p['folio'].'</td>			
			<td width="120px" class="bold">'.App::dateFormat($p['fecha_vencimiento']).'</td>	
			<td>[ '.$p['clave_cliente'].' ] '.$p['nombre_cliente'].'</td>
			<td width="45px" class="right">'.$p['productos'].'</td>
			<td width="100px" class="right bold">$ '.number_format($p['subtotal'],2).'</td>
			<td width="77px" class="right bold">$ '.number_format($p['total_descuento'],2).'</td>
			<td width="100px" class="right bold">$ '.number_format($p['gastos_envio'],2).'</td>
			<td width="100px" class="right bold">$ '.number_format($p['iva'],2).'</td>
			<td width="100px" class="right bold">$ '.number_format($p['total'],2).'</td>
			<td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" onclick="cot.exportDialog('.$p['id_cotizacion'].',\''.$p['folio'].'\',\'pdf\')" ><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar Cotización PDF </a></li>		                     
		                    <li><a href="#" onclick="cot.exportDialog('.$p['id_cotizacion'].',\''.$p['folio'].'\',\'pdf\',1)" ><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar Catálogo de Conceptos PDF </a></li>		                     
		                    '.( $p['borrar'] ? '<li><a href="#" data-id_cotizacion="'.$p['id_cotizacion'].'" data-fn="nuevaCotizacion"><span class="fa fa-pencil"></span> Editar </a></li><li class="divider"></li><li><a href="#"  data-id_cotizacion="'.$p['id_cotizacion'].'" data-fn="borrarCotizacion"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        </td></tr>';
	}
}elseif(isset($d['busqueda']) && isset($d['limit']) && $d['limit']==50 ){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No se encontraron resultados</p></blockquote>';
}elseif(isset($d['limit'])  && $d['limit']==50){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No hay información para mostrar</p></blockquote>';
}

