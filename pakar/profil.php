<?php
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '1' || $_SESSION['status'] == '3'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../index.php'</script>";
}else
require '../proses/koneksi.php';
$db = new Database();
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
        <div class="profile-usertitle-status"><span class="indicator label-success"></span><b>HI! Pakar</b></div>
      </div>
      <div class="clear"></div>
    </div>
    <ul class="nav menu">
      <li><a href="data_kerusakan.php"><em class="fa fa-sticky-note">&nbsp;</em> Data Kerusakan</a></li>
      <li><a href="data_gejala.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Data Gejala</a></li>
      <li><a href="data_solusi.php"><em class="fa fa-sticky-note">&nbsp;</em> Data Solusi</a></li>
      <li><a href="data_latih.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Data Latih</a></li>
      <li><a href="riwayat_kerusakan_pengguna.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Riwayat Konsultasi</a></li>
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
        <li class="active">Profil</li>
      </ol>
    </div><!--/.row-->
    
    <!-- Isi -->
    <div>
      <br>
      <p></p>
      <form action="edit/ubah_profil.php" method="post">
        <div class="form-group">
	      <label for="sel1">Username :</label>
          <input class="form-control" name="komentar" value="<?php echo $_SESSION['username'] ?>" readonly>
          <br>
          <label for="sel1">Nama :</label>
          <input class="form-control" name="komentar" value="<?php echo $_SESSION['nama'] ?>" readonly>
          <br>
          <label for="sel1">Password :</label>
          <input class="form-control" value="<?php echo $_SESSION['password']?>" readonly>
        </div>
        <button class="btn btn-primary btn-block" name="simpan_komentar">Ubah Profil</button>
      </form>
      <br>
     <ul class="nav menu">
     <i><li><a href="edit/ubah_password.php"><em class="fa fa-long-arrow-right">&nbsp;</em> Ubah Password</a></li></i>
 	 </ul>
    </div>
    <div class="col-sm-12">
      <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/pakar/data_kerusakan.php">Andri Rizki Saputra</a></p>
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
  <script>
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