<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manajemen Data Peserta</h1>
          <p class="mb-4"><?php echo ($_SESSION['akses_level'] == '0') ? "Berikut adalah data berkas dari peserta yang sudah mendaftar. Dihalaman ini admin dapat melihat berkas yang telah di kumpulkan oleh peserta. Serta admin juga dapat meluluskan peserta yang memenuhi syarat." : "Dihalaman ini anda dapat mengubah data akun anda." ?></p>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th style="width: 5%">Nomor</th>
                        <th>Nama</th>
                        <th>Berkas Biodata</th>
                        <th>Berkas Pernyataan</th>
                        <th>Berkas Izin</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th style="width: 10%">Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Berkas Biodata</th>
                        <th>Berkas Pernyataan</th>
                        <th>Berkas Izin</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th style="width: 10%">Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                    if ($_SESSION['akses_level'] == '1') {
                      $data_user = $db->ambilUser($_SESSION['username']);
                    }
                    else{
                    $data_berkas = $db->ambilPeserta();
                    }
                    $no = 1;
                    foreach ($data_berkas as $row) {

                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $db->ambilUserFromId($row['id_user'])['nama'] ?></td>
                        <td><?= ($row['biodata'] == null) ? "Belum ada data" : "<a href='$row[biodata]' target='_blank'>Klik disini</a>"?></td>
                        <td><?= ($row['pernyataan'] == null) ? "Belum ada data" : "<a href='$row[pernyataan]' target='_blank'>Klik disini</a>"?></td>
                        <td><?= ($row['izin'] == null) ? "Belum ada data" : "<a href='$row[izin]' target='_blank'>Klik disini</a>"?></td>
                        <td><?= ($row['foto'] == null) ? "Belum ada foto" : '<a href="#" data-toggle="modal" data-target="#lihatModalFoto'.$db->ambilUserFromId($row['id_user'])['nama'].'">Lihat</a>'?></td>
                        <td>
                          <!-- <div class="text-success font-weight-bold text-xm">Lulus</div> -->
                          <?= ($db->ambilUserFromId($row['id_user'])['status'] == '0') ?  '<div class="text-danger font-weight-bold text-xm">Tidak Lulus</div>' : '<div class="text-success font-weight-bold text-xm">Lulus</div>'  ?>
                          <!-- <div class="text-danger font-weight-bold text-xm">Tidak Lulus</div> -->
                        </td>
                        <td>
                          <?php if ($db->ambilUserFromId($row['id_user'])['status'] == '0'): ?>
                          <a href="controller.php?ganti-status=lulus&iduser=<?= $row['id_user'] ?>" class="btn btn-sm btn-success " role="button" aria-disabled="true">Lulukan</a>  
                          <?php elseif($db->ambilUserFromId($row['id_user'])['status'] == '1'): ?>
                          <a href="controller.php?ganti-status=tidak-lulus&iduser=<?= $row['id_user'] ?>" class="btn btn-sm btn-danger " role="button" aria-disabled="true">Gagalkan</a>
                          <?php endif ?>

                        </td>
                    </tr>
                    <?php $no++;} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

</div>
<?php foreach ($data_berkas as $rowFoto): ?>
  

<div class="modal fade" id="lihatModalFoto<?= $db->ambilUserFromId($rowFoto['id_user'])['nama'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Foto Peserta</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="<?= $rowFoto['foto'] ?>" style="max-height: 100%; max-width: 100%; object-fit: contain; display: block;">
         </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>
<?php endforeach ?>