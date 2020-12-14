<?php 
class database{
 
	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "new_paskibraka";
	var $koneksi = "";
	   function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
		if (mysqli_connect_errno()){
			echo "Koneksi database gagal : " . mysqli_connect_error();
		}
	}
 
	// function tampil_data()
	// {
	// 	$data = mysqli_query($this->koneksi,"select * from barang");
	// 	while($row = mysqli_fetch_array($data)){
	// 		$hasil[] = $row;
	// 	}
	// 	return $hasil;
    // }

    function ambilHalaman($idhalaman)
    {

        $halaman = [ 
            'utama'=>'utama.php',
            'utama-admin'=>'utama-admin.php',
            'datauser'=>'dataUser.php',
            'tambahuser'=>'tambahuser.php',
            'edituser'=>'edituser.php',
            'returnbarang'=>'returnbarang.php',
            'transaksi'=>'transaksi.php'
        ];
       
        if (array_key_exists($idhalaman, $halaman)) {
            return $halaman[$idhalaman];
        }else
        {
            return false;
        }
    }

    //fungsi barang
    function incrementalHash($len = 5){
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $base = strlen($charset);
        $result = '';
    
        $now = explode(' ', microtime())[1];
        while ($now >= $base){
        $i = $now % $base;
        $result = $charset[$i] . $result;
        $now /= $base;
        }
        return substr($result, -5);
    }
    function simpanUser($nama,$usernameUser,$passwordUser,$aksesLevelUser){
        $nama = mysqli_real_escape_string($this->koneksi,$nama);
        $usernameUser = mysqli_real_escape_string($this->koneksi,$usernameUser);
        $passwordUser = mysqli_real_escape_string($this->koneksi,$passwordUser);
        $aksesLevelUser = mysqli_real_escape_string($this->koneksi,$aksesLevelUser);
        $query = "INSERT INTO tb_users VALUES(null,'$nama','$usernameUser','$passwordUser','$aksesLevelUser')";
        $sql = mysqli_query($this->koneksi,$query);
        if($sql == 1){
            return true;
        }
        else{
            return false;
        }
    }
    // simpanBarang("Tunikku tes tambah",330,30000,"sedang digudang",1,"sedang digudang");
    function ambilUser()
    {
        $query = "SELECT * FROM tb_users ORDER BY akses_level ASC";
        $sql = mysqli_query($this->koneksi,$query);
        while($row = mysqli_fetch_array($sql)){
			$hasil[] = $row;
		}
		return $hasil;
    }

    function ambilUserFromId($id)
    {
        $query = "SELECT * FROM tb_users WHERE id=$id";
        $sql = mysqli_query($this->koneksi,$query);
        $row = mysqli_fetch_array($sql);
		
		
		return $row;
    }
    function editUser($id,$nama,$password)
    {
        $id = mysqli_real_escape_string($this->koneksi,$id);
        $nama = mysqli_real_escape_string($this->koneksi,$nama);
        $password = mysqli_real_escape_string($this->koneksi,$password);
        $query = "UPDATE tb_users SET nama='$nama',password='$password' WHERE id=$id";
        $sql = mysqli_query($this->koneksi,$query);
        if($sql == true) {
            return true;
        }
        else{
            return false;
        }

    }
    function hapusUser($id)
    {
        $query = "DELETE FROM tb_users WHERE id=$id";
        $sql = mysqli_query($this->koneksi,$query);
        if($sql == true) {
            return true;
        }
        else{
            return false;
        }
    }
    function tfBarang($id,$jumlah,$iduser){
        $query = "SELECT qty,keterangan FROM barang WHERE id=$id";
        $sql = mysqli_query($this->koneksi,$query);
        $row = mysqli_fetch_array($sql);
        $jumlahHasil = $row['qty'] - $jumlah;
        if ($row['keterangan'] != null) {
            $jumlahDiluar = explode(" ",$row['keterangan']);
            $jumlahs = $jumlahDiluar[1]; 
            $jumlahJumlah = $jumlahs + $jumlah;
            $query2 = "UPDATE barang SET qty='$jumlahHasil',keterangan='diluar $jumlahJumlah' WHERE id=$id ";
        }else{
        $query2 = "UPDATE barang SET qty='$jumlahHasil',keterangan='diluar $jumlah' WHERE id=$id ";
        }
        $sql2 = mysqli_query($this->koneksi,$query2);
        $db = new database;
        $kode = "KELUAR-". $db->incrementalHash();
        $queryTransaksi = "INSERT INTO transaksi VALUES(null,'$kode','Keluar',$id,now(),$iduser,$jumlah)";
        $sqlTransaksi = mysqli_query($this->koneksi,$queryTransaksi);
        if($sql2 == true AND $sqlTransaksi) {
            return true;
        }
        else{
            return false;
        }
    }
    function ambilReturnBarang(){
        $query = "SELECT * FROM barang WHERE keterangan LIKE 'diluar%'";
        $sql = mysqli_query($this->koneksi,$query);
        if ($sql->num_rows == 0) {
            $hasil = null;
        }else{
            while($row = mysqli_fetch_array($sql)){
                $hasil[] = $row;
            }
        }
        return $hasil;
    }
    function ambilDiluar($string)
    {
        $jumlahDiluar = explode(" ",$string);
        $jumlahs = $jumlahDiluar[1]; 
        return $jumlahs;
    }
    function returnBarang($idBarang,$iduser)
    {
        $query = "SELECT qty,keterangan FROM barang WHERE id=$idBarang";
        $sql = mysqli_query($this->koneksi,$query);
        $row = mysqli_fetch_array($sql);
        $jumlahDiluar = explode(" ",$row['keterangan']);
        $jumlahs = $jumlahDiluar[1]; 
        $jumlahBarangDidalam = $row['qty'] + $jumlahs;
        $query2 = "UPDATE barang SET qty='$jumlahBarangDidalam',keterangan=null WHERE id=$idBarang ";
        $sql2 = mysqli_query($this->koneksi,$query2);
        $db = new database;
        $kode = "KELUAR-". $db->incrementalHash();
        $queryTransaksi = "INSERT INTO transaksi VALUES(null,'$kode','Return',$idBarang,now(),$iduser,$jumlahs)";
        $sqlTransaksi = mysqli_query($this->koneksi,$queryTransaksi);
        if($sql2 == true AND $sqlTransaksi) {
            return true;
        }
        else{
            return false;
        }
    }

    //fungsi transaksi
    function ambilTransaksi()
    {
        $query = "SELECT * FROM transaksi";
        $sql = mysqli_query($this->koneksi,$query);
        while($row = mysqli_fetch_array($sql)){
            $hasil[] = $row;
        }
        return $hasil;
    }
    function ambilBarangTransaksi($id)
    {
        $query = "SELECT * FROM barang WHERE id=$id";
        $sql = mysqli_query($this->koneksi,$query);
        $row = mysqli_fetch_array($sql);
        
        
        return $row;
    }
    function ambilUserTransaksi($id)
    {
        $query = "SELECT * FROM user WHERE id=$id";
        $sql = mysqli_query($this->koneksi,$query);
        $row = mysqli_fetch_array($sql);
        
        
        return $row['nama'];
    }
    function hitungApaAja($transaksi="semua")
    {
        if($transaksi == "semua"){
            $query = "SELECT * FROM transaksi";
        }else{
        $query = "SELECT * FROM transaksi WHERE jenis = '$transaksi'";
        }
        $sql = mysqli_query($this->koneksi,$query);
        return $sql->num_rows;
    }
    function hitungUser($user="semua")
    {
        if($user == "semua"){
            $query = "SELECT * FROM tb_users";
        }else{
        $query = "SELECT * FROM tb_users WHERE akses_level = $user";
        }
        $sql = mysqli_query($this->koneksi,$query);
        return $sql->num_rows;
    }

    //fungsi user
    function cekUniqueUsername($username)
    {
        $query = "SELECT * FROM tb_users WHERE username = '$username'";
        $sql = mysqli_query($this->koneksi,$query);
        if($sql->num_rows >= 1){
            return false;
        }
        else{
            return true;
        }
    }

    function daftarkan($nama, $username, $password)
    {
        $query = "INSERT INTO tb_users VALUES (null,'$nama','$username','$password','1')";
        $sql = mysqli_query($this->koneksi,$query);
        return $sql;
    }

    function loginkan($username, $password)
    {
        $query = "SELECT * FROM tb_users WHERE username = '$username' AND password= '$password'";
        $sql = mysqli_query($this->koneksi,$query);
        $row = mysqli_fetch_array($sql);

        if($sql->num_rows == 1){
            return true;
        }
        else{
            return false;
        }

        // if($sql->num_rows == 1){
        //     $userData = [true, $row['nama'], $row['username'],$row['akses_level']];
        //     var_dump($userData);
        // }
        // else{
        //     $userData = [false, $row['nama'], $row['username'],$row['akses_level']];
        //     var_dump($userData);
        // }

    }


    function ambilDataUser($username, $password)
    {
        $query = "SELECT * FROM tb_users WHERE username = '$username' AND password= '$password'";
        $sql = mysqli_query($this->koneksi,$query);
        
        $row = mysqli_fetch_array($sql);	
        return $row;

    }
   
    
    
}
$db = new database;
if (isset($_GET['logout'])) {
    if ($_GET['logout']== 'yes') {
        session_start();
        session_destroy();
        header("location:login/index.php");
    }
    
    // die();
}
if (isset($_GET['idhapus'])) {
    $db->hapusUser($_GET['idhapus']);
    header("Location: home.php?halaman=datauser");
    // die();
}
?>