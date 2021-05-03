<?php 
	if(!empty($obj)){		
		echo '<div class="list-group">';	
			if($d['dump']=="depList"){
				foreach ($obj as $key => $s) {			
					echo '	<li class="list-group-item" data-fnc="elementsList" data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="0" data-dump="catList" data-empty="#catList,#subCatList">
								 <div class="btn-group btn-group-xs pull-right">
								 	 <button type="button" class="btn btn-default bg-gray-active btn-info-text" >'.$s['categorias'].'</button>
							         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
							         <ul class="dropdown-menu pull-right" role="menu">
					                   	<li><a href="#" data-scr="cls" data-id_departamento="'.$s['id_departamento'].'" data-fn="nuevaClasificacion" data-op="1"><span class="fa fa-pencil"></span> Editar </a></li>
					                    '.( $s['borrar'] ? '<li><a href="#"  data-scr="cls"  data-id_departamento="'.$s['id_departamento'].'" data-fn="borrarClasificacion" data-op="1"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
					                  </ul>
					             </div>
								 <h4 class="list-group-item-heading">['.$s['clave'].']  '.$s['nombre'].'</h4>
		   	 					 <p class="list-group-item-text ellipsis">'.$s['descripcion'].'</p>						
							 </li>';	
				}				
			}elseif($d['dump']=="catList"){
				foreach ($obj as $key => $s) {			
					echo '	 <li class="list-group-item" data-fnc="elementsList" data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="'.$s['id_categoria'].'" data-dump="subCatList" data-empty="#subCatList"> 
								 <div class="btn-group btn-group-xs pull-right">
								 	 <button type="button" class="btn btn-default bg-gray-active btn-info-text" >'.$s['subcategorias'].'</button>
							         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
							         <ul class="dropdown-menu pull-right" role="menu">
					                   	<li><a href="#"  data-scr="cls"  data-id_categoria="'.$s['id_categoria'].'" data-fn="nuevaClasificacion" data-op="2"><span class="fa fa-pencil"></span> Editar </a></li>
					                    '.( $s['borrar'] ? '<li><a href="#"  data-scr="cls"  data-id_departamento="'.$s['id_departamento'].'"  data-id_categoria="'.$s['id_categoria'].'" data-fn="borrarClasificacion" data-op="2"> <span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
					                  </ul>
					             </div>
								 <h4 class="list-group-item-heading">['.$s['clave'].']  '.$s['nombre'].'</h4>
		   	 					 <p class="list-group-item-text ellipsis">'.$s['descripcion'].'</p>						
							 </li>';	
				}
			}elseif($d['dump']=="subCatList"){
				foreach ($obj as $key => $s) {				
					echo '	<li class="list-group-item" >
								 <div class="btn-group btn-group-xs pull-right">								 	 
							         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
							         <ul class="dropdown-menu pull-right" role="menu">
					                   	<li><a href="#"  data-scr="cls"  data-id_categoria="'.$s['id_categoria'].'" data-fn="nuevaClasificacion" data-op="3"><span class="fa fa-pencil"></span> Editar </a></li>
					                    '.( $s['borrar'] ? '<li><a href="#"  data-scr="cls"  data-id_departamento="'.$s['id_departamento'].'" data-id_categoria_padre="'.$s['id_categoria_padre'].'" data-id_categoria="'.$s['id_categoria'].'" data-fn="borrarClasificacion" data-op="3"><span class="fa fa-eraser text-danger"></span> Borrar </a></li>':'' ).'
					                  </ul>
					             </div>
								 <h4 class="list-group-item-heading">['.$s['clave'].']  '.$s['nombre'].'</h4>
		   	 					 <p class="list-group-item-text ellipsis">'.$s['descripcion'].'</p>						
							 </li>';	
				}
			}
		echo '</div>';	
	}else{
		echo '<blockquote>
                <p><i class="fa fa-info text-aqua"></i> No hay informacion para mostrar</p>
            </blockquote>';
	}

?>