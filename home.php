<?php 

require_once('controller.php');
session_start();
$db = new database;
if($_SESSION['login'] != true){
  header("location:login/index.php");
}else{
$dataUser = $db->ambilDataUser($_SESSION['username'],$_SESSION['password']);
}
if (isset($_POST['simpanUser'])) {
    $nama = $_POST['namaUser'];
    $usernameUser = $_POST['usernameUser'];
    $passwordUser = $_POST['passwordUser'];
    $aksesLevelUser = $_POST['aksesLevelUser'];

    $cekUsername = $db->cekUniqueUsername($usernameUser);
    if ($cekUsername == true) 
    {
        $saveUser = $db->simpanUser($nama,$usernameUser,$passwordUser,$aksesLevelUser);
    }else{
        $saveUser = false;
        $reason = "username sudah digunakan";
    }
    if($saveUser == true){
      header("Refresh:2;url=home.php?halaman=datauser");}
    }
if (isset($_POST['updateUser'])) {
    $id = $_POST['updateUser'];
    $namaUser = $_POST['namaUser'];
    $passwordUser = $_POST['passwordUser'];
    $editBarang = $db->editUser($id,$namaUser,$passwordUser);
    if($editBarang == true){
        header("Refresh:2;url=home.php?halaman=datauser");}
    }
if (isset($_POST['tfBarang'])) {
    $id= $_POST['tfBarang'];
    $id_user = $dataUser['id'];
    $jumlah = intval($_POST['banyakBarang']);
    $tfBarang = $db->tfBarang($id,$jumlah,$id_user);
    if($tfBarang == true){
        header("Refresh:2;url=home.php?halaman=databarang");}
    }
if (isset($_POST['returnBarang'])) {
    $id= $_POST['returnBarang'];
    $id_user = $dataUser['id'];
    $returnBarang= $db->returnBarang($id,$id_user);
    if($returnBarang == true){
        header("Refresh:2;url=home.php?halaman=returnbarang");}
    }
if (isset($_POST['simpanBiodata'])) {
  $namaSementara = $_FILES['fileBerkas']['tmp_name'];
  $namaFile = $_FILES['fileBerkas']['name'];
  $pindah = $db->pindahkanFile($namaSementara,$namaFile);
  if ($pindah[0] == true) {
    $uploadkan = $db->buatBerkas("biodata",$pindah[1],$_SESSION['id']);
    // var_dump($uploadkan);
    if ($uploadkan == true) {
      header("Refresh:2;url=home.php?halaman=berkas");
    }else{
      var_dump($uploadkan);
    }

  }
}
if (isset($_POST['simpanPernyataan'])) {
  $namaSementara = $_FILES['fileBerkas']['tmp_name'];
  $namaFile = $_FILES['fileBerkas']['name'];
  $pindah = $db->pindahkanFile($namaSementara,$namaFile);
  if ($pindah[0] == true) {
    $uploadkan = $db->buatBerkas("pernyataan",$pindah[1],$_SESSION['id']);
    // var_dump($uploadkan);
    if ($uploadkan == true) {
      header("Refresh:2;url=home.php?halaman=berkas");
    }else{
      var_dump($uploadkan);
    }

  }
}
if (isset($_POST['simpanIzin'])) {
  $namaSementara = $_FILES['fileBerkas']['tmp_name'];
  $namaFile = $_FILES['fileBerkas']['name'];
  $pindah = $db->pindahkanFile($namaSementara,$namaFile);
  if ($pindah[0] == true) {
    $uploadkan = $db->buatBerkas("izin",$pindah[1],$_SESSION['id']);
    // var_dump($uploadkan);
    if ($uploadkan == true) {
      header("Refresh:2;url=home.php?halaman=berkas");
    }else{
      var_dump($uploadkan);
    }

  }
}
if (isset($_POST['simpanFoto'])) {
  $namaSementara = $_FILES['fileBerkas']['tmp_name'];
  $namaFile = $_FILES['fileBerkas']['name'];
  $pindah = $db->pindahkanFile($namaSementara,$namaFile);
  if ($pindah[0] == true) {
    $uploadkan = $db->buatBerkas("foto",$pindah[1],$_SESSION['id']);
    // var_dump($uploadkan);
    if ($uploadkan == true) {
      header("Refresh:2;url=home.php?halaman=berkas");
    }else{
      var_dump($uploadkan);
    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gadget Hijau Klorofil</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" 
      href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" 
      integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" 
      crossorigin="anonymous">

  <?php if ($_GET['halaman']=="upberkas") {?>
  <link rel="stylesheet" type="text/css" href="css/cssfileupload.css">
  <?php } ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php 
        if (!$_GET) {
         ?>
         <div class="container-fluid">

<!-- 404 Error Text -->
<div class="text-center">
  <div class="error mx-auto" data-text="404">404</div>
  <p class="lead text-gray-800 mb-5">Page Not Found</p>
  <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
  <a href="home.php?halaman=utama">&larr; Back to Dashboard</a>
</div>

</div>
        <?php die();}
        ?>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php?halaman=utama">
        
        <div class="sidebar-brand-text mx-3">Gadget Hijau Klorofil</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if($_GET['halaman'] == 'utama'){echo 'active';} ?>">
        <a class="nav-link" href="home.php?halaman=utama-admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item <?php if($_GET['halaman'] == 'datauser' || $_GET['halaman'] == 'tambahuser' || $_GET['halaman'] == 'edituser'){echo 'active';} ?> ">
        <a class="nav-link" href="home.php?halaman=datauser">
          <i class="fas fa-fw fa-table"></i>
          <span><?php echo($_SESSION['akses_level'] == "0") ? "Manajemen Data User" : "Manajemen Akun" ?></span></a>
      </li>

      <?php if ($_SESSION['akses_level'] == "1") { ?>
      <li class="nav-item <?php if($_GET['halaman'] == 'berkas'){echo 'active';} ?>">
        <a class="nav-link" href="home.php?halaman=berkas">
          <i class="fas fa-fw fa-cart-plus"></i>
          <span>Manajemen Berkas</span></a>
      </li>
      <?php } ?>

      <?php if ($_SESSION['akses_level'] == "0") { ?>
      <li class="nav-item <?php if($_GET['halaman'] == 'peserta'){echo 'active';} ?>">
        <a class="nav-link" href="home.php?halaman=peserta">
          <i class="fas fa-fw fa-cart-plus"></i>
          <span>Manajemen Peserta</span></a>
      </li>
      <?php } ?>
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $dataUser['nama'] ?></span>
                <img class="img-profile rounded-circle" src="img/icons8-customer-96.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
       
        <!-- /.container-fluid -->
        <?php 
        
        if(isset($_GET['halaman'])){
            $db = new database;
            $cek= $db->ambilHalaman($_GET['halaman']);
            if ($cek != false) {
                include($db->ambilHalaman($_GET['halaman']));
            }else{
                echo "404 page not found";
            }
        }else{
            echo "404 page not found";
        }
        ?> 
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Make with ❤  by Fauzan & Fadhil 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol logout jika anda yakin untuk keluar dari aplikasi dan menghapus sesi login anda.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="controller.php?logout=yes">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
  </script>
  <script  src="js/bootstrap-show-password.min.js"></script>
  <?php if ($_GET['halaman']=="upberkas") {?>
  <script  src="js/jsformupload.js"></script>
  <?php } ?>

</body>

</html>
