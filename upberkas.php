<div class="container-fluid">
<?php if (isset($editBarang)) {
  if ($editBarang == true) {
?>
    <div class="alert alert-success" role="alert">
        Data berhasil Diubah, halaman data barang akan di load dalam 2 detik
    </div>
  <?php }}
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
				    <input class="input-file" id="my-file" name="fileBiodata" type="file">
				    <label tabindex="0" for="my-file" class="input-file-trigger">Pilih file biodatamu disini..</label>
				  </div>
				  <p class="file-return"></p>
				  <button type="submit" name="simpanBiodata" class="btn btn-primary pull-right">Simpan</button>
				</form>
            </div>
          </div>

</div>