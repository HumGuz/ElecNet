<!DOCTYPE html>
<html>
<?php include_once FCPATH.'application/views/includes/head.php';?>
<body class="sidebar-mini skin-blue-light fixed">
<div class="wrapper">
  <?php include_once FCPATH.'application/views/includes/header.php';?> 
  <?php include_once FCPATH.'application/views/includes/header.php';?>
   <!-- Left side column. contains the logo and sidebar -->
  <?php include_once FCPATH.'application/views/includes/aside.php';?>
  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        404 Error Page
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-exclamation-triangle"></i> Sitio no encontrado </a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404 </h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> ¡Huy! Página no encontrada.</h3>

          <p>
            No pudimos encontrar la página que estabas buscando.
            Mientras tanto, puedes <a href="../../index.html">volver al inicio </a> o intenta usar el formulario de búsqueda.
          </p>

          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
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
