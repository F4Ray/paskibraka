<div class="container-fluid">
<?php if (isset($returnBarang)) {
  if ($returnBarang == true) {
?>
    <div class="alert alert-success" role="alert">
        Data berhasil disimpan, halaman data barang akan di load dalam 2 detik
    </div>
  <?php }}
    ?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title"> Data Return Barang</h4>
          <p class="card-category">Kumpulan koleksi data barang yang berada di costumer</p>
        </div>
        <div class="card-body mt-2">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Nomor</th>
                <th>Nama</th>
                <th>Stok</th>
                <!-- <th>Keterangan</th> -->
                <th>harga</th>
                <th style="width: 40%">Aksi</th>
              </thead>
              <tbody>
                <?php 
                  $data_barang = $db->ambilReturnBarang();
                  $no = 1;
                  if ($data_barang != null) {
                  
                  foreach ($data_barang as $row) {
                  
                 ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?=  $db->ambilDiluar($row['keterangan']); ?></td>
                  <!-- <td><?= $row['keterangan'] ?></td> -->
                  <td><?= $row['harga'] ?></td>
                  <td>
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal<?= $row['id']  ?>" <?php if($db->ambilDiluar($row['keterangan']) <= 0){ echo "disabled"; } ?>>
                    Return Barang
                  </button>
                  </td>
                </tr>
                <?php }} ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if ($data_barang != null) {
foreach($data_barang as $rowdua){ ?>
<div class="modal fade" id="exampleModal<?= $rowdua['id']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $rowdua['id']  ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Return Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="modal-body">
            <div class="row">
            <div class="col-12">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Apakah yakin ingin me-return barang ke toko ?</label>
                    </div> 
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="returnBarang" value="<?= $rowdua['id']  ?>"" class="btn btn-primary pull-right">Ya</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }} ?>