<?php 
if(!empty($prd)){
	foreach ($prd as $k => $p) {
		
		echo '
			<tr><td width="150px">'.$p['clave'].'</td>
			<td>'.$p['concepto'].'</td>
			<td width="130px">'.$p['marca'].'</td>
			<td width="100px">'.$p['dep'].' - '.$p['cat'].' - '.$p['subcat'].'</td>
			<td width="90px" class="right bold">'.$p['existencia'].'</td>
			<td width="100px">'.$p['ue'].' - '.$p['us'].'</td>
			<td width="70px">'.$p['factor'].'</td>
			<td width="110px" class="right bold">$ '.number_format($p['precio_min_venta'],2).'</td>
			<td width="110px" class="right bold">$ '.number_format($p['costo_promedio'],2).'</td>
			<td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#" data-id_producto="'.$p['id_producto'].'" data-fn="nuevoProducto"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $p['borrar'] ? '<li class="divider"></li><li><a href="#"  data-id_producto="'.$p['id_producto'].'" data-fn="nuevoProducto"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        </td></tr>';
	}
}elseif(isset($d['busqueda'])){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No se encontraron resultados</p></blockquote>';
}

