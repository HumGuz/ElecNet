<?php 
	if(!empty($scr)){
		$x = 1;
		foreach ($scr as $key => $s) {
			echo '<tr>
	                  <td align="center" class="bold">'.$x.'</td>
	                  <td class="ellipsis-td">'.$s['clave'].'</td>	                  
	                  <td>'.$s['nombre'].'</td>
	                  <td class="ellipsis-td" title="'.$s['encargado'].'">'.$s['encargado'].'</td>
	                  <td class="ellipsis-td">'.$s['telefono_fijo'].'</td>
	                  <td class="ellipsis-td">'.$s['telefono_celular'].'</td>
	                  <td title="'.$s['email'].'" class="ellipsis-td">'.$s['email'].'</td>
	                  <td class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="javascript:;" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="javascript:;" data-scr="scr" data-id_sucursal="'.$s['id_sucursal'].'" data-fn="nuevaSucursal"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="javascript:;" data-scr="scr" data-id_sucursal="'.$s['id_sucursal'].'" data-fn="borrarSucursal"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                    </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
		}
	}