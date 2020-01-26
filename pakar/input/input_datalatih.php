<?php 
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '1'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../../login.php'</script>";
}else

require '../../proses/koneksi.php';
$db = new Database;
$gejala = $db->tampil_konsultasi();

$kerusakan = $_POST['kerusakan'];
foreach ($gejala as $key => $value) {
  $nama_gejala[] = $value['gejala'];
  $kode_gejala[] = $value['kode_g'];
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEM PAKAR</title>
  <link href="../../tampilan/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../tampilan/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../tampilan/css/datepicker3.css" rel="stylesheet">
  <link href="../../tampilan/css/styles.css" rel="stylesheet">
  <!-- CSS Tabel -->
  <link href="../../tampilan/tables/jquery.dataTables.min.css" rel="stylesheet">
  <!--Custom Font-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">Tambah Data Latih</div>
        <div class="panel-body">
        <form action="../../proses/proses.php" method="post">
			<div class="form-group">
			<label>Kerusakan</label>
			<input class="form-control" placeholder="username" name="kerusakan" type="text" value="<?php echo $kerusakan ?>" readonly>
			</div>
		<br>
		<label>⚪ Pilih Gejala</label>
          <table id="example" class="display nowrap" style="width:100%">
            <thead>
              <tr>
                <td>NO</td>
                <td>Gejala</td>
                <td>Aksi</td>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($gejala); $i++) {  ?>
              <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $nama_gejala[$i]; ?></td>
                <td><input type="checkbox" name="gejala[]" value="<?php echo $kode_gejala[$i] ?>"></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td>NO</td>
                <td>Gejala</td>
                <td>Aksi</td>
              </tr>
            </tfoot>
          </table>
          <br>
          <button class="btn btn-primary btn-block" name="simpan_data_latih">Simpan</button>
          <br>
          </form>
          <br>
          <a href="../data_latih.php"><span class="fa fa-arrow-left"></span> <b>BATAL</b></a>
        </div>
      </div>
    </div>
    </div><!-- /.col-->
  	<!-- End Isi -->
    <div class="col-sm-12">
        <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/pakar/data_kerusakan.php">Andri Rizki Saputra</a></p>
    </div>
  </div><!-- /.row -->  
  
  <script src="../../tampilan/js/jquery-1.11.1.min.js"></script>
  <script src="../../tampilan/js/bootstrap.min.js"></script>
  <script src="../../tampilan/js/chart.min.js"></script>
  <script src="../../tampilan/js/chart-data.js"></script>
  <script src="../../tampilan/js/easypiechart.js"></script>
  <script src="../../tampilan/js/easypiechart-data.js"></script>
  <script src="../../tampilan/js/bootstrap-datepicker.js"></script>
  <script src="../../tampilan/js/custom.js"></script>
  <!-- JS Tabel -->
  <script src="../../tampilan/tables/jquery-3.3.1.js"></script>
  <script src="../../tampilan/tables/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable( {
          "scrollY":        "450px",
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