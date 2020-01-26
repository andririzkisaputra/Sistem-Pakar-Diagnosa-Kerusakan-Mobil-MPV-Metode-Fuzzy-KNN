<?php
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '2' || $_SESSION['status'] == '1'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../index.php'</script>";
}else

require '../proses/koneksi.php';
$db = new Database();
$tampilan_riwayat = $db->tampil_riwayat_id($_SESSION['username']);
$kerusakan = $db->tampil_kerusakan();

$no = 0;
foreach ($kerusakan as $key => $value1) {
  foreach ($tampilan_riwayat as $key => $value) {
    if ($value1['kode_k'] == $value['kode_k']) {
      $kode[] = $value['kode_k'];
      // $total[] = $total1[$no];
      break;
    }
    $no++;
  }
}

$no = 0;
$cek = 0;
foreach ($kerusakan as $key => $value1) {
  foreach ($tampilan_riwayat as $key => $value) {
    if ($value1['kode_k'] == $value['kode_k']) {
      $cek = $cek + 1; 
    }
  }
  $total1[$no] = $cek;
  // echo $cek;
  $cek = 0;
  $no++;
}
$no = 0;
for ($i=0; $i < count($total1); $i++) {
    if ($total1[$i] != 0) {
        $total[$no] = $total1[$i];
        $no++;  
     } 
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
      <li><a href="konsultasi.php"><em class="fa fa-calendar">&nbsp;</em> Konsultasi</a></li>
      <li class="active"><a href="riwayat.php"><em class="fa fa-clone">&nbsp;</em> Riwayat Konsultasi</a></li>
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
        <li class="active">Riwayat Konsultasi</li>
      </ol>
    </div><!--/.row-->
    <!-- Isi -->
    <div>
      <br>
      <h3><b>Riwayat Konsultasi</b></h3>
      <form action="" method="post">
        <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
              <th>No</th>
              <th>Mobil</th>
              <th>Kerusakan</th>
              <th>Gejala</th>
              <th>Waktu Konsultasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; $no = 0;
            foreach ($tampilan_riwayat as $key => $value) { ?>
              <tr>
                <?php if ($value['kode_k'] == @$kode[$i]) {
                $i++; ?>
                <td rowspan="<?php echo $total[$no] ?>"><?php echo $i; ?></td>
                <td rowspan="<?php echo $total[$no] ?>"><?php echo $value['merk']; ?></td>
                <td rowspan="<?php echo $total[$no] ?>"><?php echo $value['kerusakan']; ?></td>
                <?php $no++;}?>
                <td><?php echo $value['gejala']; ?></td>
                <td><?php echo $value['waktu_riwayat']; ?></td>
              </tr>
            <?php  } ?>
        </tbody>
        <tfoot>
        	<tr>
              <th>No</th>
              <th>Mobil</th>
              <th>Kerusakan</th>
              <th>Gejala</th>
              <th>Waktu Konsultasi</th>
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
  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/chart.min.js"></script>
  <script src="../js/chart-data.js"></script>
  <script src="../js/easypiechart.js"></script>
  <script src="../js/easypiechart-data.js"></script>
  <script src="../js/bootstrap-datepicker.js"></script>
  <script src="../js/custom.js"></script>
  <!-- JS Tabel -->
  <script src="../tampilan/tables/jquery-3.3.1.js"></script>
  <script src="../tampilan/tables/jquery.dataTables.min.js"></script>
  <script>
      $(document).ready(function() {
      $('#example').DataTable( {
            "scrollX": true
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