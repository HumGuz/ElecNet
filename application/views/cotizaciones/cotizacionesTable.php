<?php 
	if(!empty($cot)){
		$x = 1;
		foreach ($cot as $key => $s) {
			echo '
					<tr class="ellipsis-td">
                      <td width="25px" align="center" class="bold">'.$x.'</td>
                                <td width="120px" class="bold">'.App::dateFormat($s['fecha_cambio'],2).'</td>			
                      <td width="80px"  class="bold">'.$s['folio'].'</td>			
                      <td width="120px" class="bold">'.App::dateFormat($s['fecha_vencimiento']).'</td>	
                      <td title="'.$s['nombre_cliente'].'">[ '.$s['clave_cliente'].' ] '.$s['nombre_cliente'].'</td>
                      <td width="45px" class="right">'.$s['productos'].'</td>
                      <td width="100px" class="right bold">$ '.number_format($s['subtotal'],2).'</td>
                      <td width="77px" class="right bold">$ '.number_format($s['total_descuento'],2).'</td>
                      <td width="100px" class="right bold">$ '.number_format($s['gastos_envio'],2).'</td>
                      <td width="100px" class="right bold">$ '.number_format($s['iva'],2).'</td>
                      <td width="100px" class="right bold">$ '.number_format($s['total'],2).'</td>
	                  <td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#" onclick="cot.exportDialog('.$s['id_cotizacion'].',\''.$s['folio'].'\',\'pdf\')" ><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar Cotización PDF </a></li>		                     
		                    <li><a href="#" onclick="cot.exportDialog('.$s['id_cotizacion'].',\''.$s['folio'].'\',\'pdf\',1)" ><span style="color:#bb0706" class="fa fa-file-pdf-o"></span> Exportar Catálogo de Conceptos PDF </a></li>		                     
		                    <li><a href="#" data-id_cotizacion="'.$s['id_cotizacion'].'" data-scr="cot" data-fn="nuevaCotizacion"><span class="fa fa-pencil"></span> Editar </a></li>
		                    <li><a href="#" data-id_cotizacion="'.$s['id_cotizacion'].'" data-scr="cot" data-duplicar="1" data-fn="nuevaCotizacion"><span class="fa fa-copy"></span> Duplicar</a></li>	
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="#"  data-scr="cot"  data-id_cotizacion="'.$s['id_cotizacion'].'" data-fn="borrarCotizacion"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
        }
        
       
	}

?>


  