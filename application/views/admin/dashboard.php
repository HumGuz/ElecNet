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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Salpicadero</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    	<?php include_once FCPATH.'application/views/admin/estadisticas.php';?> 
      <!-- Main row -->
      <div class="row">      
       
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versión</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017 <a href="#">Halammeshta Devs</a>.</strong> Todos los derechos reservados.
  </footer>
  <?php include_once FCPATH.'application/views/includes/foot.php';?> 
</div>
<!-- ./wrapper -->
</body>
</html>
