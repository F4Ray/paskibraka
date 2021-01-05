<div class="container-fluid">
<?php if (isset($editBarang)) {
  if ($editBarang == true) {
?>
    <div class="alert alert-success" role="alert">
        Data berhasil Diubah, halaman data user akan di load dalam 2 detik
    </div>
  <?php }}
    ?>
    <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Update Data Barang</h4>
          <p class="card-category">Silahkan edit data user</p>
        </div>
        <div class="card-body mt-2">
            <?php
            $data_user = $db->ambilUserFromId($_GET['id-user']);
            $no = 1;
            ?>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" autocomplete="off">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" class="form-control" name="namaUser" value="<?= $data_user['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Username</label>
                <input type="text" class="form-control" name="usernameUser" value="<?= $data_user['username']; ?>" disabled>
                <small class="text-info bold">username tidak dapat diubah</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <div class="input-group">
                  <input type="password" name="passwordUser" class="form-control" data-toggle="password" placeholder="••••••••" value="<?= $data_user['password']; ?>"> 
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
            </div>
            <button type="submit" name="updateUser" value="<?= $data_user['id']; ?>" class="btn btn-primary pull-right">Simpan</button>
            <a class="btn btn-danger" href="home.php?halaman=datauser">Kembali</a>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>