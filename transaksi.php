<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title"> Data Barang</h4>
          <p class="card-category">Kumpulan koleksi data barang</p>
        </div>
        <div class="card-body mt-2">
          <div class="row">
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Nomor</th>
                <th>Kode Transaksi</th>
                <th>Jenis</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Waktu Transaksi</th>
                <th>Kasir</th>
                <th>Detail Transaksi</th>
                
              </thead>
              <tbody>
                <?php 
                  $data_barang = $db->ambilTransaksi();
                  $no = 1;
                  foreach ($data_barang as $row) {
                    $phpdate = strtotime( $row['waktu']  );
                    $myFormatForView = date("m/d/y g:i A", $phpdate);
                    $barangnya = $db->ambilBarangTransaksi($row['id_barang']);
                  
                 ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $row['kode_transaksi'] ?></td>
                  <td><?= $row['jenis'] ?></td>
                  <td><?= $barangnya['nama']  ?> 
                  </td>
                  <td><?= $row['banyak_barang']  ?> 
                  </td>
                  <td><?= $myFormatForView ?></td>
                  <td><?=  $db->ambilUserTransaksi($row['id_user']) ?></td>
                  <td><a href="invoice.php?nama=<?= $barangnya['nama']  ?>&harga=<?= $barangnya['harga']  ?>&jumlah=<?= $row['banyak_barang']  ?>&namakasir=<?=  $db->ambilUserTransaksi($row['id_user']) ?>&tanggal=<?= $myFormatForView ?>&kode=<?= $row['kode_transaksi'] ?>&jenis=<?= $row['jenis'] ?>">Lihat Kwintansi</a></td>
                </tr>
                <?php $no++; } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
