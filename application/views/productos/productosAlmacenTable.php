<<<<<<< HEAD
<?php 
if(!empty($prd)){		
	foreach ($prd as $k => $p) {
		$cat = $p['dep'].' - '.$p['cat'].' - '.$p['subcat'];		
		echo '<tr style="font-size:13px" >
			<td class="bold">'.$p['clave'].'</td>
			<td  class="ellipsis-td" title="'.$p['concepto'].'">'.$p['concepto'].'</td>
			<td class="ellipsis-td">'.$p['marca'].'</td>
			<td class="center ellipsis-td" title="'.$cat.'">'.$cat.'</td>
			<td class="right bold">'.$p['existencia'].' '.$p['us'].'</td>
			<td class="right bold">'.$p['entradas'].' '.$p['ue'].'</td>
			<td class="right bold">'.$p['salidas'].' '.$p['us'].'</td>
			<td class="right bold">$ '.number_format($p['precio_venta'],2).'</td>
			<td class="right bold">$ '.number_format($p['costo_promedio'],2).'</td>
			<td class="opt-td">
	                  	<div class="btn-group btn-group-sm">							 
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="3"><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="1"><span class="fa fa-picture-o text-primary"></span> Imagenes </a></li>
		                    <li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'"  data-id_almacen_producto = "'.$p['id_almacen_producto'].'" data-fn="nuevoProducto"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $p['borrar']==1 ? '<li class="divider"></li><li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="borrarProducto"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        </td></tr>';
	}
}elseif(isset($d['busqueda']) && isset($d['limit']) && $d['limit']==50 ){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No se encontraron resultados</p></blockquote>';
}elseif(isset($d['limit'])  && $d['limit']==50){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No hay información para mostrar</p></blockquote>';
}

=======
<?php 
if(!empty($prd)){		
	foreach ($prd as $k => $p) {
		$cat = $p['dep'].' - '.$p['cat'].' - '.$p['subcat'];		
		echo '<tr style="font-size:13px" >
			<td class="bold">'.$p['clave'].'</td>
			<td  class="ellipsis-td" title="'.$p['concepto'].'">'.$p['concepto'].'</td>
			<td class="ellipsis-td">'.$p['marca'].'</td>
			<td class="center ellipsis-td" title="'.$cat.'">'.$cat.'</td>
			<td class="right bold">'.$p['existencia'].' '.$p['us'].'</td>
			<td class="right bold">'.$p['entradas'].' '.$p['ue'].'</td>
			<td class="right bold">'.$p['salidas'].' '.$p['us'].'</td>
			<td class="right bold">$ '.number_format($p['precio_venta'],2).'</td>
			<td class="right bold">$ '.number_format($p['costo_promedio'],2).'</td>
			<td class="opt-td">
	                  	<div class="btn-group btn-group-sm">							 
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="3"><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="1"><span class="fa fa-picture-o text-primary"></span> Imagenes </a></li>
		                    <li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'"  data-id_almacen_producto = "'.$p['id_almacen_producto'].'" data-fn="nuevoProducto"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $p['borrar']==1 ? '<li class="divider"></li><li><a href="#"  data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="borrarProducto"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        </td></tr>';
	}
}elseif(isset($d['busqueda']) && isset($d['limit']) && $d['limit']==50 ){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No se encontraron resultados</p></blockquote>';
}elseif(isset($d['limit'])  && $d['limit']==50){
	echo '<blockquote><p><i class="fa fa-info text-aqua"></i> No hay información para mostrar</p></blockquote>';
}

>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
