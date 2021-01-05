<div class="container-fluid">
<?php if (isset($uploadkan)) {
  if ($uploadkan == true) {
?>
    <div class="alert alert-success" role="alert">
        File berhasil diupload, halaman manajemen berkas akan di load dalam 3 detik
    </div>
  <?php }
  }
?>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?php echo ($_GET['act'] == "upload") ? "Upload File Bioadata" : "Lihat File Biodata" ?></h1>
          <p class="mb-4"><?php echo ($_SESSION['akses_level'] == '0') ? "Berikut adalah data peserta yang sudah mendaftar. Dihalaman ini admin dapat membuat, mengubah, serta menghapus data setiap user." : "Upload file biodata kamu disini." ?></p>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">File Biodata</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 pull-right">
                    <?php if ($_SESSION['akses_level'] == '0') { ?>
                      <a href="home.php?halaman=tambahuser" class="btn btn-sm btn-info " role="button" aria-disabled="true">Tambah Data User</a>
                      <?php } ?>
                    </div>
                </div>
              	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
				  <div class="input-file-container">  
				    <input class="input-file" id="my-file" name="fileBerkas" type="file">
            <?php if ($_GET['act'] == "uploadbio"): ?>
            <label tabindex="0" for="my-file" class="input-file-trigger">Pilih file biodatamu disini..</label>
          <?php elseif($_GET['act'] == "uploadpernya"): ?>
            <label tabindex="0" for="my-file" class="input-file-trigger">Pilih file pernyataaan disini..</label>
          <?php elseif($_GET['act'] == "uploadizin"): ?>
            <label tabindex="0" for="my-file" class="input-file-trigger">Pilih file izin disini..</label>
          <?php elseif($_GET['act'] == "uploadfoto"): ?>
            <label tabindex="0" for="my-file" class="input-file-trigger">Pilih file foto disini..</label>
          <?php endif ?>
				    
				  </div>
				  <p class="file-return"></p>
				  <?php if ($_GET['act'] == "uploadbio"): ?>
				  	<button type="submit" name="simpanBiodata" class="btn btn-primary pull-right">Simpan</button>
          <?php elseif($_GET['act'] == "uploadpernya"): ?>
            <button type="submit" name="simpanPernyataan" class="btn btn-primary pull-right">Simpan</button>
          <?php elseif($_GET['act'] == "uploadizin"): ?>
            <button type="submit" name="simpanIzin" class="btn btn-primary pull-right">Simpan</button>
          <?php elseif($_GET['act'] == "uploadfoto"): ?>
            <button type="submit" name="simpanFoto" class="btn btn-primary pull-right">Simpan</button>
				  <?php endif ?>
				</form>
            </div>
          </div>

</div>