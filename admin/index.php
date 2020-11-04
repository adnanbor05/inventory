<?php
require_once'../_config/koneksi.php';  
session_start();
ob_start();
  //cek apakah yang mengakses halaman ini sudah login
if($_SESSION['status']!="login" || $_SESSION['level']!="admin"){
  header("location:../auth/login.php");
}
?>

<?php include_once('_header.php'); ?>

<?php
$jmlBarang = "SELECT * FROM barang";
$jmlBarangmsk = "SELECT * FROM brg_masuk JOIN barang ON brg_masuk.kode_barang = barang.kode_barang";
$jmlBarangklr = "SELECT * FROM brg_kluar JOIN barang ON brg_kluar.kode_barang = barang.kode_barang";
$jmlsup = "SELECT * FROM supplier";

$jmlBin = mysqli_num_rows(mysqli_query($koneksi, $jmlBarangmsk));
$jmlBout = mysqli_num_rows(mysqli_query($koneksi, $jmlBarangklr));
$jmlB = mysqli_num_rows(mysqli_query($koneksi, $jmlBarang));
$jmls = mysqli_num_rows(mysqli_query($koneksi, $jmlsup));
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="row">

      <div class="col-lg-12 col-xs-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p style="font-size:15px">
            <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama']; ?></strong> di Aplikasi Persediaan Barang.
          </p>        
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo "$jmlB";?></sup></h3>
            <p>Data Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="dataBarang.php" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo "$jmlBin";?></h3>
            <p>Barang Masuk</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-archive"></i>
          </div>
          <a href="barangmasuk.php" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo "$jmlBout";?></h3>

            <p>Barang Keluar</p>
          </div>
          <div class="icon">
            <i class="ion ion-arrow-graph-up-right"></i>
          </div>
          <a href="dataBarangklr.php" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo "$jmls";?></h3>

            <p>Suplier</p>
          </div>
          <div class="icon">
            <i class="ion ion-at"></i>
          </div>
          <a href="dataSupp.php" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- grafik -->
    <div class="row">
      
      <!-- <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Persediaan</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <figure class="highcharts-figure">
              <div id="data_barang"></div>
            </figure>
          </div>
        </div>
      </div> -->

      <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Barang Masuk</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <!-- isi grafik -->
            <figure class="highcharts-figure">
              <div id="data_barang_masuk"></div>
            </figure>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Barang Keluar</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <!-- isi grafik -->
            <figure class="highcharts-figure">
              <div id="data_barang_keluar"></div>
            </figure>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div> 
    <!-- end grafik -->

    <!-- ambil data untuk grafik -->
    <?php  
    require_once'../_config/koneksi.php'; 
    // $query = "SELECT * FROM barang ORDER BY nama_barang ASC";
    $querybrg_masuk = "SELECT * FROM brg_masuk JOIN barang ON barang.kode_barang = brg_masuk.kode_barang ORDER BY tanggal_msk ASC";
    $querybrg_kluar = "SELECT * FROM brg_kluar JOIN barang ON barang.kode_barang = brg_kluar.kode_barang ORDER BY nama_barang ASC";

    //$sql_barang = mysqli_query($koneksi, $query);
    $sql_barang_masuk = mysqli_query($koneksi, $querybrg_masuk);
    $sql_barang_kluar = mysqli_query($koneksi, $querybrg_kluar);

    // barang/stok
    // $nama_brg = array();
    // $stok_brg = array();
    // while ($data = mysqli_fetch_array($sql_barang)){
    // $nama_brg[] = $data['nama_barang'];
    // $stok_brg[] = intval($data['stok_barang']);  
    // }
    
    // barang masuk
    $nama_brg_masuk = array();
    $tanggal_msk = array();
    $stok_brg_masuk = array();
    while ($data = mysqli_fetch_array($sql_barang_masuk)){
      $nama_brg_masuk[] = $data['nama_barang'];
      $tanggal_msk[] = $data['tanggal_msk'];
      $stok_brg_masuk[] = intval($data['jumlah_brg']);  
    }
    
    //barang keluar
    $nama_brg_kluar = array();
    $tanggal_klr = array();
    $stok_brg_kluar = array();
    while ($data = mysqli_fetch_array($sql_barang_kluar)){
      $tanggal_klr[] = $data['tanggal_klr']; 
      $nama_brg_kluar[] = $data['nama_barang'];
      $stok_brg_kluar[] = intval($data['jumlah_brg']);  
    }

    ?>



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once('_footer.php'); ?>
