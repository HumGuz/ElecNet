 <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="related-product-area">
          <div class="page-header">
            <h2>Productos Relacionados</h2>
          </div>
          <div class="related-products-pro">
            <div class="slider-items-products">
              <div id="related-product-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 fadeInUp">                	
                	<?php
						if(!empty($related_products)){					
							foreach ($related_products as $k => $p) {						
								include FCPATH.'application/views/sitio/includes/product-item.php'; 				
							}
						}
		        	?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  