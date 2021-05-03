<<<<<<< HEAD
<!DOCTYPE html>
<html>
<?php include_once FCPATH.'application/views/includes/head.php';?>
<body class="sidebar-mini skin-blue-light fixed">
<div class="wrapper">
  <?php  include_once FCPATH.'application/views/includes/header.php';?> 
   <!-- Left side column. contains the logo and sidebar -->
  <?php include_once FCPATH.'application/views/includes/aside.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">   
	<div id="content" class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			<?php include_once FCPATH.'application/views/admin/estadisticas.php';?> 			 		
		</div>						
	</div>     
    <!-- Content Header (Page header) -->
  <!-- /.content-wrapper -->
  <style>
  	#content{
  	    height: calc(100vh - 93px);
  	    position:relative;
  	} 
  	
  	#content>.tab-pane{
  	    height: 100%;
  	}
  	 
 	.main-footer {
	   border-top-color: transparent!important;
  	}
  	.main-footer .nav-tabs a{
	   border-radius:0px!important;
	   padding-right: 22px;
  	}
  	.main-footer .nav-tabs>li.active>a{
  		color:#FFFFFF;
	    border-bottom-color: #ddd!important;
	    background-color: #3c8dbc;
  	}  
  	
  	.main-footer .nav-tabs>li.active>i.fa-times{
  		color:#FFFFFF
  	}
  	
  	.main-footer .nav-tabs>li.cerrable>a{
  		padding-right:25px;
  	}
  	
  	.main-footer .nav-tabs>li>i.fa-times{
  		position: absolute;
	    top: 14px;
	    right: 10px;
	    color:#3c8dbc;
	    cursor:pointer;
  	}
  	
  </style>
	<footer id="footer" class="main-footer">
		<ul id="barra-tareas" class="nav nav-tabs" role="tablist">
	    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Inicio</a></li>
	 	</ul>
	</footer>
  <?php include_once FCPATH.'application/views/includes/foot.php';?> 
</div>
<!-- ./wrapper -->
</body>
</html>
=======
<!DOCTYPE html>
<html>
<?php include_once FCPATH.'application/views/includes/head.php';?>
<body class="sidebar-mini skin-blue-light fixed">
<div class="wrapper">
  <?php  include_once FCPATH.'application/views/includes/header.php';?> 
   <!-- Left side column. contains the logo and sidebar -->
  <?php include_once FCPATH.'application/views/includes/aside.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">   
	<div id="content" class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			<?php include_once FCPATH.'application/views/admin/estadisticas.php';?> 			 		
		</div>						
	</div>     
    <!-- Content Header (Page header) -->
  <!-- /.content-wrapper -->
  <style>
  	#content{
  	    height: calc(100vh - 93px);
  	    position:relative;
  	} 
  	
  	#content>.tab-pane{
  	    height: 100%;
  	}
  	 
 	.main-footer {
	   border-top-color: transparent!important;
  	}
  	.main-footer .nav-tabs a{
	   border-radius:0px!important;
	   padding-right: 22px;
  	}
  	.main-footer .nav-tabs>li.active>a{
  		color:#FFFFFF;
	    border-bottom-color: #ddd!important;
	    background-color: #3c8dbc;
  	}  
  	
  	.main-footer .nav-tabs>li.active>i.fa-times{
  		color:#FFFFFF
  	}
  	
  	.main-footer .nav-tabs>li.cerrable>a{
  		padding-right:25px;
  	}
  	
  	.main-footer .nav-tabs>li>i.fa-times{
  		position: absolute;
	    top: 14px;
	    right: 10px;
	    color:#3c8dbc;
	    cursor:pointer;
  	}
  	
  </style>
	<footer id="footer" class="main-footer">
		<ul id="barra-tareas" class="nav nav-tabs" role="tablist">
	    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Inicio</a></li>
	 	</ul>
	</footer>
  <?php include_once FCPATH.'application/views/includes/foot.php';?> 
</div>
<!-- ./wrapper -->
</body>
</html>
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
