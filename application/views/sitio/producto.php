<!DOCTYPE html>
<html lang="en">
<?php include_once FCPATH.'application/views/sitio/includes/head.php';?>
<body class="product-page">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]--> 
<!-- mobile menu -->
<?php include_once FCPATH.'application/views/sitio/includes/mobile-menu.php';?>
<!-- end mobile menu -->
<div id="page">   
  <!-- Header -->
<?php include_once FCPATH.'application/views/sitio/includes/header.php';?>
  <!-- end header -->
<?php include_once FCPATH.'application/views/sitio/includes/nav.php';?>  

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Ir al inicio" href="<?php echo base_url(); ?>">Elecnet</a><span>&raquo;</span></li>
            <li class=""> <a title="Todo de este departamento" href="<?php echo base_url().'departamento/'.app::uri($prd['departamento']).'/'.$prd['id_departamento'] ?>"><?php echo $prd['departamento'] ?></a><span>&raquo;</span></li>
            <li><strong><?php echo $prd['concepto'] ?></strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Breadcrumbs End --> 
  <!-- Main Container -->
	<script>console.log(<?php echo json_encode($prd) ?>)</script>
  <div class="main-container col1-layout">
    <div class="container">
      <div class="row">
        <div class="col-main">
          <div class="product-view-area">
            <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
              <div class="icon-sale-label sale-left">En venta</div>
              <div class="large-image"> <a href="javascript:;" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20"> <img class="zoom-img" src="<?php echo base_url() ?>application/views/img/uploads/<?php echo $prd['imagenes'][0]['imagen'] ?>" alt="<?php echo $prd['concepto'] ?>"> </a> </div>
              <div class="flexslider flexslider-thumb">
                <ul class="previews-list slides">
                  <?php
                  	if(count($prd['imagenes'])>1){
                  		foreach ($prd['imagenes'] as $key => $i) {
                  			if($k>0)
							  echo '<li><a href="javascript:;" class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \''.base_url().'application/views/img/uploads/'.$i['imagen'].'\' "><img src="'.base_url().'application/views/img/uploads/'.$i['imagen'].'" alt = "'.$prd['concepto'].'"/></a></li>';
						 }
                  	} 
                  ?>
               </ul>
              </div>              
              <!-- end: more-images --> 
            </div>
            <div class="col-xs-12 col-sm-7 col-lg-7 col-md-7 product-details-area">
              <div class="product-name">
                <h1><?php echo $prd['concepto'] ?></h1>
              </div>
              <div class="price-box">
              	<?php echo ( $prd['precio_oferta']>0 ? '
                	<p class="special-price"> <span class="price-label">Precio Especial:</span> <span class="price"> $ '. number_format($prd['precio_oferta'],2) .' </span> </p>
                    <p class="old-price"> <span class="price-label">Precio Regular:</span> <span class="price"> $ '.  number_format($prd['precio_venta'],2) .' </span> </p>                              	
                    ':'<span class="regular-price"> <span class="price">$ '.  number_format($prd['precio_venta'],2) .'</span> </span>') ?>	
              </div>
              <div class="ratings">
              	<?php echo $prd['valuation'] ?>               
                <!-- <p class="rating-links"> <a href="javascript:;">1 Review(s)</a> <span class="separator">|</span> <a href="javascript:;">Add Your Review</a> </p> -->
                <p class="availability in-stock pull-right">Disponibilidad: <span>En Stock</span></p>
              </div>
              <div class="short-description">
                <h2>Descripción del producto</h2>
                <p><?php echo $prd['descripcion'] ?></p>
              </div>
              <div class="product-color-size-area">
                <div class="color-area">
                  <h2 class="saider-bar-title">Color</h2>
                  <div class="color">
                    <ul>
                      <?php 
                      	$cls = explode(',', $prd['colores']);
                      	if(!empty($cls)){
                      		foreach ($cls as $key => $c) {
								echo '<li><a href="javascript:;" style="background:'.$c.'!important"></a></li>';
							}
                      	}
                      ?>	
                    </ul>
                  </div>
                </div>
                <div class="size-area">
                  <h2 class="saider-bar-title">Dimensiones</h2>
                  <div class="size">
                    <ul>
                      <li><a href="javascript:;"><?php echo $prd['dimensiones'] ?></a></li>                     
                    </ul>
                  </div>
                </div>
                <div class="size-area">
                  <h2 class="saider-bar-title">Peso</h2>
                  <div class="size">
                    <ul>
                      <li><a href="javascript:;"><?php echo $prd['peso'] ?></a></li>                     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="product-variation">
                <form action="#" method="post">
                  <div class="cart-plus-minus">
                    <label for="qty">Cantidad:</label>
                    <div class="numbers-row">
                      <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                      <input type="text" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                      <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                    </div>
                  </div>
                  <button class="button pro-add-to-cart" title="Add to Cart" type="button"><span><i class="fa fa-shopping-basket"></i> Agregar al carrito</span></button>
                </form>
              </div>
              <div class="product-cart-option">
                <ul>
                  <li><a href="javascript:;"><i class="fa fa-heart-o"></i><span>Agregar a mi lista de deseos</span></a></li>
                  <li><a href="javascript:;"><i class="fa fa-link"></i><span>Agregar a compración</span></a></li>
                  <!-- <li><a href="javascript:;"><i class="fa fa-envelope"></i><span>Enviar por correo a un amigo</span></a></li> -->
                </ul>
              </div>
              <div class="pro-tags">
                <div class="pro-tags-title">Tags:</div>                
                <?php 
                      	$tgs = explode(',', $prd['tags']);
                      	if(!empty($tgs)){
                      		$tags = '';
                      		foreach ($tgs as $key => $t) {
								$tags .= ' <a href="javascript:;">'.$t.'</a>,';
							}
							echo trim($tags,',');
                      	}else{
                      		echo '<p>Aun no hay tags para este producto, ¡Agrega unos cuantos!';
                      	}
                 ?>	
              </div>
             <!-- <div class="share-box">
                <div class="title">Share in social media</div>
                <div class="socials-box"> <a href="javascript:;"><i class="fa fa-facebook"></i></a> <a href="javascript:;"><i class="fa fa-twitter"></i></a> <a href="javascript:;"><i class="fa fa-google-plus"></i></a> <a href="javascript:;"><i class="fa fa-youtube"></i></a> <a href="javascript:;"><i class="fa fa-linkedin"></i></a> <a href="javascript:;"><i class="fa fa-instagram"></i></a> </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="product-overview-tab">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="product-tab-inner">
                  <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                    <!-- <li class="active"> <a href="#description" data-toggle="tab"> Description </a> </li>
                    <li> <a href="#reviews" data-toggle="tab">Reviews</a> </li> -->
                    <li class="active"><a href="#product_tags" data-toggle="tab">Tags</a></li>
                    <!-- <li> <a href="#custom_tabs" data-toggle="tab">Custom Tab</a> </li> -->
                  </ul>
                  <div id="productTabContent" class="tab-content">
                    <!-- <div class="tab-pane fade in active" id="description">
                      <div class="std">
                        <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum. Quisque in arcu id dui vulputate mollis eget non arcu. Aenean et nulla purus. Mauris vel tellus non nunc mattis lobortis.</p>
                      </div>
                    </div> 
                    <div id="reviews" class="tab-pane fade">
                      <div class="col-sm-5 col-lg-5 col-md-5">
                        <div class="reviews-content-left">
                          <h2>Customer Reviews</h2>
                          <div class="review-ratting">
                            <p><a href="javascript:;">Amazing</a> Review by Company</p>
                            <table>
                              <tbody>
                                <tr>
                                  <th>Price</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                                <tr>
                                  <th>Value</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                                <tr>
                                  <th>Quality</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                              </tbody>
                            </table>
                            <p class="author"> Angela Mack<small> (Posted on 16/12/2015)</small> </p>
                          </div>
                          <div class="review-ratting">
                            <p><a href="javascript:;">Good!!!!!</a> Review by Company</p>
                            <table>
                              <tbody>
                                <tr>
                                  <th>Price</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                                <tr>
                                  <th>Value</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                                <tr>
                                  <th>Quality</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                              </tbody>
                            </table>
                            <p class="author"> Lifestyle<small> (Posted on 20/12/2015)</small> </p>
                          </div>
                          <div class="review-ratting">
                            <p><a href="javascript:;">Excellent</a> Review by Company</p>
                            <table>
                              <tbody>
                                <tr>
                                  <th>Price</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                                <tr>
                                  <th>Value</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                                <tr>
                                  <th>Quality</th>
                                  <td><div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div></td>
                                </tr>
                              </tbody>
                            </table>
                            <p class="author"> Jone Deo<small> (Posted on 25/12/2015)</small> </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-7 col-lg-7 col-md-7">
                        <div class="reviews-content-right">
                          <h2>Write Your Own Review</h2>
                          <form>
                            <h3>You're reviewing: <span>Donec Ac Tempus</span></h3>
                            <h4>How do you rate this product?<em>*</em></h4>
                            <div class="table-responsive reviews-table">
                              <table>
                                <tbody>
                                  <tr>
                                    <th></th>
                                    <th>1 star</th>
                                    <th>2 stars</th>
                                    <th>3 stars</th>
                                    <th>4 stars</th>
                                    <th>5 stars</th>
                                  </tr>
                                  <tr>
                                    <td>Quality</td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                  </tr>
                                  <tr>
                                    <td>Price</td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                  </tr>
                                  <tr>
                                    <td>Value</td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                    <td><input type="radio"></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="form-area">
                              <div class="form-element">
                                <label>Nickname <em>*</em></label>
                                <input type="text">
                              </div>
                              <div class="form-element">
                                <label>Summary of Your Review <em>*</em></label>
                                <input type="text">
                              </div>
                              <div class="form-element">
                                <label>Review <em>*</em></label>
                                <textarea></textarea>
                              </div>
                              <div class="buttons-set">
                                <button class="button submit" title="Submit Review" type="submit"><span><i class="fa fa-thumbs-up"></i> &nbsp;Review</span></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                   -->
                    <div class="tab-pane fade in active" id="product_tags">
                      <div class="box-collateral box-tags">
                        <div class="tags">
                          <form id="addTagForm" action="#" method="get">
                            <div class="form-add-tags">
                              <div class="input-box">
                                <label for="productTagName">Agrega Tus Tags:</label>
                                <input class="input-text" name="productTagName" id="productTagName" type="text">
                                <button type="button" title="Add Tags" class="button add-tags"><i class="fa fa-plus"></i> &nbsp;<span>Agregar Tag</span> </button>
                              </div>
                              <!--input-box--> 
                            </div>
                          </form>
                        </div>
                        <!--tags-->
                        <p class="note">Usa un espacio para separar tus tags, usa ' para agregar frases.</p>
                      </div>
                    </div>
                     <!--  <div class="tab-pane fade" id="custom_tabs">
                      <div class="product-tabs-content-inner clearfix">
                      <p><strong>Lorem Ipsum</strong><span>&nbsp;is</span></p> 
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- related products -->
  <?php include_once FCPATH.'application/views/sitio/includes/related_products.php';?> 
  <!-- upselling products -->
  <?php include_once FCPATH.'application/views/sitio/includes/upsell_products.php';?> 
  <!-- service section -->
  <?php include_once FCPATH.'application/views/sitio/includes/service-section.php';?>    
   <!-- Footer -->
 <?php include_once FCPATH.'application/views/sitio/includes/footer.php';?>
  <a href="javascript:;" id="back-to-top" title="Regresar Arriba"><i class="fa fa-angle-up"></i></a>   
  <!-- End Footer --> 
</div>
<!-- JS --> 
<!-- jquery js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery.min.js"></script>
<!-- bootstrap js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/bootstrap.min.js"></script> 
<!-- owl.carousel.min js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/owl.carousel.min.js"></script> 
<!--cloud-zoom js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/cloud-zoom.js"></script> 
<!-- flexslider js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery.flexslider.js"></script> 
<!-- jquery.mobile-menu js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/mobile-menu.js"></script> 
<!--jquery-ui.min js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery-ui.js"></script> 
<!-- main js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/main.js"></script> 
<!-- countdown js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/countdown.js"></script>
</body>
</html>
