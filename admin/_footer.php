  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Tugas Akhir</b>
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="">Adnan Subronto</a>.</strong> 5150411233
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logoutModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">KONFIRMASI</h4>
      </div>
      <div class="modal-body">Pilih "Logout" jika anda ingin keluar dari sistem.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="../auth/logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- CETAK LAPORAN -->
<!-- modal cetak Barang Masuk -->
<div id="cetakBarangmsk" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cetak Data Barang Masuk</h4>
      </div>
      <form action="../_laporan/cetak_barangmasuk.php" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="nm_brg">Nama Kopi</label>
            <select name="nm_brg" value="" class="form-control" required> 
              <option value="">- pilih -</option> 
              <?php  
              $query=mysqli_query($koneksi, "SELECT * from barang"); 
              while ($result=mysqli_fetch_array($query)) {?>  
                <option value=<?=$result['nama_barang']?>>
                  <?=$result['nama_barang']?>
                </option> 
              <?php  } ?>   
            </select>
          </div>

          <div class="form-group">
            <label for="tanggal_awal">Dari Tanggal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" value="date" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="tanggal_akhir">Sampai Tanggal</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="date" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <input type="submit" class="btn btn-success" name="cetak" value="Proses">
        </div>
      </form>
    </div>
  </div>
</div><!-- END modal cetak detail -->

<!-- modal cetak barang keluar -->
<div id="cetakBarangklr" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cetak Data Barang Keluar</h4>
      </div>
      <form action="../_laporan/cetak_barangkeluar.php" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="nm_brg">Nama Kopi</label>
            <select name="nm_brg" value="" class="form-control" required> 
              <option value="">- pilih -</option> 
              <?php  
              $query=mysqli_query($koneksi, "SELECT * from barang"); 
              while ($result=mysqli_fetch_array($query)) {?>  
                <option value=<?=$result['nama_barang']?>>
                  <?=$result['nama_barang']?>
                </option> 
              <?php  } ?>   
            </select>
          </div>
          
          <div class="form-group">
            <label for="tanggal_awal">Dari Tanggal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" value="date" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tanggal_akhir">Sampai Tanggal</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="date" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" name="cetak" value="Proses">
        </div>
      </form>
    </div>
  </div>
</div><!-- END modal cetak barang keluar -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<!-- grafik.js -->
<script src="../dist/highcharts/highcharts.js"></script>
<script src="../dist/highcharts/exporting.js"></script>
<script src="../dist/highcharts/export-data.js"></script>
<script src="../dist/highcharts/accessibility.js"></script>

<script>

  // barang masuk
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

  Highcharts.chart('data_barang_masuk', {
    chart: {
      type: 'area'
    },
    title: {
      text: 'Data Persediaan Bahan Baku Kopi'
    },
    subtitle: {
      text: 'Balakosa Coffe & Co'
    },
    xAxis: {
      categories: <?=json_encode($tanggal_msk);?>,
      tickmarkPlacement: 'on',
      title: {
        enabled: false
      }
    },
    yAxis: {
      title: {
        text: 'Jumlah Satuan'
      },
      labels: {
        formatter: function () {
          return this.value ;
        }
      }
    },
    tooltip: {
      split: false,
      valueSuffix: ''
    },
    plotOptions: {
      area: {
        stacking: 'normal',
        lineColor: '#666666',
        lineWidth: 1,
        marker: {
          lineWidth: 1,
          lineColor: '#666666'
        }
      }
    },
    series: [{
      name: 'Barang Masuk',
      data: <?=json_encode($stok_brg_masuk);?>
    }]
  });

    // barang keluar
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })

    Highcharts.chart('data_barang_keluar', {
      chart: {
        type: 'area'
      },
      title: {
        text: 'Data Persediaan Bahan Baku Kopi'
      },
      subtitle: {
        text: 'Balakosa Coffe & Co'
      },
      xAxis: {
        categories: <?=json_encode($tanggal_klr);?>,
        tickmarkPlacement: 'on',
        title: {
          enabled: false
        }
      },
      yAxis: {
        title: {
          text: 'Jumlah Satuan'
        },
        labels: {
          formatter: function () {
            return this.value ;
          }
        }
      },
      tooltip: {
        split: false,
        valueSuffix: ''
      },
      plotOptions: {
        area: {
          stacking: 'normal',
          lineColor: '#666666',
          lineWidth: 1,
          marker: {
            lineWidth: 1,
            lineColor: '#666666'
          }
        }
      },
      series: [{
        name: 'Barang Keluar',
        data: <?=json_encode($stok_brg_kluar);?>
      }]
    });
  </script>
</body>
</html>