 
  <div class="inner-box">
    <div class="container">
      <div class="row"> 
        <!-- Banner -->
        <div class="col-md-3 top-banner hidden-sm">
          <div class="jtv-banner3">
            <div class="jtv-banner3-inner"><a href="#"><img src="<?php echo base_url() ?>application/views/img/sub1.jpg" alt="HTML template"></a>
              <div class="hover_content">
                <div class="hover_data">
                  <div class="title"> Gran Venta </div>
                  <div class="desc-text">55% de descuento</div>
                  <span>Camaras, Laptops y Redes</span>
                  <p><a href="#" class="shop-now">Compra Ahora!</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Best Sale -->
        <div class="col-sm-12 col-md-9 jtv-best-sale special-pro">
          <div class="jtv-best-sale-list">
            <div class="wpb_wrapper">
              <div class="best-title text-left">
                <h2>Ofertas Especiales</h2>
              </div>
            </div>
            <div class="slider-items-products">
              <div id="jtv-best-sale-slider" class="product-flexslider">
                <div class="slider-items">
                  <?php
					if(!empty($special_offers)){					
						foreach ($special_offers as $k => $p) {						
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
 
 