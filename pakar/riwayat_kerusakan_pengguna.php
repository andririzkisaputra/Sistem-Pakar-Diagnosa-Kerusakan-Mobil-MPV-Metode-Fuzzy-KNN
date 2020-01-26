<?php 
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '1' || $_SESSION['status'] == '3'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../index.php'</script>";
}else
require '../proses/koneksi.php';
$db = new Database();
$riwayat = $db->tampil_riwayat();
$tampil_user = $db->tampil_user();
$kerusakan = $db->tampil_kerusakan();

$no = 0;
foreach ($tampil_user as $key => $value) {
  foreach ($riwayat as $key => $value1) {
    if ($value['username'] == $value1['username']) {
      $username[] = $value1['username'];
      break;
    }
  }
}


$no = 0;
$cek = 0;
foreach ($tampil_user as $key => $value) {
  foreach ($riwayat as $key => $value1) {
    if ($value['username'] == $value1['username']) {
      $cek = $cek + 1;
    }
  }
  $total1[$no] = $cek;
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
        <div class="profile-usertitle-status"><span class="indicator label-success"></span><b>HI! Pakar</b></div>
      </div>
      <div class="clear"></div>
    </div>
    <ul class="nav menu">
      <li><a href="data_kerusakan.php"><em class="fa fa-sticky-note">&nbsp;</em> Data Kerusakan</a></li>
      <li><a href="data_gejala.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Data Gejala</a></li>
      <li><a href="data_solusi.php"><em class="fa fa-sticky-note">&nbsp;</em> Data Solusi</a></li>
      <li><a href="data_latih.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Data Latih</a></li>
      <li class="active"><a href="riwayat_kerusakan_pengguna.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Riwayat Konsultasi</a></li>
      <li><a href="../proses/proses.php?&logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
  </div><!--/.sidebar-->
  <!-- End Menu -->

  <!-- Isi -->
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="http://localhost/sistem_pakar/pakar/data.php">
          <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Riwayat Konsultasi</li>
      </ol>
    </div><!--/.row-->
    
    <!-- Isi -->
    <div>
        <br>
        <h3><b>Tabel Riwayat Konsultasi User</b></h3>
        <br><br>
        <table id="gejala" class="display nowrap" style="width:100%">
        <thead>
          <tr>
            <th>NO</th>
            <th>User</th>
            <th>Mobil</th>
            <th>Kerusakan</th>
            <th>Gejala</th>
            <th>Waktu Konsultasi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; $no = 0; $no1 = 0;
          foreach ($riwayat as $key => $value) {?>
            <tr>
              <?php if ($value['username'] == @$username[$no]) {
              $i++;?>
              <td rowspan="<?php echo $total[$no] ?>"><?php echo $no+1; ?></td>
              <td rowspan="<?php echo $total[$no] ?>"><?php echo $username[$no]; ?></td>
              <td rowspan="<?php echo $total[$no] ?>"><?php echo $value['merk']; ?></td>
              <?php $no++;}?>
              <td><?php echo $value['kerusakan']; ?></td>
              <td><?php echo $value['gejala']; ?></td>
              <td><?php echo $value['waktu_riwayat']; ?></td>
              <td><a class="btn btn-danger" href="../proses/proses.php?no=<?php echo $value['no'] ?>&hapus_riwayat_konsultasi">Hapus</a></td>
            </tr>
          <?php $i++;} ?>
        </tbody>
        <tfoot>
          <tr>
            <th>NO</th>
            <th>User</th>
            <th>Mobil</th>
            <th>Kerusakan</th>
            <th>Gejala</th>
            <th>Waktu Konsultasi</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        </table>
    </div>
    <!-- End Isi -->
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
  <!-- JS Tabel -->
  <script src="../tampilan/tables/jquery-3.3.1.js"></script>
  <script src="../tampilan/tables/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#kerusakan').DataTable( {
            "scrollX": true
      } );
      } );

      $(document).ready(function() {
      $('#gejala').DataTable( {
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