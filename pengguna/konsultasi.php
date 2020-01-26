<?php 
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '2' || $_SESSION['status'] == '1'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../index.php'</script>";
}else
error_reporting(0);
require '../proses/koneksi.php';
$db = new Database();
$konsultasi = $db->tampil_konsultasi();
$tampil_user = $db->tampil_pakar_id($_SESSION['username']);
foreach ($tampil_user as $key => $value) {
  $_SESSION['nama'] = $value['nama'];
  $_SESSION['merk'] = $value['merk'];
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEM PAKAR</title>
  <link href="../tampilan/css/bootstrap.min.css" rel="stylesheet">
  <link href="../tampilan/css/font-awesome.min.css" rel="stylesheet">
  <link href="../tampilan/css/datepicker3.css" rel="stylesheet">
  <link href="../tampilan/css/styles.css" rel="stylesheet">
  <!-- CSS Tabel -->
  <link href="../tampilan/tables/jquery.dataTables.min.css" rel="stylesheet">
  <!--Custom Font-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!-- Header -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span></button>
        <a class="navbar-brand" href="#"><b>Diagnosa Mobil <span>MPV</span></a></b>
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle count-info" href="profil.php"><em class="fa fa-address-card"></em></a>
          </li>
        </ul>
      </div>
    </div><!-- /.container-fluid -->
  </nav>
  <!-- End Header -->
  <!-- Menu -->
  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
      <div class="profile-userpic">
        <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
      </div>
      <div class="profile-usertitle">
        <div class="profile-usertitle-name"><b><?php echo $_SESSION['nama']; ?></b></div>
        <div class="profile-usertitle-status"><span class="indicator label-success"></span><b>HI! Pengguna</b></div>
      </div>
      <div class="clear"></div>
    </div>
    <ul class="nav menu">
      <li class="active"><a href="konsultasi.php"><em class="fa fa-calendar">&nbsp;</em> Konsultasi</a></li>
      <li><a href="riwayat.php"><em class="fa fa-clone">&nbsp;</em> Riwayat Konsultasi</a></li>
      <li><a href="masukan.php"><em class="fa fa-clone">&nbsp;</em> Komentar</a></li>
      <li><a href="../proses/proses.php?&logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
  </div><!--/.sidebar-->
  <!-- End Menu -->

   <!-- Isi -->
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="http://localhost/sistem_pakar/pengguna">
          <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Konsultasi</li>
      </ol>
    </div><!--/.row-->
    <!-- Isi -->
    <div>
        <h3><b>Pilih Gejala Yang Di Alami</b></h3>
        <form method="post" action="../proses/diagnosa.php">
        <div class="form-group">
          <label for="sel1">Lama Pemakaian Mobil :</label>
          <select class="form-control" name="lama">
            <option value="">Pilih Lama Pemakaian</option>
            <option value="1 tahun">1 Tahun</option>
            <option value="2 tahun">2 Tahun</option>
            <option value="3 tahun">3 Tahun</option>
            <option value="4 tahun">4 Tahun</option>
            <option value="5 tahun">5 Tahun</option>
            <option value="6 tahun">6 Tahun</option>
            <option value="7 tahun">7 Tahun</option>
            <option value="8 tahun">9 Tahun</option>
            <option value="9 tahun">9 Tahun</option>
            <option value="10 tahun">10 Tahun</option>
          </select>
          <br>
          <label for="sel1">Jarak Tempuh Mobil :</label>
          <select class="form-control" name="jarak">
            <option value="">Pilih Jarak Tembuh</option>
            <option value="1">Dibawah 50 KM</option>
            <option value="50.000 km">50 KM - 70 KM</option>
            <option value="100.000 km">Diatas 70 KM</option>
          </select>
        </div>
        <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
              <th>No</th>
              <th>Gejala</th>
              <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          <?php 
          $i = 1;
          foreach ($konsultasi as $value){?>
            <?php if (!number_format($value['gejala'])): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $value['gejala']; ?></td>
                <td><input type="checkbox" name="data_uji[]" value="<?php echo $value['kode_g'] ?>"></td>
            </tr>
            <?php $i++; endif ?>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" align="center">
              <button class="btn btn-primary">KONSULTASI</button>
            </td>
          </tr>
        </tfoot>
        </table>
        </form>
    </div>
    <!-- End Isi -->
    <div class="col-sm-12">
      <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/pengguna/konsultasi.php">Andri Rizki Saputra</a></p>
    </div>
  </div>
  <!-- End Isi -->
    <script src="../tampilan/js/jquery-1.11.1.min.js"></script>
    <script src="../tampilan/js/bootstrap.min.js"></script>
    <script src="../tampilan/js/chart.min.js"></script>
    <script src="../tampilan/js/chart-data.js"></script>
    <script src="../tampilan/js/easypiechart.js"></script>
    <script src="../tampilan/js/easypiechart-data.js"></script>
    <script src="../tampilan/js/bootstrap-datepicker.js"></script>
    <script src="../tampilan/js/custom.js"></script>
    <!-- JS Tabel -->
    <script src="../tampilan/tables/jquery-3.3.1.js"></script>
    <script src="../tampilan/tables/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
      $('#example').DataTable( {
          "scrollY":        "200px",
          "scrollCollapse": true,
          "paging":         false
      } );
      } );
      
      window.onload = function () {
      var chart1 = document.getElementById("line-chart").getContext("2d");
      window.myLine = new Chart(chart1).Line(lineChartData, {
      responsive: true,
      scaleLineColor: "rgba(0,0,0,.2)",
      scaleGridLineColor: "rgba(0,0,0,.05)",
      scaleFontColor: "#c5c7cc"
      });
      };
    </script>
</body>
</html>