<?php 
	if(!empty($clt)){
		$x = 1;
		foreach ($clt as $key => $s) {
			echo '
					<tr class="ellipsis-td">
	                  <td width="25px" align="center" class="bold">'.$x.'</td>
	                  <td width="60px">'.$s['clave'].'</td>	            
	                  <td width="100px">'.$s['rfc'].'</td>	                  
	                  <td title="'.$s['nombre'].'">'.$s['nombre'].'</td>
	                  <td width="150px" title="'.$s['contacto'].'">'.$s['contacto'].'</td>
	                  <td width="90px">'.$s['telefono_celular'].'</td>
	                  <td width="200px" title="'.$s['email'].'">'.$s['email'].'</td>
	                  <td width="110px" class="right bold">'.number_format($s['monto_ventas'],2).'</td>
	                  <td width="90px" class="right bold">'.number_format($s['descuento_general'],2).'</td>
	                  <td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#" data-id_cliente="'.$s['id_cliente'].'" data-scr="clt"  data-fn="nuevoCliente"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="#" data-scr="clt"  data-id_cliente="'.$s['id_cliente'].'" data-fn="borrarCliente"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
		}
	}

?>