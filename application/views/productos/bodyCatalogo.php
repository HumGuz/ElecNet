<div class="row">
<?php
	if(!empty($scr)){
		ksort($scr);		
		foreach ($scr as $key => $s) {
			echo '
				<div class="col-md-4">		         
		          <div class="box box-widget widget-user-2 almacenes-sucursal">		            
		            <div class="widget-user-header bg-aqua" style="position:relative">
		            
					  <button type="button" class="btn btn-sm btn-success absolute-right" data-toggle="tooltip" title="Nuevo almacén"><i class="fa fa-plus"></i></button>
					
					
		              <h3 class="widget-user-username">[ '.$s['clave_sucursal'].' ]  '.$s['sucursal'].' </h3>
		              <h5 class="widget-user-desc">'.$s['encargado_sucursal'].'</h5>
		            </div>
		            <div class="box-footer no-padding">';		              
					  if(!empty($s['a'])){
					  	echo '<ul class="nav nav-stacked">';
					  	ksort($s['a']);
						foreach ($s['a'] as $clave => $a) {
							echo '<li><a href="#" data-fn="productosAlmacen" data-id_almacen="'.$a['id_almacen'].'"  data-id_sucursal="'.$a['id_sucursal'].'">[ <b>'.$clave.'</b> ] '.$a['almacen'].' <span class="pull-right badge bg-blue">'.$a['elementos'].'</span></a></li>';
						}
						echo '</ul>';
					  }
		      echo '</div></div></div>';
		}	
	}else{
		echo '<blockquote>
                <p><i class="fa fa-info text-aqua"></i> No hay informacion para mostrar</p>
            </blockquote>';
	}
?>
</div>

