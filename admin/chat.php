<?php 
session_start();
include_once('_header.php');

$id_member = $_SESSION['id_user'];

$nama_member = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user = '$id_member'");
$data = mysqli_fetch_array($nama_member);
?>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Pesan</h3>
            <div class="box-body">
              <div class="alert alert-success alert-dismissible">
                <?php 
                $pesan_baru = mysqli_query($koneksi, "SELECT * FROM pesan WHERE id_penerima ='$id_member' AND sudah_dibaca = 'belum'");
                $jumlah_pesan_baru = mysqli_num_rows($pesan_baru);
                if ($jumlah_pesan_baru == 0) {
                  echo "<p>tidak ada pesan baru</p>";
                }
                else if ($jumlah_pesan_baru > 0) {
                  echo "<p><strong>".$jumlah_pesan_baru."</strong> pesan belum dibaca</p>";
                }
                ?>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed tabel_pesan" width="100%">
                  <thead>
                    <tr>
                      <th>Pengirim</th>
                      <th>Subyek Pesan</th>
                      <th>Tanggal</th>
                      <th class="text-center">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query_daftar_pesan = mysqli_query($koneksi,"SELECT P.*, M.id_user, M.nama FROM pesan P, user M WHERE P.id_pengirim=M.id_user AND P.id_penerima='$id_member' ORDER BY P.id_pesan DESC");

                    while ($daftar_pesan = mysqli_fetch_array($query_daftar_pesan)){
                      if ($daftar_pesan['sudah_dibaca'] == "belum") {

                        ?>
                        <tr class="pesan pesan_belum">
                          <td><?php echo $daftar_pesan['nama']; ?></td>
                          <td><a href="buka_pesan.php?id_user=<?php echo $id_member; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a></td>
                          <td><?php echo $daftar_pesan['tanggal']; ?></td>
                          <td class="text-center">
                            <a href="../_proses/del_chat.php?id=<?=$daftar_pesan['id_pesan']?>" onclick="return confirm('Yakin akan menghapus pesan dari <?=$daftar_pesan['nama']?> ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i> hapus
                            </a>
                          </td>
                        </tr>
                      <?php } 
                      elseif ($daftar_pesan['sudah_dibaca'] == "sudah") {
                        ?>
                        <tr class="pesan">
                          <td><?php echo $daftar_pesan['nama']; ?></td>
                          <td><a href="buka_pesan.php?id_user=<?php echo $id_member; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a></td>
                          <td><?php echo $daftar_pesan['tanggal']; ?></td>
                          <td class="text-center">
                            <a href="../_proses/del_chat.php?id=<?=$daftar_pesan['id_pesan']?>" onclick="return confirm('Yakin akan menghapus pesan dari <?=$daftar_pesan['nama']?> ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i> hapus
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

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
              <?php 
              if (isset($_GET['pesan'])) {
                if ($_GET['pesan']){?>

                  <div class="alert alert-danger alert-dismissable" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="fa fa-exclamation-sign" aria-hiden="true"></span>
                    <strong>Upss!</strong> Pilih Penerima Pesan!
                  </div>
                  <?php
                }
              }
              ?>
              <div class="form-group">
                <input type="hidden" id="pengirim_kirim_pesan" name="pengirim_kirim_pesan" value="<?php echo $id_member; ?>" required>

                <label for="penerima_kirim_pesan">Penerima</label>
                <select id="penerima_kirim_pesan" name="penerima_kirim_pesan" class="form-control" required>
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
                <input type="text" name="subyek_kirim_pesan" id="subyek_kirim_pesan" class="form-control" placeholder="Subyek" required> 
              </div>

              <div class="form-group">
                <textarea class="form-control" id="isi_kirim_pesan" name="isi_kirim_pesan" cellpadding="5" cellspacing="0" style="height: 300px" required></textarea>
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