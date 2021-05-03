 <div class="featured-products">
    <div class="container">
      <div class="row">         
        <!-- Best Sale -->
        <div class="col-sm-12 col-md-4 jtv-best-sale">
          <div class="jtv-best-sale-list">
            <div class="wpb_wrapper">
              <div class="best-title text-left">
                <h2>Mejor Calificados</h2>
              </div>
            </div>
            <div class="slider-items-products">
              <div id="toprate-products-slider" class="product-flexslider">
                <div class="slider-items">
                  <ul class="products-grid">                    
                    <?php  
                    	$p = $best_rated[0];                 	
						require FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
						$p = $best_rated[1];                 	
						require FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
                    ?>
                  </ul>
                  <ul class="products-grid">
                  	<?php  
                    	$p = $best_rated[2];                 	
						require FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
						$p = $best_rated[3];                 	
						require FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
                    ?>
                  </ul>
                  <ul class="products-grid">
                    <?php                    	
						$p = $best_rated[4];                 	
						require FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
						$p = $best_rated[5];                 	
						require FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Banner -->
        <div class="col-md-4 top-banner hidden-sm">
          <div class="jtv-banner3">
            <div class="jtv-banner3-inner"><a href="#"><img src="<?php echo base_url() ?>application/views/img/sub1a.jpg" alt="HTML template"></a>
              <div class="hover_content">
                <div class="hover_data bottom">
                  <div class="desc-text">Las mejores marcas a precios de descuento</div>
                  <div class="title">Venta de Electronica</div>
                  <span>Videovigilancia y Rastreo Satelital</span>
                  <p><a href="#" class="shop-now">Obtenlos Ahora!</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 jtv-best-sale">
          <div class="jtv-best-sale-list">
            <div class="wpb_wrapper">
              <div class="best-title text-left">
                <h2>Nuevos Productos</h2>
              </div>
            </div>
            <div class="slider-items-products">
              <div id="new-products-slider" class="product-flexslider">
                <div class="slider-items">
                	<ul class="products-grid">                    
                    <?php  
                    	$p = $new_products[0];                 	
						include FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
						$p = $new_products[1];                 	
						include FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
                    ?>
                  </ul>
                  <ul class="products-grid">
                  	<?php  
                    	$p = $new_products[2];                 	
						include FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
						$p = $new_products[3];                 	
						include FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
                    ?>
                  </ul>
                  <ul class="products-grid">
                    <?php                    	
						$p = $new_products[4];                 	
						include FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
						$p = $new_products[5];                 	
						include FCPATH.'application/views/sitio/includes/product-item-grid.php'; 
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>