<?php 
/**
 * 
 */
class Database
{
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "db_kerusakan";
	
	function __construct()
	{
		$this->db = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
	}
	public function proses()
	{
		$d = new mysqli("localhost", "root", "", "db_kerusakan");
		return $d;
	}
	public function login($username, $password)
	{
		$query = mysqli_query($this->db, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
		$row = mysqli_fetch_array ($query);
		echo $username;
		if (mysqli_num_rows($query) == 1) {
				$_SESSION['status'] = $row['status'];
				if ($row['status'] == '1') {
		   			echo "<script>alert('Anda Berhasil Masuk'); window.location = '../admin/data_user.php'</script>";  
		    	}else if($row['status'] == '2'){
					echo "<script>alert('Anda Berhasil Masuk'); window.location = '../pakar/data_kerusakan.php'</script>";    		
		    	}else{
		    		$data = date('Y-m-d');
		    		// $insert = mysqli_query($this->db, "INSERT INTO riwayat_aplikasi VALUES ('', '$username', '$data')")or die(mysqli_error());
		    		$_SESSION['merk'] = $row['merk'];
		    		echo "<script>alert('Anda Berhasil Masuk'); window.location = '../pengguna/konsultasi.php'</script>";  
		    	}
			} else {
				echo "<script>alert('Gagal Login Daftar Terlebih Dahulu'); window.location = '../index.php'</script>";   
		}

	}
	
	// Hapus Data
	public function hapus_kerusakan($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM kerusakan WHERE kode_k = '$key'");
		$delete = mysqli_query($this->db, "DELETE FROM data_latih WHERE kode_k = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../pakar/data_kerusakan.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_kerusakan.php'</script>";
		}
	}

	public function hapus_gejala($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM gejala WHERE kode_g  = '$key'");
		$delete = mysqli_query($this->db, "DELETE FROM data_latih WHERE kode_g  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../pakar/data_gejala.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_gejala.php'</script>";	
		}
	}

	public function hapus_solusi($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM solusi WHERE kode_s  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../pakar/data_solusi.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_solusi.php'</script>";	
		}
	}

