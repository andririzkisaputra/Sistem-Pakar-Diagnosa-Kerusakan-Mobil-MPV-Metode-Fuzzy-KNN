<?php 
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '1'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../../login.php'</script>";
}else

require '../../proses/koneksi.php';
$db = new Database();
$id = $_GET['no'];
$tampil = $db->tampil_kerusakan_no($id);
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
        <div class="panel-heading">Ubah Kerusakan</div>
        <div class="panel-body">
         <form action="../../proses/proses.php" method="post">
        <?php foreach ($tampil as $value) { ?>
          <div class="form-group">
            <label for="fname">Kode Kerusakan</label>
            <input class="form-control" type="text" name="kode_k" value="<?php echo $value['kode_k']; ?>" readonly>
            <br>
            <label for="fname">Kerusakan</label>
            <input class="form-control" type="text" name="kerusakan" placeholder="Masukan Kerusakan . . ." value="<?php echo $value['kerusakan']; ?>">
          </div>
        <?php } ?>
        <br>
        <button class="btn btn-success btn-block" name="edit_kerusakan">Ubah</button>
      </form>
         <br>
         <a href="../data_kerusakan.php"><span class="fa fa-arrow-left"></span> <b>BATAL</b></a>
        </div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.row -->  
  <!-- End Isi -->
    <div class="col-sm-12">
        <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/pakar/data.php">Andri Rizki Saputra</a></p>
    </div>
  </div>
  <script src="../../tampilan/js/jquery-1.11.1.min.js"></script>
  <script src="../../tampilan/js/bootstrap.min.js"></script>
  <script src="../../tampilan/js/chart.min.js"></script>
  <script src="../../tampilan/js/chart-data.js"></script>
  <script src="../../tampilan/js/easypiechart.js"></script>
  <script src="../../tampilan/js/easypiechart-data.js"></script>
  <script src="../../tampilan/js/bootstrap-datepicker.js"></script>
  <script src="../../tampilan/js/custom.js"></script>
  
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