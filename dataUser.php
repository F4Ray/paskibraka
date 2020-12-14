<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manajemen Data User</h1>
          <p class="mb-4">Berikut adalah data peserta yang sudah mendaftar. Dihalaman ini admin dapat membuat, mengubah, serta menghapus data setiap user.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 pull-right">
                    <a href="home.php?halaman=tambahuser" class="btn btn-sm btn-info " role="button" aria-disabled="true">Tambah Data User</a>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Akses Level</th>
                        <th style="width: 40%">Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Akses Level</th>
                        <th style="width: 40%">Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                    $data_user = $db->ambilUser();
                    $no = 1;
                    foreach ($data_user as $row) {
                    
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= ($row['akses_level'] == "0") ? ("Admin") : ("Peserta");?></td>
                        <td>
                          <?php 
                          if ($row['akses_level'] == "0" AND ($row['nama'] != $_SESSION['nama'])) 
                          {
                            ?>
                            <button class="btn btn-sm btn-dark" role="button" aria-disabled="true" disabled>Tidak dapat mengubah data admin lain</button> 
                            <?php
                          }
                          else{ ?>
                          <a href="home.php?halaman=edituser&id-barang=<?= $row['id'] ?>" class="btn btn-sm btn-warning " role="button" aria-disabled="true">Edit</a> 
                          <?php if ($row['akses_level'] == '1') { ?>
                            <a href="#" data-toggle="modal"  class="btn btn-sm btn-danger " data-target="#logoutModal<?= $row['id'] ?>" disabled="true">Hapus</a>
                          <?php } ?>
                          
                        <?php } ?>
                        </td>
                    </tr>
                    <?php $no++;} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

</div>
<?php 
foreach($data_user as $rowtiga){ ?>
<div class="modal fade" id="logoutModal<?= $rowtiga['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol hapus apabila anda yakin ingin mengahapus <?= $rowtiga['nama'] ?> dari daftar barang ? </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="controller.php?idhapus=<?= $rowtiga['id'] ?>">Hapus</a>
        </div>
      </div>
    </div>
</div>
<?php } ?>