	public function hapus_riwayat_aplikasi($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM riwayat_aplikasi WHERE no  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../admin/riwayat_aplikasi.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_solusi.php'</script>";	
		}
	}

	public function hapus_komentar($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM komentar WHERE no  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../admin/data_komentar.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_solusi.php'</script>";	
		}
	}

	public function hapus_riwayat_konsultasi($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM riwayat_konsultasi WHERE no  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../admin/riwayat_kerusakan_pengguna.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_solusi.php'</script>";	
		}
	}

	public function hapus_riwayat_konsultasi_pakar($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM riwayat_konsultasi WHERE no  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../pakar/riwayat_kerusakan_pengguna.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_solusi.php'</script>";	
		}
	}

	public function hapus_data_pengguna($key)
	{
		$delete = mysqli_query($this->db, "DELETE FROM user WHERE username  = '$key'");
		$delete = mysqli_query($this->db, "DELETE FROM riwayat_konsultasi WHERE username  = '$key'");
		if ($delete) {
			echo "<script>alert('Data ".$key." Berhasil di Hapus'); window.location = '../admin/data_user.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../admin/data_user.php'</script>";	
		}
	}

	public function hapus_data_latih($key)
	{	
		$delete = mysqli_query($this->db, "DELETE FROM data_latih WHERE kode_l = '$key'");
		if ($delete) {
			echo "<script>alert('Data Latih ".$key." Berhasil di Hapus'); window.location = '../pakar/data_latih.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_latih.php'</script>";	
		}
	}
	// End Hapus Data
	
	// Edit Data
	public function edit_kerusakan($kode_k, $kerusakan)
	{
		$update = mysqli_query($this->db, "UPDATE kerusakan SET kerusakan = '$kerusakan' WHERE kode_k = '$kode_k'");
		if ($update) {
			echo "<script>alert('Data ".$kode_k." Berhasil di Edit'); window.location = '../pakar/data_kerusakan.php'</script>";
		}
	}

	public function edit_gejala($kode_g, $gejala)
	{
		$update = mysqli_query($this->db, "UPDATE gejala SET gejala = '$gejala' WHERE kode_g = '$kode_g'");
		if ($update) {
			echo "<script>alert('Data ".$kode_g." Berhasil di Edit'); window.location = '../pakar/data_gejala.php'</script>";
		}
	}

	public function edit_solusi($kode_k, $kode_s, $solusi)
	{
		$update = mysqli_query($this->db, "UPDATE solusi SET kode_k = '$kode_k', solusi = '$solusi' WHERE kode_s = '$kode_s'");
		if ($update) {
			echo "<script>alert('Data ".$kode_s." Berhasil di Edit'); window.location = '../pakar/data_solusi.php'</script>";
		}
	}

	public function edit_profil_pengguna($username, $nama, $merk)
	{
		$id = $_SESSION['username'];
		$update = mysqli_query($this->db, "UPDATE user SET username = '$username' , nama = '$nama' , merk = '$merk' WHERE username = '$id'");
		if ($update) {
			$_SESSION['username'] = $username;	
			echo "<script>alert('Data Berhasil di Edit'); window.location = '../pengguna/profil.php'</script>";
		}
	}

	public function edit_profil_pakar($username, $nama)
	{
		$id = $_SESSION['username'];
		$update = mysqli_query($this->db, "UPDATE user SET username = '$username' , nama = '$nama' WHERE username = '$id'");
		if ($update) {
			$_SESSION['username'] = $username;	
			echo "<script>alert('Data Berhasil di Edit'); window.location = '../pakar/profil.php'</script>";
		}
	}

	public function edit_password($username, $password)
	{
		$update = mysqli_query($this->db, "UPDATE user SET password = '$password' WHERE username = '$username'");
		if ($update) {
			echo "<script>alert('Data Berhasil di Edit'); window.location = '../pengguna/profil.php'</script>";
		}
	}

	public function riset_password($username, $password)
	{
		$update = mysqli_query($this->db, "UPDATE user SET password = '$password' WHERE username = '$username'");
		if ($update) {
			echo "<script>alert('Password Berhasil di Reset'); window.location = '../admin/data_user.php'</script>";
		}
	}

		public function edit_password_pakar($username, $password)
	{
		$update = mysqli_query($this->db, "UPDATE user SET password = '$password' WHERE username = '$username'");
		if ($update) {
			echo "<script>alert('Data Berhasil di Edit'); window.location = '../pakar/profil.php'</script>";
		}
	}

	public function edit_data_latih($id, $nilai)
	{
		for ($i=0; $i < count($nilai); $i++) {
			$update = mysqli_query($this->db, "UPDATE data_latih SET nilai_data_latih = '$nilai[$i]' WHERE no = '$id[$i]'");
		}
		if ($update) {
			echo "<script>alert('Data Berhasil di Edit'); window.location = '../pakar/data_latih.php'</script>";
		}
	}
	// End Edit Data

	// Input Data
	public function input_kerusakan($kode_k, $kerusakan)
	{
		$insert = mysqli_query($this->db, "INSERT INTO kerusakan VALUES ('$kode_k', '$kerusakan')")or die(mysqli_error());
		if ($insert) {
			echo "<script>alert('Data ".$kerusakan." Berhasil Tersimpan'); window.location = '../pakar/data_kerusakan.php'</script>";
		}else{
			echo "Gagal";
		}
	}

	public function input_gejala($kode_g, $gejala, $kode_urut, $kode_latih, $kode_kerusakan, $nilai_latih, $batas)
	{
		$insert = mysqli_query($this->db, "INSERT INTO gejala VALUES ('$kode_g', '$gejala')")or die(mysqli_error());
		for ($i=0; $i < $batas; $i++) { 
		// echo "(".$kode_g.")";
		mysqli_query($this->db, "INSERT INTO data_latih VALUES ('$kode_urut[$i]', '$kode_latih[$i]', '$kode_kerusakan[$i]', '$kode_g', '$nilai_latih[$i]')")or die(mysqli_error());
		}
		
		if ($insert) {
			echo "<script>alert('Data ".$gejala." Berhasil Tersimpan'); window.location = '../pakar/data_gejala.php'</script>";
		}else{
			echo "Gagal";
		}
	}

	public function input_data_latih($no ,$kode_l, $kode_k, $kode_g, $nilai)
	{
		for ($i=0; $i < count($kode_g); $i++) { 
			$insert = mysqli_query($this->db, "INSERT INTO data_latih VALUES ('$no[$i]', '$kode_l', '$kode_k', '$kode_g[$i]', '$nilai[$i]')")or die(mysqli_error());
		}
		if ($insert) {
			echo "<script>alert('Data Latih ".$kode_k." Berhasil Tersimpan'); window.location = '../pakar/data_latih.php'</script>";
		}else{
			echo "<script>alert('Menghapus Gagal. Sistem Bermasalah'); window.location = '../pakar/data_latih.php'</script>";
		}
	}

	public function input_komentar($username, $tgl, $komentar)
	{
		$insert = mysqli_query($this->db, "INSERT INTO komentar VALUES ('', '$username', '$tgl', '$komentar')")or die(mysqli_error());
		if ($insert) {
			echo "<script>alert('Terimakasih sudah memberi masukan kepada kami'); window.location = '../pengguna/masukan.php'</script>";
		}else{
			echo "Gagal";
		}
	}
	public function input_solusi($kodeSolusi, $kode_k, $solusi)
	{
		$insert = mysqli_query($this->db, "INSERT INTO solusi VALUES ('$kodeSolusi', '$kode_k', '$solusi')")or die(mysqli_error());
		if ($insert) {
			echo "<script>alert('Terimakasih sudah memberi masukan kepada kami'); window.location = '../pakar/data_solusi.php'</script>";
		}else{
			echo "Gagal";
		}
	}
	public function input_riwayat($username, $kode_k, $kode_g, $tgl)
	{		
			for ($i=0; $i < count($kode_g); $i++) { 
				$insert = mysqli_query($this->db, "INSERT INTO riwayat_konsultasi VALUES ('', '$username', '$kode_k[0]', '$kode_g[$i]', '$tgl')")or die(mysqli_error());
			}
	}

	public function daftar_pengguna($username, $nama, $merk, $password)
	{
		$insert = mysqli_query($this->db, "INSERT INTO user VALUES('$username', '$nama', '$merk', '3', '$password')")or die(mysqli_error());
		if ($insert) {
			$_SESSION['username'] = $username;
			$_SESSION['status'] = '3';
			echo "<script>alert('Terimakasih Sudah Daftar'); window.location = '../pengguna/konsultasi.php'</script>";
		}else{
			echo "Gagal";
		}
	}

	public function daftar_pakar($username, $nama, $status,$password)
	{
		$insert = mysqli_query($this->db, "INSERT INTO user VALUES ('$username', '$nama', '', '$status', '$password')")or die(mysqli_error());
		if ($insert) {
			echo "<script>alert('Daftar Pakar Berhasil'); window.location = '../admin/data_user.php'</script>";
		}else{
			echo "Gagal";
		}
	}
	// End Input Data
	
	// Tampilan Data
	public function tampil_konsultasi()
	{
		$query = mysqli_query($this->db, "SELECT * FROM gejala");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_gejala_no($id)
	{
		$query = mysqli_query($this->db, "SELECT * FROM gejala WHERE kode_g = '$id'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function cari_gejala($cari)
	{
		$query = mysqli_query($this->db, "SELECT * FROM gejala WHERE kode_g LIKE '%$cari%' OR gejala LIKE '%$cari%'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}


	public function tampil_kerusakan()
	{
		$query = mysqli_query($this->db, "SELECT * FROM kerusakan");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_kerusakan_no($id)
	{
		$query = mysqli_query($this->db, "SELECT * FROM kerusakan WHERE kode_k = '$id'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function cari_kerusakan($cari)
	{
		$query = mysqli_query($this->db, "SELECT * FROM kerusakan WHERE kode_k LIKE '%$cari%' OR kerusakan LIKE '%$cari%'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_data_latih()
	{
		$query = mysqli_query($this->db, "SELECT * FROM data_latih a, kerusakan b, gejala c WHERE b.kode_k = a.kode_k AND c.kode_g = a.kode_g ORDER BY kode_l ASC");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_data_latih_id($value)
	{
		$query = mysqli_query($this->db, "SELECT * FROM data_latih WHERE kode_l = '$value'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_solusi($value)
	{
		$query = mysqli_query($this->db, "SELECT * FROM solusi WHERE kode_k = '$value'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}
		return $data;
	}

	public function tampil_solusi_id($value)
	{
		$query = mysqli_query($this->db, "SELECT * FROM solusi a, kerusakan b WHERE a.kode_k = b.kode_k AND kode_s = '$value'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}
		return $data;
	}

	public function tampil_solusi_pakar()
	{
		$query = mysqli_query($this->db, "SELECT * FROM solusi a, kerusakan b WHERE a.kode_k = b.kode_k");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}
		return $data;
	}

	public function tampil_pakar()
	{
		$query = mysqli_query($this->db, "SELECT * FROM user WHERE status = '2'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_user()
	{
		$query = mysqli_query($this->db, "SELECT * FROM user");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public
	 function tampil_pakar_id($value)
	{
		$query = mysqli_query($this->db, "SELECT * FROM user WHERE username = '$value'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_riwayat_id($value)
	{
		$query = mysqli_query($this->db, "SELECT * FROM kerusakan b, riwayat_konsultasi c, user d, gejala e WHERE b.kode_k = c.kode_k AND e.kode_g = c.kode_g AND d.username = c.username AND c.username = '$value'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_riwayat()
	{
		$query = mysqli_query($this->db, "SELECT * FROM kerusakan b, riwayat_konsultasi c, user d, gejala e WHERE b.kode_k = c.kode_k AND e.kode_g = c.kode_g AND d.username = c.username ORDER BY c.username ASC");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function cek_password($value, $username)
	{
		$query = mysqli_query($this->db, "SELECT * FROM user WHERE password = '$value' AND username = '$username'");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_komentar()
	{
		$query = mysqli_query($this->db, "SELECT * FROM komentar");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}

	public function tampil_riwayat_aplikasi()
	{
		$query = mysqli_query($this->db, "SELECT * FROM riwayat_aplikasi");
		$data = array();

		while ($x = mysqli_fetch_array($query)) {
			$data[] = $x;
		}	
		return $data;
	}


}
  ?>