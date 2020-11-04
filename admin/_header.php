<?php
require_once '../_config/koneksi.php';

// untuk pesan
$id_member = $_SESSION['id_user'];
$nama_member = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user = '$id_member'");
$data = mysqli_fetch_array($nama_member);

//cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['status'] != "login" || $_SESSION['level'] != "admin") {
  header("location:../auth/login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Balakosa Coffee & Co</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- chatt -->
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
  <style type="text/css">
    .pesan_belum {
      font-weight: bold;
    }
  </style>


</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="../img/logo.png" alt="Logo" height="40"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="../img/balkos.png" alt="Logo" height="40">
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>


        <!-- NOTIVIKASI -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- notifikasi -->
            <!--             <ul class="nav navbar-nav navbar-user">
              <li class="dropdown messages-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <span class="badge"></span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"> notifikasi</li>
                  <li><a href="dataExpired.php"> Lihat Detail <span class="badge"> </span></a></li>
                </ul>
              </li>
            </ul> -->
            <!-- end notifikasi -->

            <!-- pesan -->
            <?php
            $pesan_baru = mysqli_query($koneksi, "SELECT * FROM pesan WHERE id_penerima ='$id_member' AND sudah_dibaca = 'belum'");
            $jumlah_pesan_baru = mysqli_num_rows($pesan_baru);
            ?>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>

                <span class="label label-success"><?php echo $jumlah_pesan_baru; ?></span>

              </a>
              <ul class="dropdown-menu">
                <li class="header"> Anda
                  <?php
                  if ($jumlah_pesan_baru == 0) {
                    echo "tidak memiliki pesan";
                  } else if ($jumlah_pesan_baru > 0) {
                    echo "memiliki " . $jumlah_pesan_baru . " pesan";
                  }
                  ?>
                  baru
                </li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li>
                      <?php
                      $query_daftar_pesan = mysqli_query($koneksi, "SELECT P.*, M.id_user, M.nama FROM pesan P, user M WHERE P.id_pengirim=M.id_user AND P.id_penerima='$id_member' ORDER BY P.id_pesan DESC");

                      while ($daftar_pesan = mysqli_fetch_array($query_daftar_pesan)) {
                        if ($daftar_pesan['sudah_dibaca'] == "belum") { ?>
                          <a href="buka_pesan.php?id_user=<?php echo $id_member; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>">
                            <!-- pesan dari -->
                            <h4><?php echo $daftar_pesan['nama']; ?>
                              <small><i class="fa fa-clock-o"></i><?php echo $daftar_pesan['tanggal']; ?></small>
                            </h4>
                            <p><?php echo $daftar_pesan['subyek_pesan']; ?></p>
                          </a>
                      <?php }
                      } ?>
                    </li>

                    <!-- end pesan dari -->
                  </ul>
                </li>
                <li class="footer"><a href="chat.php">Lihat semua Pesan</a></li>
              </ul>
            </li>
            <!-- end pesan -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?= $_SESSION['nama']; ?><i style="margin-left:5px" class="fa fa-angle-down"></i></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User bodi -->
                <li class="user-header">
                  <p>
                    <?= $_SESSION['nama']; ?>
                    <small><?= $_SESSION['level']; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="dataUser.php" class="btn btn-default btn-flat">Kelola Akun</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#logoutModal">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <!-- user image -->
          <div class="pull-left image">
            <br><br>
          </div>
          <div class="pull-left info">
            <p><?= $_SESSION['nama']; ?></p>
            <a><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dataBarang.php"><i class="fa fa-circle-o"></i> Data Barang</a></li>
              <li><a href="datajenis.php"><i class="fa fa-circle-o"></i> Data Jenis Barang</a></li>
              <li><a href="dataSupp.php"><i class="fa fa-circle-o"></i> Data Suplier</a></li>
              <li><a href="konfigurasi_eoq.php"><i class="fa fa-circle-o"></i> Konfigurasi EOQ</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="barangmasuk.php"><i class="fa fa-circle-o"></i> Barang Masuk</a></li>
              <li><a href="dataBarangklr.php"><i class="fa fa-circle-o"></i> Barang Keluar</a></li>
            </ul>
          </li>

          <li><a href="eoq.php"><i class="fa fa-balance-scale"></i> <span>EOQ</span></a></li>

          <li><a href="chat.php"><i class="fa fa-comments-o"></i> <span>Obrolan</span></a></li>

          <li><a href="dataUser.php"><i class="fa fa-users"></i> <span>Kelola User</span></a></li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>