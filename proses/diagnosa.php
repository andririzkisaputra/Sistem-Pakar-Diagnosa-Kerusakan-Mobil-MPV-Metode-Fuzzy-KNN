<?php
if (empty($_POST['data_uji']) AND empty($_POST['lama']) AND empty($_POST['jarak'])) {
	echo "<script>alert('Pilih Gejala'); window.location = '../pengguna/konsultasi.php'</script>";
}else{
session_start();
$host = "localhost";
$uname = "root";
$pass = "";
$db = "db_kerusakan";

$db = mysqli_connect($host, $uname, $pass, $db);

$lama = $_POST['lama'];
$jarak_tempuh = $_POST['jarak'];
$data_uji = array_merge($_POST['data_uji']);

// tampil data latih
$tampil_data_latih = mysqli_query($db, "SELECT * FROM data_latih a, kerusakan b, gejala c WHERE b.kode_k = a.kode_k AND c.kode_g = a.kode_g ORDER BY no ASC");
while ($data = mysqli_fetch_array($tampil_data_latih)) {
	$data_latih[] = $data['nilai_data_latih'];
	$kode_kerusakan_latih[] = $data['kode_k'];
	$kode_gejala_latih[] = $data['kode_g'];	
	$kode_latih[] = $data['kode_l'];	
}

// tampil data gejala
$tampil_gejala = mysqli_query($db, "SELECT * FROM gejala");
while ($data = mysqli_fetch_array($tampil_gejala)) {
	$kode_gejala[] = $data['kode_g'];
	$gejala[] = $data['gejala'];
}

// tampil data kerusakan
$tampil_kerusakan = mysqli_query($db, "SELECT * FROM kerusakan");
while ($data = mysqli_fetch_array($tampil_kerusakan)) {
	$kode_kerusakan[] = $data['kode_k'];
}

// Memasukan nilai gejala lama pemakaian dan jarak tempuh mobil
for ($i=0; $i < 2; $i++) { 
	for ($j=0; $j < count($kode_gejala); $j++) { 
		if ($lama == $gejala[$j]) {
			@$gabung[$i] = $kode_gejala[$j];
			$lama = NULL;
			break;
		}elseif ($jarak_tempuh == $gejala[$j]) {
			@$gabung[$i] = $kode_gejala[$j];
			$jarak_tempuh = NULL;
			break;
		}
	}
}

// Cek jika data gabung tidak kosong
if (!empty(@$gabung)) {
	$data_uji = array_merge($data_uji, $gabung);
	// print_r($data_uji);
}
print_r($data_uji);
echo "<br>";
$no = 0;
$n = 0;
// Menghitung nilai data latih pada setiap gejala
echo "<br>Menghitung nilai data latih pada setiap gejala<br>";
for ($k=0; $k < count($kode_kerusakan); $k++) {
	for ($j=0; $j < count($data_uji); $j++) {
		$nomor = 0;
		$no = 0;
		for ($i=0; $i < count($kode_gejala_latih); $i++) {
			if ($kode_gejala_latih[$i] == $data_uji[$j] AND $kode_kerusakan_latih[$i] == $kode_kerusakan[$k]) {
				if ($data_latih[$i] == 1) {
					$nomor++;
					// echo $nomor."<br>";
				}
				$no++;
			}
		}
		echo "(".$kode_kerusakan[$k].") > (".$data_uji[$j].") Nilai = ";
		$nilai_awal[$k][$n] = @($nomor/$no);
		echo $nilai_awal[$k][$n]."<br>";
		$n++;
	}
}

// Memasukan nilai gejala yang sudah terhitung ke dalam setiap kerusakan
echo "<br>Memasukan nilai gejala yang sudah terhitung ke dalam setiap kerusakan<br>";
$no = 0;
$n = 0;
for ($i=0; $i < count($kode_kerusakan); $i++) { 
	for ($j=0; $j < count($kode_gejala); $j++) {
		for ($k=0; $k < count($data_uji); $k++) { 
			if ($kode_gejala[$j] == $data_uji[$k]) {
		 		$nilai[$no] = $nilai_awal[$i][$n];
		 		$n++;
				break;
			}else{
		 		$nilai[$no] = 0;
			}
		}
		echo " (".$nilai[$no].") ";
	$no++;
	}
		echo "<br>";

}

// Proses menghitung jarak dipangkat 2
echo "<br>Proses menghitung jarak dipangkat 2";
$no = 0;
$x = 0;
$index_kerusakan = 0;
$batas_data_latih = count($kode_latih)/count($kode_gejala); // Untuk menentukan batas
for ($i=0; $i < $batas_data_latih; $i++) {
	$key_kerusakan_latih[$i] = $kode_kerusakan_latih[$no];
	echo "<br>".$kode_kerusakan_latih[$no]."<br>";
	if ($kode_kerusakan_latih[$no] == $kode_kerusakan[$index_kerusakan]) {
	 	$batas_uji = $x;
	}else{
		$index_kerusakan++;
		$x = $batas_uji;
	} 
	for ($j=0; $j < count($kode_gejala); $j++) {
		$hasil_pangkat[$no]=pow($nilai[$batas_uji]-$data_latih[$no],2);
		echo " (".$hasil_pangkat[$no].") ";
		$no++;
		$batas_uji++;
	}
}

echo "<br>";
// Menjumlahkan jarak
echo "<br>Menjumlahkan jarak<br>";
$tambah = 0;
$no =0;
for ($i=0; $i < $batas_data_latih; $i++) {
	$tambah = 0;
	for ($j=0; $j < count($kode_gejala); $j++) { 
		$tambah = $tambah + $hasil_pangkat[$no];
		$jumlah_jarak[$i] = $tambah;
		$jumlah_jarak[$i] = sqrt($jumlah_jarak[$i]);
		$no++;
	}
	echo $key_kerusakan_latih[$i]." )".round($jumlah_jarak[$i],9)."<br>";
}

asort($jumlah_jarak);// Mengurutkan jarak terkecil sampai terbesar
$keys = array_keys($jumlah_jarak);// Mengambil index array dari jarak
// print_r($keys);
$k = 30;
// Menyimpan data jarak terkecil dan kelasnya
echo "<br>Menyimpan data jarak terkecil dan kelasnya<br>";
for ($i=0; $i < $k; $i++) { 
	for ($j=0; $j < $batas_data_latih; $j++) { 
		if ($keys[$i] == $j) {
			$kelas[$i] = $key_kerusakan_latih[$j];
			$jarak_terkecil[$i] = round($jumlah_jarak[$j],9);
			break;
		}
	}
	echo $kelas[$i]." )".$jarak_terkecil[$i]."<br>";

}

$keys = array_combine($kelas, $kelas);
$cek = array_values($keys);

// echo "<br>";
// print_r($kelas);

// Memberi nilai data anggota pada setiap kelas
echo "<br>Memberi nilai data anggota pada setiap kelas<br>";
for ($i=0; $i < count($cek); $i++) { 
	echo $cek[$i]."<br>";
	for ($j=0; $j < $k; $j++) { 
		echo $kelas[$j]." = ";
		if ($kelas[$j] == $cek[$i]) {
			$nilai_anggota[$i][$j] = 1;
		}else{
			$nilai_anggota[$i][$j] = 0;
		}
		echo $nilai_anggota[$i][$j]."<br>";
	}
	echo "<br>";
}

// Proses akhir menghitung nilai anggota
echo "Proses akhir menghitung nilai anggota<br>";
for ($i=0; $i < count($cek); $i++) {
	$total_kali_anggota = 0;
	$total_kali_jarak = 0;
	// echo "<br><br>".$cek[$i]."<br>"; 
	for ($j=0; $j < $k; $j++) {
			// Mengitung dengan nilai anggota
			$kali_anggota = ($nilai_anggota[$i][$j]*(pow($jarak_terkecil[$j],-2/2-1)));
			$total_kali_anggota = $total_kali_anggota+$kali_anggota;

			// Mengitung tanpa nilai anggota
			$kali_jarak = (pow($jarak_terkecil[$j],-2/2-1));
			$total_kali_jarak = $total_kali_jarak+$kali_jarak;
	}
	echo $cek[$i]."<br>".round($total_kali_anggota,9)." : ".round($total_kali_jarak,9)."<br>";
	$diagnosa[$i] = $total_kali_anggota/$total_kali_jarak; //Membagi
	echo "= ".round($diagnosa[$i], 9)."<br>";
}
$keys = array_combine($cek, $diagnosa);// Menggabungkan dua array
arsort($keys); // Mengurutkan array terbesar
$kerusakan = array_keys($keys); // Kerusakan dengan nilai terbesar
$hasil_diagnosa = array_values($keys); // hasil dengan nilai terbesar
// Menampilkan hasil
echo "<br>Menampilkan hasil dari hasil terbesar";
echo "<br>";
for ($i=0; $i < count($cek); $i++) { 
	echo $kerusakan[$i]."<br>"; 
	echo round($hasil_diagnosa[$i], 9)."<br>";
}

if ($diagnosa) {
	// require 'koneksi.php';
	// $db = new Database();
	// $_SESSION['kerusakan'] = $kerusakan;
	// $_SESSION['diagnosa'] = $hasil_diagnosa;
	// $db->input_riwayat($_SESSION['username'], $_SESSION['kerusakan'], $data_uji, date('Y-m-d'));
	// echo "<script>alert('Hasil diagnosa ditemukan'); window.location = '../pengguna/hasil_diagnosa.php'</script>";
}
}
 ?>