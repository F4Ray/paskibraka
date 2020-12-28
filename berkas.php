<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manajemen Berkas</h1>
          <p class="mb-4"><?php echo ($_SESSION['akses_level'] == '0') ? "Berikut adalah data peserta yang sudah mendaftar. Dihalaman ini admin dapat membuat, mengubah, serta menghapus data setiap user." : "Dihalaman ini anda dapat mengirim, mengubah, dan menghapus berkas milik anda." ?></p>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 pull-right">
                    <?php if ($_SESSION['akses_level'] == '0') { ?>
                      <a href="home.php?halaman=tambahuser" class="btn btn-sm btn-info " role="button" aria-disabled="true">Tambah Data User</a>
                      <?php } ?>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>File Biodata</th>
                        <th>File Pernyataan</th>
                        <th>File Izin</th>
                        <th>File Foto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> 
                          <?php $berkas = $db->cekBerkas($_SESSION['id']);
                          if ($berkas['biodata'] != null) {
                          ?>
                          <a href="<?= $berkas['biodata'] ?>" target="_blank" class="btn btn-sm btn-info " role="button" aria-disabled="true">Lihat</a> 
                          <a href="home.php?halaman=upberkas&act=" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Ubah</a> 
                          <a href="#" data-toggle="modal"  class="btn btn-sm btn-danger " data-target="#logoutModal<?= $berkas['biodata'] ?>" disabled="true">Hapus</a>
                          <?php
                          }else{
                          ?>
                          <a href="home.php?halaman=upberkas&act=uploadbio" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Upload</a>  
                          <?php
                          }
                          ?>
                      </td>
                      <td> 
                          <?php $berkas = $db->cekBerkas($_SESSION['id']);
                          if ($berkas['pernyataan'] != null) {
                          ?>
                          <a href="<?= $berkas['pernyataan'] ?>" target="_blank" class="btn btn-sm btn-info " role="button" aria-disabled="true">Lihat</a> 
                          <a href="home.php?halaman=upberkas&act=" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Ubah</a> 
                          <a href="#" data-toggle="modal"  class="btn btn-sm btn-danger " data-target="#logoutModal<?= $berkas['pernyataan'] ?>" disabled="true">Hapus</a>
                          <?php
                          }else{
                          ?>
                          <a href="home.php?halaman=upberkas&act=uploadpernya" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Upload</a>  
                          <?php
                          }
                          ?>
                      </td>
                      <td> 
                          <?php $berkas = $db->cekBerkas($_SESSION['id']);
                          if ($berkas['izin'] != null) {
                          ?>
                          <a href="<?= $berkas['izin'] ?>" target="_blank" class="btn btn-sm btn-info " role="button" aria-disabled="true">Lihat</a> 
                          <a href="home.php?halaman=upberkas&act=" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Ubah</a> 
                          <a href="#" data-toggle="modal"  class="btn btn-sm btn-danger " data-target="#logoutModal<?= $berkas['izin'] ?>" disabled="true">Hapus</a>
                          <?php
                          }else{
                          ?>
                          <a href="home.php?halaman=upberkas&act=uploadizin" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Upload</a>  
                          <?php
                          }
                          ?>
                      </td>
                      <td> 
                          <?php $berkas = $db->cekBerkas($_SESSION['id']);
                          if ($berkas['foto'] != null) {
                          ?>
                          <a href="<?= $berkas['foto'] ?>" target="_blank" class="btn btn-sm btn-info " role="button" aria-disabled="true">Lihat</a> 
                          <a href="home.php?halaman=upberkas&act=" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Ubah</a> 
                          <a href="#" data-toggle="modal"  class="btn btn-sm btn-danger " data-target="#logoutModal<?= $berkas['foto'] ?>" disabled="true">Hapus</a>
                          <?php
                          }else{
                          ?>
                          <a href="home.php?halaman=upberkas&act=uploadfoto" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Upload</a>  
                          <?php
                          }
                          ?>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

</div>

<div class="modal fade" id="logoutModal<?= $berkas['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol hapus apabila anda yakin ingin mengahapus file biodata anda ? </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="controller.php?hapusdoc=<?= $_SESSION['id'] ?>&berkasnya=biodata">Hapus</a>
        </div>
      </div>
    </div>
</div>
