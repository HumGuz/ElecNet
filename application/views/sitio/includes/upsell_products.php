<section class="upsell-product-area">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h2>Complementos para este articulo</h2>
          </div>
          <div class="slider-items-products">
            <div id="upsell-product-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col4">
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
  </section>
