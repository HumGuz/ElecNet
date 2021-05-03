<div class="container">
	<div class="home-tab">
		<div class="tab-title text-left">
			<h2>Los Más Vendidos</h2>
			<ul class="nav home-nav-tabs home-product-tabs">
			<?php
				if(!empty($best_selling)){
					foreach ($best_selling as $k => $d) {
						echo '<li class="'.($k==0?'active':'').'"><a href="#bs-'.$d['id_departamento'].'" data-toggle="tab" aria-expanded="false">'.$d['departamento'].'</a></li>';
					}
				}
        	?>
			</ul>
		</div>
		<div class="tab-content">			
			<?php
				if(!empty($best_selling)){
					$x = 1;
					foreach ($best_selling as $k => $d) {						
						echo '<div class="tab-pane '.($k==0?'active':'').' in" id="bs-'.$d['id_departamento'].'">
								<div class="featured-pro">
									<div class="slider-items-products">
										<div id="bs-slider-'.$x.'" class="product-flexslider hidden-buttons">
											<div class="slider-items slider-width-col4">';
											foreach ($d['top_six'] as $kd => $p) {
												include FCPATH.'application/views/sitio/includes/product-item.php'; 
											}	
							echo '			</div>
										</div>
									</div>
								</div>
							</div>';
						$x++;
					}
				}
        	?>
        </div>
	</div>
</div>
