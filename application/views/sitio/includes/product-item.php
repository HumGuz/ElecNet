				<div class="product-item">
                    <div class="item-inner">
                      <?php echo ($p['precio_oferta']>0 ? '<div class="icon-sale-label sale-left">Oferta!!</div>':'') ?>
                      <?php echo ($p['precio_oferta']>0 ? '<div class="icon-new-label new-right">Nuevo</div>':'') ?>
                      <div class="product-thumbnail">
                        <div class="pr-img-area"><a title="<?php echo $p['concepto'] ?>" href="<?php echo base_url().app::uri($p['concepto']) ?>/<?php echo $p['id_producto'] ?>">
                          <figure> <img class="first-img" src="<?php echo base_url() ?>application/views/img/uploads/<?php echo $p['imagen'] ?>" alt="<?php echo $p['concepto'] ?>"> <img class="hover-img" src="<?php echo base_url() ?>application/views/img/uploads/<?php echo $p['imagen'] ?>" alt="<?php echo $p['concepto'] ?>"></figure>
                          </a></div><div class="pr-info-area">
 							<div class="pr-button">
                           	<div class="mt-button add_to_wishlist"> <a href="javascript:;"> <i class="fa fa-heart-o"></i> </a> </div>
                            <div class="mt-button add_to_compare"> <a href="javascript:;"> <i class="fa fa-link"></i> </a> </div>
                            <div class="mt-button quick-view"> <a href="javascript:;"> <i class="fa fa-search"></i> </a> </div>
                          </div>
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="<?php echo $p['concepto'] ?>" href="<?php echo base_url().app::uri($p['concepto']) ?>/<?php echo $p['id_producto'] ?>"><?php echo $p['concepto'] ?></a> </div>
                          <div class="item-content">
                            <?php echo $this->st->getValuation($p) ?>
                            <div class="item-price">
                              <div class="price-box">                              
                              	<?php echo ( $p['precio_oferta']>0 ? '
                              	 	<p class="special-price"> <span class="price-label">Precio Especial:</span> <span class="price"> $ '. number_format($p['precio_oferta'],2) .' </span> </p>
                                	<p class="old-price"> <span class="price-label">Precio Regular:</span> <span class="price"> $ '.  number_format($p['precio_venta'],2) .' </span> </p>                              	
                              	':'
                              		<span class="regular-price"> <span class="price">$ '.  number_format($p['precio_venta'],2) .'</span> </span>                              	
                              	') ?>
                              </div>							  
                            </div>
                            <div class="pro-action">
                              <button type="button" class="add-to-cart"><span> Agregar al Carrito</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>