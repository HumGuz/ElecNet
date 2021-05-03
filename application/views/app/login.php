<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ElecNet | Acceso</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color:#FFFFFF ">
<div class="login-box">
  <div class="login-logo">
  	 <img src="<?php echo base_url() ?>application/views/img/logo.png" alt="fotter logo">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background: #118fc6;">
    <p class="login-box-msg" style="color:white">Accede para iniciar tu sesión</p>
    <form id="lgnFrm" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control required email" placeholder="Email" id="email" name="email" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control required " placeholder="Password"  id="pass" name="pass" autocomplete="off" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label style="color:white">
              <input type="checkbox"  id="remember" name="remember"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat" name="sbmt"><span class="fa fa-sign-in"></span> Acceder</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="#" style="color:white">Olvidé mi contraseña</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>application/third_party/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>application/third_party/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>application/third_party/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>application/third_party/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>application/third_party/jquery-validation/dist/messages_es.min.js"></script>
<script src="<?php echo base_url();?>application/third_party/jquery-validation/dist/validation.js"></script>
<script src="<?php echo base_url();?>application/views/js/login.js"></script>
</body>
</html>
=======
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ElecNet | Acceso</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/third_party/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color:#FFFFFF ">
<div class="login-box">
  <div class="login-logo">
  	 <img src="<?php echo base_url() ?>application/views/img/logo.png" alt="fotter logo">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background: #118fc6;">
    <p class="login-box-msg" style="color:white">Accede para iniciar tu sesión</p>
    <form id="lgnFrm" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control required email" placeholder="Email" id="email" name="email" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control required " placeholder="Password"  id="pass" name="pass" autocomplete="off" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label style="color:white">
              <input type="checkbox"  id="remember" name="remember"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat" name="sbmt"><span class="fa fa-sign-in"></span> Acceder</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="#" style="color:white">Olvidé mi contraseña</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>application/third_party/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>application/third_party/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>application/third_party/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>application/third_party/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>application/third_party/jquery-validation/dist/messages_es.min.js"></script>
<script src="<?php echo base_url();?>application/third_party/jquery-validation/dist/validation.js"></script>
<script src="<?php echo base_url();?>application/views/js/login.js"></script>
</body>
</html>
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
