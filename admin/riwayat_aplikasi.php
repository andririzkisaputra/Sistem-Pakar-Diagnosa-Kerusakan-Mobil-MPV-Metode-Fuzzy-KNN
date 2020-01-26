<?php 
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '2' AND $_SESSION['status'] == '3'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../login.php'</script>";
}else

require '../proses/koneksi.php';
$db = new Database();
$tampilan_riwayat = $db->tampil_riwayat_aplikasi();
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
        <a class="navbar-brand" href="#">Diagnosa Mobil <span>MPV</span></a>
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
      <li><a href="data_user.php"><em class="fa fa-sticky-note">&nbsp;</em> Data User</a></li>
      <li><a href="data_komentar.php"><em class="fa fa-sticky-note-o">&nbsp;</em> Data Komentar</a></li>
      <li class="active"><a href="riwayat_aplikasi.php"><em class="fa fa-clone">&nbsp;</em> Riwayat Aplikasi</a></li>
      <li><a href="riwayat_kerusakan_pengguna.php"><em class="fa fa-clone">&nbsp;</em> Riwayat Konsultasi</a></li>
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
        <li class="active">Riwayat Aplikasi</li>
      </ol>
    </div><!--/.row-->
    
    <!-- Isi -->
    <div>
      <br>
        <h2>Tabel Riwayat Aplikasi</h2>
        <form method="post" action="../proses/proses.php">
        <br><br>
        <table id="kerusakan" class="display nowrap" style="width:100%">
        <thead>
          <tr>
            <th>NO</th>
            <th>Username</th>
            <th>Waktu Login</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($tampilan_riwayat as $key => $value) {?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $value['username']; ?></td>
                <td><?php echo $value['waktu_login']; ?></td>
                <td><a class="btn btn-danger" href="../proses/proses.php?no=<?php echo $value['no'] ?>&hapus_riwayat_aplikasi">Hapus</a></td>
              </tr>
          <?php $i++;} ?>
        </tbody>
        <tfoot>
          <tr align="center">
            <th>Total Penggunaan</th>
            <th colspan="2"><?php echo $i-1; ?></th>
          </tr>
        </tfoot>
        </table>
        </form>
    </div>
    <!-- End Isi -->
    <div class="col-sm-12">
        <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/admin/data_user.php">Andri Rizki Saputra</a></p>
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
      $('#kerusakan').DataTable( {
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