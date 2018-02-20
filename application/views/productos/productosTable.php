<?php 
if(!empty($prd)){		
	foreach ($prd as $k => $p) {		
		echo '
			<tr style="font-size:13px" >
			<td width="150px" class="bold">'.$p['clave'].'</td>
			<td>'.$p['concepto'].'</td>
			<td width="130px">'.$p['marca'].'</td>
			<td width="100px" class="center">'.$p['dep'].' - '.$p['cat'].' - '.$p['subcat'].'</td>
			<td width="90px" class="right bold">'.$p['existencia'].' '.$p['us'].'</td>
			<td width="90px" class="right bold">'.$p['entradas'].' '.$p['ue'].'</td>
			<td width="90px" class="right bold">'.$p['salidas'].' '.$p['us'].'</td>
			<td width="100px" class="right bold">$ '.number_format($p['precio_venta'],2).'</td>
			<td width="100px" class="right bold">$ '.number_format($p['costo_promedio'],2).'</td>
			<td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#" data-id_producto="'.$p['id_producto'].'" data-fn="imagenes"><span class="fa fa-picture-o text-primary"></span> Imagenes </a></li>
		                    <li><a href="#" data-id_producto="'.$p['id_producto'].'"  data-id_almacen_producto = "'.$p['id_almacen_producto'].'" data-fn="nuevoProducto"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $p['borrar'] ? '<li class="divider"></li><li><a href="#"  data-id_producto="'.$p['id_producto'].'" data-fn="borrarProducto"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        </td></tr>';
	}
}elseif(isset($d['busqueda']) && isset($d['limit']) && $d['limit']==50 ){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No se encontraron resultados</p></blockquote>';
}elseif(isset($d['limit'])  && $d['limit']==50){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No hay información para mostrar</p></blockquote>';
}

