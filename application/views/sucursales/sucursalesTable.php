<?php 
	if(!empty($scr)){
		$x = 1;
		foreach ($scr as $key => $s) {
			echo '
					<tr>
	                  <td width="25px" align="center" class="bold">'.$x.'</td>
	                  <td width="60px">'.$s['clave'].'</td>	                  
	                  <td>'.$s['nombre'].'</td>
	                  <td width="150px" title="'.$s['encargado'].'">'.$s['encargado'].'</td>
	                  <td width="90px">'.$s['telefono_fijo'].'</td>
	                  <td width="90px">'.$s['telefono_celular'].'</td>
	                  <td width="250px" title="'.$s['email'].'">'.$s['email'].'</td>
	                  <td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#" data-id_sucursal="'.$s['id_sucursal'].'" data-fn="nuevaSucursal"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="#" data-id_sucursal="'.$s['id_sucursal'].'" data-fn="borrarSucursal"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
		}
	}

?>