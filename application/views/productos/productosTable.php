<<<<<<< HEAD
<?php 
if(!empty($prd)){		
	foreach ($prd as $k => $p) {
		$cat = $p['dep'].' - '.$p['cat'].' - '.$p['subcat'];		
		echo '<tr style="font-size:13px"  class="ellipsis-td" >
				<td class="bold" > '.$p['clave'].'</td>
				<td title="'.$p['concepto'].'">'.$p['concepto'].'</td>
				<td title="'.$p['marca'].' '.$p['modelo'].'">'.$p['marca'].' '.$p['modelo'].'</td>			
				<td class="center" title="'.$cat.'">'.$cat.'</td>			
				<td title="'.$p['dimensiones'].'">'.$p['dimensiones'].'</td>
				<td title="'.$p['peso'].'">'.$p['peso'].'</td>
				<td title="'.$p['garantia'].'">'.$p['garantia'].' Días</td>	
				<td title="'.number_format($p['precio_venta'],2).'" class="right bold">$ '.number_format($p['precio_venta'],2).'</td>
				<td title="'.number_format($p['costo_promedio'],2).'" class="right bold">$ '.number_format($p['costo_promedio'],2).'</td>
				<td class="opt-td">
		                  	<div class="btn-group btn-group-sm">							 
							  <button type="button" class="btn '.($p['visible']==1 ?'btn-primary':'btn-default').'" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="4"> <span class="fa fa-globe"></span> </button>
			                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
			                  <ul class="dropdown-menu pull-right" role="menu">
			                    <li><a href="#" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="3"><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
			                    <li><a href="#" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="1"><span class="fa fa-picture-o text-primary"></span> Imagenes </a></li>
			                    <li><a href="#" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="nuevoProducto"><span class="fa fa-pencil"></span> Editar </a></li>
			                    '.( $p['borrar']==1 ? '<li class="divider"></li><li><a href="#" data-scr="prd"  data-id_producto="'.$p['id_producto'].'" data-fn="borrarProducto"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
			                  </ul>
			     	</div>
		        </td>
	        </tr>';
	}
=======
<?php 
if(!empty($prd)){		
	foreach ($prd as $k => $p) {
		$cat = $p['dep'].' - '.$p['cat'].' - '.$p['subcat'];		
		echo '<tr style="font-size:13px"  class="ellipsis-td" >
				<td class="bold" > '.$p['clave'].'</td>
				<td title="'.$p['concepto'].'">'.$p['concepto'].'</td>
				<td title="'.$p['marca'].' '.$p['modelo'].'">'.$p['marca'].' '.$p['modelo'].'</td>			
				<td class="center" title="'.$cat.'">'.$cat.'</td>			
				<td title="'.$p['dimensiones'].'">'.$p['dimensiones'].'</td>
				<td title="'.$p['peso'].'">'.$p['peso'].'</td>
				<td title="'.$p['garantia'].'">'.$p['garantia'].' Días</td>	
				<td title="'.number_format($p['precio_venta'],2).'" class="right bold">$ '.number_format($p['precio_venta'],2).'</td>
				<td title="'.number_format($p['costo_promedio'],2).'" class="right bold">$ '.number_format($p['costo_promedio'],2).'</td>
				<td class="opt-td">
		                  	<div class="btn-group btn-group-sm">							 
							  <button type="button" class="btn '.($p['visible']==1 ?'btn-primary':'btn-default').'" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="4"> <span class="fa fa-globe"></span> </button>
			                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
			                  <ul class="dropdown-menu pull-right" role="menu">
			                    <li><a href="#" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="3"><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
			                    <li><a href="#" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="detalles" data-op="1"><span class="fa fa-picture-o text-primary"></span> Imagenes </a></li>
			                    <li><a href="#" data-scr="prd" data-id_producto="'.$p['id_producto'].'" data-fn="nuevoProducto"><span class="fa fa-pencil"></span> Editar </a></li>
			                    '.( $p['borrar']==1 ? '<li class="divider"></li><li><a href="#" data-scr="prd"  data-id_producto="'.$p['id_producto'].'" data-fn="borrarProducto"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
			                  </ul>
			     	</div>
		        </td>
	        </tr>';
	}
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
}