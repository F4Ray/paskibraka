
<div class="container-fluid">
<?php if (isset($saveUser)) {
  if ($saveUser == true) {
?>
    <div class="alert alert-success" role="alert">
        Data berhasil ditambahkan, halaman data barang akan di load dalam 3 detik
    </div>
  <?php }else{
    if (isset($reason)) { ?>
      <div class="alert alert-danger" role="alert">
        Data user gagal ditambahkan, Username sudah dimiliki oleh user lain
      </div>
    <?php }
  }
}
    ?>
    <div class="row">
    <div class="col-md-12">
      <h1 class="h3 mb-2 text-gray-800">Tambah Data User </h1>
          <p class="mb-4">Dihalaman ini admin dapat menambahkan user.</p>
      <div class="card">
        <div class="card-header card-header-primary">
          <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body mt-2">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off">
            <div class="form-group">
                <label for="namaBarang">Nama</label>
                <input type="text" class="form-control" name="namaUser" placeholder="Andi">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Username</label>
                <input type="text" class="form-control" name="usernameUser" placeholder="andi">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <div class="input-group">
                  <input type="password" name="passwordUser" class="form-control" data-toggle="password" placeholder="••••••••">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Akses Level</label>
              <select class="form-control" name="aksesLevelUser" >
                <option hidden>Pilih Akses Level</option>
                <option value="0">Admin</option>
                <option value="1">Customer</option>
              </select>
            </div>
            <button type="submit" name="simpanUser" class="btn btn-primary pull-right">Simpan</button>
            <a class="btn btn-danger" href="home.php?halaman=datauser">Kembali</a>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>