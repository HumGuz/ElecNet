<<<<<<< HEAD
<?php 
	if(!empty($prv)){
		$x = 1;
		foreach ($prv as $key => $s) {
			echo '
					<tr class="ellipsis-td">
	                  <td width="25px" align="center" class="bold">'.$x.'</td>
	                  <td width="60px">'.$s['clave'].'</td>	            
	                  <td width="110px">'.$s['rfc'].'</td>	                  
	                  <td title="'.$s['nombre'].'">'.$s['nombre'].'</td>
	                  <td width="150px" title="'.$s['vendedor'].'">'.$s['vendedor'].'</td>
	                  <td width="90px">'.$s['telefono_celular'].'</td>
	                  <td width="200px" title="'.$s['email'].'">'.$s['email'].'</td>
	                  <td width="110px" class="right bold">'.number_format($s['monto_compras'],2).'</td>
	                  <td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">		                    
		                    <li><a href="#" data-scr="prv" data-id_proveedor="'.$s['id_proveedor'].'" data-fn="nuevoProveedor"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="#"  data-scr="prv"  data-id_proveedor="'.$s['id_proveedor'].'" data-fn="borrarProveedor"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
		}
	}

=======
<?php 
	if(!empty($prv)){
		$x = 1;
		foreach ($prv as $key => $s) {
			echo '
					<tr class="ellipsis-td">
	                  <td width="25px" align="center" class="bold">'.$x.'</td>
	                  <td width="60px">'.$s['clave'].'</td>	            
	                  <td width="110px">'.$s['rfc'].'</td>	                  
	                  <td title="'.$s['nombre'].'">'.$s['nombre'].'</td>
	                  <td width="150px" title="'.$s['vendedor'].'">'.$s['vendedor'].'</td>
	                  <td width="90px">'.$s['telefono_celular'].'</td>
	                  <td width="200px" title="'.$s['email'].'">'.$s['email'].'</td>
	                  <td width="110px" class="right bold">'.number_format($s['monto_compras'],2).'</td>
	                  <td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">		                    
		                    <li><a href="#" data-scr="prv" data-id_proveedor="'.$s['id_proveedor'].'" data-fn="nuevoProveedor"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="#"  data-scr="prv"  data-id_proveedor="'.$s['id_proveedor'].'" data-fn="borrarProveedor"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
		}
	}

>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
?>