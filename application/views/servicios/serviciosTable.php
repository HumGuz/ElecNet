<?php 
if(!empty($srv)){		
	foreach ($srv as $k => $p) {		
		echo '
			<tr style="font-size:13px" >
			<td width="150px" class="bold">'.$p['clave'].'</td>
			<td>'.$p['concepto'].'</td>
			<td width="130px">'.$p['marca'].'</td>
			<td width="100px" class="center">'.$p['dep'].' - '.$p['cat'].' - '.$p['subcat'].'</td>
			<td width="90px" class="right bold">'.$p['salidas'].' '.$p['us'].'</td>
			<td width="100px" class="right bold">$ '.number_format($p['precio_venta'],2).'</td>
			<td width="60px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">							 
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" data-scr="srv" data-id_servicio="'.$p['id_servicio'].'" data-fn="nuevoServicio"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $p['borrar']==1 ? '<li class="divider"></li><li><a href="#"  data-scr="srv" data-id_servicio="'.$p['id_servicio'].'" data-fn="borrarServicio"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		     	</div>
	        </td></tr>';
	}
}