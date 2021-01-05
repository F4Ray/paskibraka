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
            'berkas'=>'berkas.php',
            'upberkas'=>'upberkas.php',
            'peserta'=>'peserta.php'
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
    function ambilUser($user="semua")
    {
        if ($user == "semua") {
             $query = "SELECT * FROM tb_users ORDER BY akses_level ASC";
        }else{
             $query = "SELECT * FROM tb_users WHERE username='$user' ORDER BY akses_level ASC";
        }
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
        $queryHapusBerkas = "DELETE FROM tb_berkas WHERE id_user=$id";
        $sql = mysqli_query($this->koneksi,$query);
        $sqlHapusBerkas = mysqli_query($this->koneksi,$queryHapusBerkas);
        if($sql == true AND $sqlHapusBerkas) {
            return true;
        }
        else{
            return false;
        }
    }


    function luluskan($id)
    {
        $query = "UPDATE tb_users SET status='1' WHERE id=$id";
        $sql= mysqli_query($this->koneksi,$query);
        return $sql;
    }

    function tidakLuluskan($id)
    {
        $query = "UPDATE tb_users SET status='0' WHERE id=$id";
        $sql= mysqli_query($this->koneksi,$query);
        return $sql;
    }


    function ambilPeserta()
    {
        $query = "SELECT * FROM tb_berkas";
        $sql = mysqli_query($this->koneksi,$query);
        while($row = mysqli_fetch_array($sql)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    function ambilDiluar($string)
    {
        $jumlahDiluar = explode(" ",$string);
        $jumlahs = $jumlahDiluar[1]; 
        return $jumlahs;
    }

    function cekBerkas($id)
    {
        $query = "SELECT * FROM tb_berkas WHERE id_user=$id";
        $sql = mysqli_query($this->koneksi, $query);
        $row =  mysqli_fetch_array($sql);

        return $row;
    }

    function buatBerkas($berkasnya,$path,$id_user)
    {
        
        if ($berkasnya=="all") {
            $query = "INSERT INTO tb_berkas VALUES(null,null,null,null,null,$id_user)";
        }elseif ($berkasnya=="biodata") {
            $query = "UPDATE tb_berkas SET biodata='$path' WHERE id_user=$id_user";
        }elseif ($berkasnya=="pernyataan") {
            $query = "UPDATE tb_berkas SET pernyataan='$path' WHERE id_user=$id_user";
        }elseif ($berkasnya=="izin") {
            $query = "UPDATE tb_berkas SET izin='$path' WHERE id_user=$id_user";
        }elseif ($berkasnya=="foto") {
            $query = "UPDATE tb_berkas SET foto='$path' WHERE id_user=$id_user";
        }
        $sql = mysqli_query($this->koneksi,$query);
        return $sql;
    }

    function hapusBerkas($id_user,$berkasnya)
    {
        if ($berkasnya=="biodata") {
            $query = "UPDATE tb_berkas SET biodata=null WHERE id_user=$id_user";
        }elseif ($berkasnya=="pernyataan") {
            $query = "UPDATE tb_berkas SET pernyataan=null WHERE id_user=$id_user";
        }elseif ($berkasnya=="izin") {
            $query = "UPDATE tb_berkas SET izin=null WHERE id_user=$id_user";
        }elseif ($berkasnya=="foto") {
            $query = "UPDATE tb_berkas SET foto=null WHERE id_user=$id_user";
        }
        $sql = mysqli_query($this->koneksi,$query);
        return $sql;
    }

    function pindahkanFile($tempName,$name)
    {
        $array = explode('.', $name);
        $extension = end($array);
        $dirUpload = "userx/uploaded-docs/";
        $keyName = $_SESSION['username']."-".$this->random_string(4);
        $pathDb = $dirUpload.$keyName.".".$extension;
        $pindahkan = move_uploaded_file($tempName, $pathDb);
        $hasil = [$pindahkan,$pathDb];
        return $hasil;
    }

    function random_string($length) 
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
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
        $last_id = mysqli_insert_id($this->koneksi);
        $this->buatBerkas("all","null",$last_id);
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

if (isset($_GET['hapusdoc'])) {
    $db->hapusBerkas($_GET['hapusdoc'],$_GET['berkasnya']);
    header("Location: home.php?halaman=berkas");
}

if (isset($_GET['ganti-status'])) {
    if ($_GET['ganti-status'] == "lulus") {
        $db->luluskan($_GET['iduser']);
    }elseif ($_GET['ganti-status'] == "tidak-lulus") {
        $db->tidakLuluskan($_GET['iduser']);
    }
    header("Location: home.php?halaman=peserta");
}
?>