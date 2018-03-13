<div id="prodDet-modal" class="modal fade" role="dialog" data-base_url="<?php echo base_url();?>">
  <script src="<?php echo base_url();?>application/third_party/cropit/dist/jquery.cropit.js"></script> 
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">      
        <div class="box main-box">
		  <div class="box-header with-border">
		    <h4 style="    width: calc(100% - 25px);display: inline-block;"><?php echo $prd['concepto'] ?></h4>
		    <button type="button" class="close" aria-label="Close" data-dismiss="modal" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Cerrar ventana"><span aria-hidden="true">&times;</span></button>               
		  </div>         
          <div class="box-body">
            <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_3" data-toggle="tab" >Datos del producto</a></li>
					<li><a href="#tab_4" data-toggle="tab" >Config E-commerce</a></li>
					<li ><a href="#tab_1" data-toggle="tab">Imagenes Cargadas</a></li>
					<li><a href="#tab_2" data-toggle="tab">Cargar Imagen</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_3" >						
						
						<div class="row">
							<div class="col-sm-4">
								<h5>Informacion General</h5>
								<b>Clave:</b> <?php echo $prd['clave'] ?><br>
								<b>Clave Secundaria:</b> <?php echo $prd['clave_secundaria'] ?><br>
								<b>Marca:</b> <?php echo $prd['marca'] ?><br>
								<b>Modelo:</b> <?php echo $prd['modelo'] ?>													
							</div>
							
							<div class="col-sm-4">
								<h5>Clasificación</h5>								
								<b>Depatamento:</b> [ <?php echo $prd['dep'] ?> ] <?php echo $prd['departamento'] ?><br>
								<b>Categoría:</b> [ <?php echo $prd['cat'] ?> ] <?php echo $prd['categoria'] ?><br>
								<b>Subcategoría:</b> [ <?php echo $prd['subcat'] ?> ] <?php echo $prd['subcategoria'] ?>							
							</div>
							
							<div class="col-sm-4">
								<h5>Especificaciones</h5>
								<b>Stock:</b> <?php echo $prd['existencia_general'] ?><br>
								<b>Peso:</b> <?php echo $prd['peso'] ?><br>
								<b>Dimensiones:</b> <?php echo $prd['dimensiones'] ?><br>
								<b>Colores:</b> 								
								<div class="color">
				                    <ul>
				                    <?php
				                    	$c = explode(',', $prd['colores']);				                    	
										foreach ($c as $key => $v) {
											echo '<li><a href="#" style="background:'.$v.'"></a></li>';
										}
				                    ?>
				                     </ul>
				               </div>					              				
							</div>							
							<div class="col-sm-12">
				               		<b>Descripción:</b><br>
				               		<?php echo $prd['descripcion'] ?>
				            </div>										
						</div>
					</div>
					
					
					<div class="tab-pane" id="tab_4" >	
						<div class="col-sm-4" >
								<h5>Datos del producto en el sitio</h5>
								<b>Precio:</b> $ <?php echo number_format($prd['precio_venta'],2); ?><br>
								<b>Tags:</b> <?php echo $prd['tags']; ?><br>
								<b>Calificación:</b> 								
								<div class="rating">
									<?php 
										$m = 5;										
										for ($i=0; $i < $prd['valuacion']; $i++) { 
											echo '<i class="fa fa-star"></i> ';
											$m--;
										}
										for ($j=0; $j < $m; $j++) { 
											echo '<i class="fa fa-star-o"></i> ';
										}										
									?>
								</div>
							</div>
							
							<div class="col-sm-4" >
								<h5>Opciones del producto en el sitio</h5>
								<div class="checkbox">
				                  <label>
				                    <input type="checkbox" data-op="visible" data-id_producto="<?php echo $prd['id_producto']; ?>" id="visible-p" <?php echo $prd['visible']==1 ? 'checked':'' ?>> Visible en el sitio
				                  </label>
				                </div>				                
				                 <div class="checkbox">
				                  <label>
				                    <input type="checkbox" data-op="nuevo"  data-id_producto="<?php echo $prd['id_producto']; ?>" id="nuevo-p" <?php echo $prd['nuevo']==1 ? 'checked':'' ?>> Marcar como nuevo
				                  </label>
				                </div>				                
				                 <div class="checkbox">
				                  <label>
				                    <input type="checkbox" data-op="stock" data-id_producto="<?php echo $prd['id_producto']; ?>"  id="disponible-p" <?php echo $prd['stock']==1 ? 'checked':'' ?>> Marcar como no disponible
				                  </label>
				                </div>
							</div>
							
							<div class="col-sm-3" >							
								<h5>Marcar con precio especial:</h5>								
								<b>Costo Promedio:</b> $ <?php echo number_format($prd['costo_promedio_general'],2); ?><br>
								<b>Precio Especial</b>
								<div class="input-group input-group-sm">	
			                        <span class="input-group-addon" style="line-height: 0">
			                          <input type="checkbox" id="precio_especial_i" data-id_producto="<?php echo $prd['id_producto']; ?>"   <?php echo $prd['precio_oferta']>0 ? 'checked':'' ?> >
			                        </span>
			                    	<input type="text" class="form-control" id="precio_especial" name="precio_especial" value="<?php echo $prd['precio_oferta']>0 ? $prd['precio_oferta']:'' ?>" <?php echo $prd['precio_oferta']==0 ? 'readonly':'' ?>>
			                    	<span class="input-group-btn">
				                      <button type="button" class="btn btn-success btn-flat" id="precio_especial_g" data-id_producto="<?php echo $prd['id_producto']; ?>"  data-costo_promedio="<?php echo $prd['costo_promedio_general']; ?>"><span class="glyphicon glyphicon-floppy-disk"></span> </button>
				                    </span>
			                 	 </div>
			                 	 <small>No puede ser menor al costo promedio.</small>
							</div>	
						
					</div>
					
					<div class="tab-pane " id="tab_1">
						<div id="img-prod" class="carousel slide" data-ride="carousel" style="min-height: 600px">
						  <ol class="carousel-indicators">
						  	<?php
						  		if(!empty($img)){
						  			$x = 0;									
									foreach ($img as $key => $i) {
										echo '<li data-target="#img-prod" data-slide-to="'.$x.'" class="'.($x==0 ? 'active' : '').'"></li>';
										$x++;
									}
						  		}
						  	?>						  	
						  </ol>		
						  <div class="carousel-inner" role="listbox">						  	
						  	<?php
						  		if(!empty($img)){
						  			$x = 0;									
									foreach ($img as $key => $i) {
										echo '<div class="item '.($x==0 ? 'active' : '').'"><img src="'.base_url().'/application/views/img/uploads/'.$i['imagen'].'" style="margin:0px auto"><div class="carousel-caption">'.$i['imagen'].'</div></div>';
										$x++;
									}
						  		}
						  	?>							  	
						  </div>		
						  <a class="left carousel-control" href="#img-prod" role="button" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						    <span class="sr-only">Anterior</span>
						  </a>						  
						  <a class="right carousel-control" href="#img-prod" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						    <span class="sr-only">Siguiente</span>
						  </a>
						  
						</div>
					</div>					
					<div class="tab-pane" id="tab_2">						
						<div class="row">
							<div class="col-sm-12 font-dark bold">
								Cargar Nueva Imagen (600px X 600px)
							</div>
							<div class="col-sm-12">
								<div id="image-cropper" class="cropper-container">	
									<button type="button" class="btn btn-link" name="seimgO" id="seimgO">
										Seleccionar Imagen
									</button>	
									<button type="button" class="btn btn-link" name="subImg" id="subImg" style="display: none">
										Subir Imagen
									</button>								
									<div class="slider-wrapper">
										<span class="fa fa-file-image-o"></span>
										<input type="range" class="cropit-image-zoom-input" min="0" max="1" step="0.01">
										<span class="fa fa-file-image-o  fa-2x"></span>
									</div>
									<input type="file" id="imagen_producto" name="imagen_producto" class="cropit-image-input" />									
									<div class="cropit-preview"></div>
								</div>
							</div>
						</div>								
					</div>
				</div>					
			</div>
          </div>		  	
		</div>
    </div>
  </div>
  <style>  	
	.cropit-preview {
		width: 600px;
		height: 600px;
		margin: 0px auto;
	}	
	.cropper-container{
		    text-align: center;
	}	
	.slider-wrapper {
		transition: opacity 0.25s;
		margin:5px auto 5px;
		width: 174px;
	}
	.cropit-image-input {
		display: none!important;
	}
	.cropit-image-zoom-input {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		height: 5px;
		background: #eee;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		outline: none;
		width: 130px !important;
		display: inline-block!important;
	}
	.cropit-image-zoom-input::-webkit-range-track {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		height: 5px;
		background: #eee;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		outline: none
	}
	.cropit-image-zoom-input::-webkit-slider-thumb {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		width: 15px;
		height: 15px;
		background: #888;
		-webkit-border-radius: 50%;
		border-radius: 50%;
		-webkit-transition: background 0.25s;
		-moz-transition: background 0.25s;
		-o-transition: background 0.25s;
		-ms-transition: background 0.25s;
		transition: background 0.25s;
	}
  </style>
  
  
</div>

			