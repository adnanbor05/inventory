<?php 
session_start();
include_once('_header.php');

$id_member = $_SESSION['id_user'];
$id_pesan = $_GET['id_pesan'];

$query_daftar_pesan = mysqli_query($koneksi,"SELECT P.*, M.id_user, M.nama FROM pesan P, user M WHERE P.id_pengirim=M.id_user AND P.id_penerima='$id_member' ORDER BY P.id_pesan DESC");


$query_buka_pesan = mysqli_query($koneksi, "SELECT P.*, M.id_user, M.nama FROM pesan P, user M WHERE id_pesan = $id_pesan AND P.id_pengirim = M.id_user");

$buka_pesan = mysqli_fetch_array($query_buka_pesan);
?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Lihat Pesan</h3>
            <div class="box-body">
              <div class="pull-right" style="margin-bottom: 5px; padding-right: 18px;">
                <a href="chat.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a><br>    
              </div>
              <form style="margin-bottom: 20px; margin-top: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <tr>
                        <th>Pengirim</th>
                        <td> : </td>
                        <td><strong><?php echo $buka_pesan['nama']; ?></strong></td>
                      </tr>
                      <tr>
                        <th>Tanggal</th>
                        <td> : </td>
                        <td><strong><?php echo $buka_pesan['tanggal']; ?></strong></td>
                      </tr>
                      <tr>
                        <th>Subyek Pesan</th>
                        <td> : </td>
                        <td><strong><?php echo $buka_pesan['subyek_pesan']; ?></strong></td>
                      </tr>
                      <tr>
                        <th>Isi Pesan</th>
                        <td> : </td>
                        <td><strong><?php echo $buka_pesan['isi_pesan']; ?></strong></td>
                      </tr>
                    </table>
                    <?php
                     $sudah_dibaca = mysqli_query($koneksi, "UPDATE pesan SET sudah_dibaca = 'sudah' WHERE id_pesan=$id_pesan");
                    ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Kirim pesan baru -->
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Kirim Pesan Baru</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" id="kirim_pesan">
            <form action="../_proses/proses_kirim_pesan.php" method="post" id="form_kirim_pesan">
              <div class="form-group">
                <input type="hidden" id="pengirim_kirim_pesan" name="pengirim_kirim_pesan" value="<?php echo $id_member; ?>">

                <label for="penerima_kirim_pesan">Penerima</label>
                <select id="penerima_kirim_pesan" name="penerima_kirim_pesan" class="form-control">
                  <option value="0"> -pilih penerima - </option>
                  <?php
                  $query_penerima = mysqli_query($koneksi, "SELECT id_user, nama FROM user WHERE id_user != $id_member");
                  while ($daftar_penerima = mysqli_fetch_array($query_penerima)) {
                    ?>
                    <option value="<?php echo $daftar_penerima['id_user']; ?>"><?php echo $daftar_penerima['nama']; ?></option>
                    <?php
                  } 
                  ?>
                </select>

              </div>

              <div class="form-group"> 
                <label>Subyek Pesan</label> 
                <input name="subyek_kirim_pesan" id="subyek_kirim_pesan" class="form-control" placeholder="Subyek"> 
              </div>

              <div class="form-group">
                <textarea class="form-control" id="isi_kirim_pesan" name="isi_kirim_pesan" cellpadding="5" cellspacing="0" style="height: 300px"></textarea>
              </div>

              <div class="box-footer">
                <div class="pull-right">
                  <button type="submit" name="submit_kirim_pesan" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
          <!-- /.box-footer -->
        </div>
        <!-- /. box -->
      </div>
      
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php include_once('_footer.php'); ?>