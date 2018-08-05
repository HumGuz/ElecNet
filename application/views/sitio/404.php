<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Elecnet - 404</title>
<!-- Mobile specific metas  -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon  -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<!-- CSS Style -->

<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/animate.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/simple-line-icons.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/pe-icon-7-stroke.min.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/style.css">
<link rel="stylesheet" type="text/css" href ="<?php echo base_url() ?>application/views/sitio/css/responsive.css">



</head>

<body class="404error_page">
<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]--> 

<?php include_once FCPATH.'application/views/sitio/includes/mobile-menu.php';?>

<div id="page"> 
  <!-- Header -->
   <?php include_once FCPATH.'application/views/sitio/includes/header.php'; ?> 
  <!-- end header -->
  <?php //include_once FCPATH.'application/views/sitio/includes/nav.php'; ?>
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="<?php echo base_url() ?>">Ir al inicio</a><span>&raquo;</span></li>
            <li><strong>Error 404</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
  <!--Container -->
  <div class="error-page">
    <div class="container">
      <div class="error_pagenotfound"> <strong>4<span id="animate-arrow">0</span>4 </strong> <br />
        <b>Oops... Pagina no encontrada!</b> <em>Perdón pero no pudimos encontrar la pagina que buscabas.</em>
        <p>Intenta usar el boton de abajo para regresar a la pagina de inicio.</p>
        <br />
        <a href="<?php echo base_url() ?>" class="button-back"><i class="icon-arrow-left-circle icons"></i>&nbsp; Ir al Inicio</a> </div>
      <!-- end error page notfound --> 
      
    </div>
  </div>
  <!-- Container End --> 
  <!-- service section -->
  <?php include_once FCPATH.'application/views/sitio/includes/service-section.php';?>  
  <!-- Footer -->
  <?php include_once FCPATH.'application/views/sitio/includes/footer.php';?>  
  <a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-up"></i></a> 
 </div>

<!-- End Footer --> 
<!-- JS --> 

<!-- jquery js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery.min.js"></script> 

<!-- bootstrap js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/bootstrap.min.js"></script> 

<!-- owl.carousel.min js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/owl.carousel.min.js"></script> 

<!-- bxslider js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery.bxslider.js"></script> 

<!-- jquery.mobile-menu js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/mobile-menu.js"></script> 

<!--jquery-ui.min js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery-ui.js"></script> 

<!-- main js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/main.js"></script>
</body>
</html>