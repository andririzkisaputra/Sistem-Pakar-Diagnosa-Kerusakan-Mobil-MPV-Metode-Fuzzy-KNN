<?php 
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '2' || $_SESSION['status'] == '1'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../index.php'</script>";
}else

require '../proses/koneksi.php';
$db = new Database();

$kerusakan = $_SESSION['kerusakan'][0];
$tampil_solusi = $db->tampil_solusi($kerusakan);
$tampil_kerusakan = $db->tampil_kerusakan_no($kerusakan);
$no = 2;
foreach ($tampil_kerusakan as $key => $value) {
	$kerusakan = $value['kerusakan'];
	$no++;
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
        <a class="navbar-brand" href="#">Diagnosa Mobil <span>MPV</span></a>
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
        <div class="profile-usertitle-name"><?php echo $_SESSION['nama']; ?></div>
        <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
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
        <li><a href="http://localhost/sistem_pakar/pengguna/konsultasi.php">Konsultasi</li></a>
        <li class="active">Hasil Diagnosa</li>
      </ol>
    </div><!--/.row-->
    
    <!-- Isi -->
    <div>
      <h2><b>Hasil Konsultasi</b></h2>
      <br>
      <table class="table table-condensed">
      	<tbody>
      		<tr>
      			<td><b>Kerusakan</b></td>
	 	      	<td><?php echo $kerusakan."<br>"; ?></td>
	 	    </tr>
	 	    <tr>
      			<td rowspan="<?php echo $no; ?>"><b>Solusi</b></td>
            <?php foreach ($tampil_solusi as $key => $value) { ?>
    	 	   	<td><?php echo $value['solusi']."<br>"; ?></td>
    	 	</tr>
            <?php $no++;} ?>
      	<tr>
         <td colspan="2"><a class="btn btn-primary btn-block" href="../pengguna/konsultasi.php">Kembali</a></td> 
        </tr>
        </tbody>

      </table>
    </div>
    <!-- End Isi -->
    <div class="col-sm-12">
        <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/pengguna">Andri Rizki Saputra</a></p>
    </div>
  </div>
  <!-- End Isi -->
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/chart.min.js"></script>
  <script src="js/chart-data.js"></script>
  <script src="js/easypiechart.js"></script>
  <script src="js/easypiechart-data.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/custom.js"></script>
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