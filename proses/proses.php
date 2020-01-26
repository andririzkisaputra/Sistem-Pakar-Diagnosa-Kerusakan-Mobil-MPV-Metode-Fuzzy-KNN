<?php 
require 'koneksi.php';
$db = new Database();
$mysqli = $db->proses();
session_start();

if (isset($_POST['login'])) {//Proses Login

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) && empty($password)) {
			echo "<script>alert('Username dan Password Kosong'); window.location = '../index.php'</script>";
	}else if (empty($username)) {
			echo "<script>alert('Username Kosong'); window.location = '../index.php'</script>";
	}else if (empty($password)) {
			echo "<script>alert('Password Kosong'); window.location = '../index.php'</script>";
	}else{
		$_SESSION['username'] = $username; 
		$_SESSION['password'] = $password;
		$db->login($username, md5($password));
	}

	

}elseif(isset($_GET['logout'])){//Proses Logout

	session_destroy();	
    echo "<script>alert('Anda telah berhasil keluar.'); window.location = '../index.php'</script>";

}elseif(isset($_GET['hapus_kerusakan'])){//Proses Hapus Data Kerusakan

	$key = $_GET['no'];
	$db->hapus_kerusakan($key);

}elseif(isset($_GET['hapus_gejala'])){//Proses Hapus Data Penyeabab

	$key = $_GET['no'];
	$db->hapus_gejala($key);

}elseif(isset($_GET['hapus_solusi'])){//Proses Hapus Data Penyeabab

	$key = $_GET['no'];
	$db->hapus_solusi($key);

}elseif(isset($_GET['hapus_data_pengguna'])){//Proses Hapus Data Penyeabab

	$key = $_GET['no'];
	$db->hapus_data_pengguna($key);

}elseif(isset($_GET['hapus_riwayat_aplikasi'])){//Proses Hapus Data Riwayat Aplikasi

	$key = $_GET['no'];
	$db->hapus_riwayat_aplikasi($key);

}elseif(isset($_GET['hapus_riwayat_konsultasi']) || isset($_GET['hapus_riwayat_konsultasi_pakar'])){//Proses Hapus Data Riwayat Konsultasi

	$key = $_GET['no'];
	if (isset($_GET['hapus_riwayat_konsultasi'])) {
		$db->hapus_riwayat_konsultasi($key);
	}else{
		$db->hapus_riwayat_konsultasi_pakar($key);
	}

}elseif(isset($_GET['hapus_komentar'])){//Proses Hapus Data Komentar

	$key = $_GET['no'];
	$db->hapus_komentar($key);

}elseif(isset($_POST['hapus_data_latih'])){//Proses Hapus Data Latih

	$key = $_POST['kerusakan'];
	if ($key == 'Tidak Pilih') {
		echo "<script>alert('Pilih Kode Data Latih Terlebih Dahulu'); window.location = '../pakar/data_latih.php'</script>";
	}else{
		$db->hapus_data_latih($key);
	}

}elseif(isset($_POST['edit_kerusakan'])){//Proses Edit Data Kerusakan

	$kode_k = $_POST['kode_k'];
	$kerusakan = ucfirst($_POST['kerusakan']);

	// Cek Kerusakan
	$query = mysqli_query($mysqli, "SELECT kerusakan FROM kerusakan WHERE kerusakan = '$kerusakan'");

	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Data kerusakan sudah ada, Masukan data yang berbeda'); window.location = '../pakar/edit/edit_kerusakan.php?no=$kode_k'</script>";
	}else{
		$db->edit_kerusakan($kode_k, $kerusakan);
	}

}elseif(isset($_POST['edit_solusi'])){//Proses Edit Data Solusi

	$kode_s = $_POST['kode_s'];
	$kode_k = $_POST['kode_k'];
	$solusi = ucfirst($_POST['solusi']);

	// Cek Solusi
	$query = mysqli_query($mysqli, "SELECT * FROM solusi WHERE kode_k = '$kode_k' AND solusi = '$solusi'");

	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Data solusi sudah ada, Masukan data yang berbeda'); window.location = '../pakar/edit/edit_solusi.php?no=$kode_s'</script>";
	}else{
		$db->edit_solusi($kode_k, $kode_s, $solusi);
	}

}elseif(isset($_POST['edit_password'])){//Proses Edit Data Password

	$username = $_SESSION['username'];
	$password = $_POST['password'];


	if (empty($password)) {
		echo "<script>alert('Password Kosong'); window.location = '../pengguna/edit/ubah_password.php'</script>";
	}else{
		$_SESSION['password'] = $password;
		$db->edit_password($username, md5($password));
	}

}elseif(isset($_GET['riset_data_pengguna'])){//Proses Edit Data Password

	$username = $_GET['username'];
	$password = $username;

	$db->riset_password($username, md5($password));

}elseif(isset($_POST['edit_password_pakar'])){//Proses Edit Data Password

	$username = $_SESSION['username'];
	$password = $_POST['password'];


	if (empty($password)) {
		echo "<script>alert('Password Kosong'); window.location = '../pengguna/edit/ubah_password.php'</script>";
	}else{
		$_SESSION['password'] = $password;
		$db->edit_password_pakar($username, md5($password));
	}

}elseif(isset($_POST['edit_profil_pengguna'])){//Proses Edit Data Profil

	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$merk = $_POST['merk'];
	$password = $_POST['password'];

	if (empty($password) OR empty($nama) OR empty($merk) OR empty($username)) {
		echo "<script>alert('Form Input Masih Ada Yang Kosong'); window.location = '../pengguna/edit/ubah_profil.php'</script>";
	}else{
		$cek_password = $db->cek_password(md5($password), $_SESSION['username']);
		if ($cek_password) {
			$db->edit_profil_pengguna($username, $nama, $merk);
		}else{
			echo "<script>alert('Password Salah'); window.location = '../pengguna/edit/ubah_profil.php'</script>";	
		}
		// $db->edit_password($username, md5($password));
	}

}elseif(isset($_POST['edit_profil_pakar'])){//Proses Edit Data Profil

	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$password = $_POST['password'];

	if (empty($password) OR empty($nama) OR empty($username)) {
		echo "<script>alert('Form Input Masih Ada Yang Kosong'); window.location = '../pakar/edit/ubah_profil.php'</script>";
	}else{
		$cek_password = $db->cek_password(md5($password), $_SESSION['username']);
		if ($cek_password) {
			$db->edit_profil_pakar($username, $nama);
		}else{
			echo "<script>alert('Password Salah'); window.location = '../pakar/edit/ubah_profil.php'</script>";	
		}
		// $db->edit_password($username, md5($password));
	}

}elseif(isset($_POST['edit_data_latih'])){//Proses Edit Data Latih

	$kode = $_POST['kerusakan'];
	$gejala = $_POST['gejala'];
		
	$tampil_gejala = $db->tampil_konsultasi();
	foreach ($tampil_gejala as $key => $value) {
		$kode_gejala[] = $value['kode_g'];
	}

	$tampil_latih = $db->tampil_data_latih_id($kode);
	foreach ($tampil_latih as $key => $value) {
		$id[] = $value['no'];
	}

	$no = 0;
	for ($i=0; $i < count($kode_gejala); $i++) { 
		$kode_latih[$i] = $kode;
		for ($j=0; $j < count($gejala); $j++) { 
			if ($kode_gejala[$i] == $gejala[$j]) {
				$nilai[$i] = 1;
				break;
			}else{
				$nilai[$i] = 0;
			}
		}
		$noUrut[$i] = $no;
		$no++;
	}
	$db->edit_data_latih($id, $nilai);
}elseif(isset($_POST['edit_gejala'])){//Proses Edit Data gejala

	$kode_g = $_POST['kode_g'];
	$gejala = ucfirst($_POST['gejala']);

	// Cek Kerusakan
	$query = mysqli_query($mysqli, "SELECT gejala FROM gejala WHERE gejala = '$gejala'");

	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Data gejala sudah ada, Masukan data yang berbeda'); window.location = '../pakar/edit/edit_gejala.php?no=$kode_g'</script>";
	}else{
		$db->edit_gejala($kode_g, $gejala);
	}

}elseif(isset($_POST['simpan_kerusakan'])){//Proses Simpan Data Kerusakan

	//membaca kode kerusakan terbesar
	$sql = mysqli_query($mysqli, "SELECT max(kode_k) FROM kerusakan");
	$kode_faktur = mysqli_fetch_array($sql);
 	
	if($kode_faktur){
		$nilai = substr($kode_faktur[0], 1);
		$kode = (int) $nilai;
		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "K" .str_pad($kode, 2, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "K01";
	}

	// Cek Kerusakan
	$kerusakan = ucfirst($_POST['kerusakan']);
	$query = mysqli_query($mysqli, "SELECT kerusakan FROM kerusakan WHERE kerusakan = '$kerusakan'");

	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Data kerusakan sudah ada, Masukan data yang berbeda'); window.location = '../pakar/data_kerusakan.php'</script>";
	}else{
		$db->input_kerusakan($auto_kode, $kerusakan);
	}

}elseif(isset($_POST['simpan_solusi'])){//Proses Simpan Data Solusi

	//membaca kode solusi terbesar
	$sql = mysqli_query($mysqli, "SELECT max(kode_s) FROM solusi");
	$kode_faktur = mysqli_fetch_array($sql);
 	
	if($kode_faktur){
		$nilai = substr($kode_faktur[0], 1);
		$kode = (int) $nilai;
		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "S" .str_pad($kode, 2, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "S01";
	}

	// Cek Kerusakan
	$kode_k = $_POST['kode_k'];
	$solusi = ucfirst($_POST['solusi']);
	$query = mysqli_query($mysqli, "SELECT * FROM solusi WHERE kode_k = '$kode_k' AND solusi = '$solusi'");

	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Data solusi pada kerusakan sudah ada, Masukan data yang berbeda'); window.location = '../pakar/data_solusi.php'</script>";
	}else{
		// echo $auto_kode;
		$db->input_solusi($auto_kode, $kode_k, $solusi);
	}

}elseif(isset($_POST['simpan_gejala'])){//Proses Simpan Data Gejala

	//membaca kode gejala terbesar
	$sql = mysqli_query($mysqli, "SELECT max(kode_g) FROM gejala");
	$kode_faktur = mysqli_fetch_array($sql);
 	
	if($kode_faktur){
		$nilai = substr($kode_faktur[0], 1);
		$kode = (int) $nilai;
		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "G" .str_pad($kode, 2, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "G01";
	}
	
	// Cek Kerusakan
	$gejala = ucfirst($_POST['gejala']);//huruf besar
	$query = mysqli_query($mysqli, "SELECT gejala FROM gejala WHERE gejala = '$gejala'");

	$sql = mysqli_query($mysqli, "SELECT min(kode_l) FROM data_latih");
	$kode_faktur = mysqli_fetch_array($sql);

 	// Memberikan no urut dan no data_latih
	$query_urut = mysqli_query($mysqli, "SELECT no FROM data_latih ORDER BY no ASC");
	$data = array();
	while ($x = mysqli_fetch_array($query_urut)) {
		$data[] = $x;
	}

	$no = 1;
	foreach ($data as $value) {
		if ($value['no'] == $no) {
			$no = $no+1;
		}else{
			break;
		}
	}

	$tampil_latih = $db->tampil_data_latih();
	foreach ($tampil_latih as $key => $value) {
		$kode_k[] = $value['kode_k'];
	}
	$tampil_gejala = $db->tampil_konsultasi();
	$batas = count($tampil_latih)/count($tampil_gejala);
	// Memberikan nilai otomatis pada variabel kode_l, nilai_data_latih, dan no
	$nomor = 0;
	for ($i=0; $i < $batas; $i++) { 
		$nilai = substr($kode_faktur[0], 3);
		$kode = (int) $nilai;
		//tambahkan sebanyak + 1
		$kode = $kode + $i;
		$kode_latih[$i] = "DL" .str_pad($kode, 3, "0",  STR_PAD_LEFT);
		$kode_urut[$i] = $no+$i;
		$nilai_latih[$i] = 0;
		$kode_kerusakan[$i] = $kode_k[$nomor];
		$nomor = $nomor+count($tampil_gejala);

	}
	// print_r($kode_kerusakan);
	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Data gejala sudah ada, Masukan data yang berbeda'); window.location = '../pakar/data_gejala.php'</script>";
	}else{
		$db->input_gejala($auto_kode, $gejala, $kode_urut, $kode_latih, $kode_kerusakan, $nilai_latih, $batas);
	}

}elseif(isset($_POST['simpan_komentar'])){//Proses Simpan Data Komentar

	$komentar = $_POST['komentar'];
	$db->input_komentar($_SESSION['username'], date('Y-m-d'), $komentar);

}elseif(isset($_POST['daftar'])){//Proses Simpan Data Daftar
	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$merk = $_POST['merk'];
	$password = $_POST['password'];
	$query = mysqli_query($mysqli, "SELECT username FROM user WHERE username = '$username' AND status = '3'");
	if (mysqli_num_rows($query) == 1) {
		echo "<script>alert('Username Sudah Ada Yang Punya'); window.location = '../daftar.php'</script>";
	}else{
		$_SESSION['password'] = $password;
		$db->daftar_pengguna($username, $nama, $merk, md5($password));
	}

}elseif(isset($_POST['simpan_pakar'])){//Proses Simpan Data Pakar
	$status = '2';
	$sql = mysqli_query($mysqli, "SELECT max(username) FROM user WHERE status = '$status'");
	$kode_faktur = mysqli_fetch_array($sql);
 	
	if($kode_faktur){
		$nilai = substr($kode_faktur[0], 7);
		$kode = (int) $nilai;
		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "pakar_" .str_pad($kode, 3, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "pakar_001";
	}
	$nama = $_POST['pakar'];
	$password = $auto_kode;
	$db->daftar_pakar($auto_kode, $nama, $status, md5($password));


}elseif(isset($_POST['simpan_data_latih'])){//Proses Simpan Data Latih

	//membaca kode data_latih terbesar
	$sql = mysqli_query($mysqli, "SELECT max(kode_l) FROM data_latih");
	$kode_faktur = mysqli_fetch_array($sql);
 	
	if($kode_faktur){
		$nilai = substr($kode_faktur[0], 3);
		$kode = (int) $nilai;
		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "DL" .str_pad($kode, 3, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "DL001";
	}

	// Memberikan no urut dan no data_latih
	$query = mysqli_query($mysqli, "SELECT no FROM data_latih ORDER BY no ASC");
	$data = array();
	while ($x = mysqli_fetch_array($query)) {
		$data[] = $x;
	}

	$no = 1;
	foreach ($data as $value) {
		if ($value['no'] == $no) {
			$no = $no+1;
		}else{
			break;
		}
	}

	$kerusakan = $_POST['kerusakan'];
	$gejala = $_POST['gejala'];

	$tampil_gejala = $db->tampil_konsultasi();
	foreach ($tampil_gejala as $key => $value) {
		$kode_gejala[] = $value['kode_g'];
	}

	for ($i=0; $i < count($kode_gejala); $i++) { 
		for ($j=0; $j < count($gejala); $j++) { 
			if ($kode_gejala[$i] == $gejala[$j]) {
				$nilai[$i] = 1;
				break;
			}else{
				$nilai[$i] = 0;
			}
		}
		$noUrut[$i] = $no;
		$no++;
	}
	echo $auto_kode;
	$db->input_data_latih($noUrut, $auto_kode, $kerusakan, $kode_gejala, $nilai);
}else{
	echo "Gagal Proses";
}

 ?>