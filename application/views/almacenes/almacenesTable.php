<?php 
	if(!empty($alm)){
		$x = 1;
		foreach ($alm as $key => $s) {
			echo '
					<tr>
	                  <td width="25px" align="center" class="bold">'.$x.'</td>
	                  <td width="60px">'.$s['clave'].'</td>	                  
	                  <td>'.$s['nombre'].'</td>
	                  <td width="150px" title="'.$s['encargado'].'">'.$s['encargado'].'</td>
	                  <td width="90px" align="right" class="bold">'.$s['elementos'].'</td>
	                  <td width="30px" class="opt-td">
	                  	<div class="btn-group btn-group-sm">		                 
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span></button>
		                  <ul class="dropdown-menu pull-right" role="menu">
		                    <li><a href="#" ><span class="fa fa-info-circle text-info"></span> Detalles </a></li>
		                    <li><a href="#" data-id_almacen="'.$s['id_almacen'].'" data-fn="nuevoAlmacen"><span class="fa fa-pencil"></span> Editar </a></li>
		                    '.( $s['borrar'] ? '<li class="divider"></li><li><a href="#" data-id_almacen="'.$s['id_almacen'].'" data-fn="borrarAlmacen"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
		                  </ul>
		                </div>
	                  </td>
	                </tr> ';	$x++;		
		}
	}else{
		echo '<blockquote>
                <p><i class="fa fa-info text-aqua"></i> No hay informacion para mostrar</p>
            </blockquote>';
	}

?>