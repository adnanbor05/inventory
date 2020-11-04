<!DOCTYPE html>
<html>
<head>
  <title>Halaman Login</title>

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="../bower_components/style.css">


 </head>
 <body class="login-page bg-login">
   <?php 
   if (isset($_GET['pesan'])) {
     if ($_GET['pesan']){?>
      <div class="col-lg-4 col-lg-offset-4" style="padding-bottom: 10px;">
        <div class="alert alert-danger alert-dismissable" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <span class="fa fa-exclamation-sign" aria-hiden="true"></span>
          <strong>Login Gagal!</strong> Username / Password salah
        </div>
      </div>
      <?php
    }
  }
  ?>
<!-- <div class='kotak_login'>
  <p class='tulisan_login'><strong>LOGIN SISTEM INVENTORI</strong></p><br>
  <form action="cek_login.php" method="post">
    <label><span class="glyphicon glyphicon-user"></span> Username</label>
    <input type="text" name="username" class="form_login" placeholder="Masukan username" required autofocus required="required">

    <label><span class="glyphicon glyphicon-lock"></span> Password</label>
    <input type="password" name="password" class="form_login" placeholder="Masukan password" required="required">

    <input type="submit" class="tombol_login" value="LOGIN">
  </form>
</div> -->
<div class="login-box">
  <div style="color:#6F6F6F" class="login-logo">
        <img style="margin-top:-12px" src="../img/balkos.png" alt="Logo" height="150"><br>
      </div><!-- /.login-logo -->

<div class="login-box-body">
  <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Silahkan Login</p>
  <br/>
  <form action="cek_login.php" method="post">
    <div class="form-group has-feedback">
      <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="password" placeholder="Password" required />
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12">
        <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="LOGIN" />
      </div><!-- /.col -->
    </div>
  </form>

</div><!-- /.login-box-body -->
</div>

<script src="../_assets/js/jquery-1.10.2.js"></script>
<script src="../_assets/js/bootstrap.js"></script>
</body>
</html>