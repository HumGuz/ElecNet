<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>application/views/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
          	<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        <li><a href="<?php echo base_url().'admin/' ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <li class="header"><i class="fa fa-book"></i> Catálogos</li>              
       	
       	<li><a href="<?php echo base_url().'sucursales/' ?>"><i class="fa fa-building-o"></i> <span>Sucursales</span> </a></li>
        <li class="treeview">
          <a href="javascript:;"><i class="fa fa-cube"></i> <span>Almacenes</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'almacenes/' ?>"><i class="fa fa-archive"></i> Lista de almacenes </a></li>
            <li><a href="<?php echo base_url().'productos/' ?>"><i class="fa  fa-cubes"></i> Productos por almacén </a></li>            
            <li><a href="<?php echo base_url().'clasificaciones/' ?>"><i class="glyphicon glyphicon-folder-open"></i> Clasificación de prod. </a></li>                
          </ul>
        </li>
        <li><a href="<?php echo base_url().'clientes/' ?>"><i class="fa fa-users"></i> <span>Clientes</span> </a></li>
        <li><a href="<?php echo base_url().'proveedores/' ?>"><i class="fa fa-truck"></i> <span>Proveedores</span> </a></li>
        <li><a href="<?php echo base_url().'usuarios/' ?>"><i class="fa fa-user"></i> <span>Usuarios</span> </a></li>
        
        <li class="header"><i class="fa fa-suitcase"></i> Operaciones</li>    
        
        <li><a href="<?php echo base_url().'ordenes/' ?>"><i class="fa fa-file-text"></i> <span>Ordenes de compra</span> </a></li>
        <li><a href="<?php echo base_url().'compras/' ?>"><i class="fa fa-cart-arrow-down"></i> <span>Compras</span> </a></li>
       	<li><a href="<?php echo base_url().'ventas/' ?>"><i class="fa fa-money"></i> <span>Ventas</span> </a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>