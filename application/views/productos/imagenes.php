<div id="prodImg-modal" class="modal fade" role="dialog" data-base_url="<?php echo base_url();?>">
  <script src="<?php echo base_url();?>application/third_party/cropit/dist/jquery.cropit.js"></script> 
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">      
        <div class="box main-box">
		  <div class="box-header with-border">
		    <h3 class="box-title">Imagenes del producto</h3>
		    <button type="button" class="close" aria-label="Close" data-dismiss="modal" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"  title="Cerrar ventana"><span aria-hidden="true">&times;</span></button>               
		  </div>         
          <div class="box-body">
            <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab">Imagenes Cargadas</a></li>
					<li><a href="#tab_2" data-toggle="tab">Cargar Imagen</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1"  style="position: relative;min-height: 693px">
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

			