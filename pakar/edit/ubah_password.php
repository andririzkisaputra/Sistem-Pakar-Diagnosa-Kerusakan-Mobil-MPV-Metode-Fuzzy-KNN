<?php
session_start(); 
if (empty($_SESSION['username']) || $_SESSION['status'] == '3' || $_SESSION['status'] == '1'){
    echo "<script>alert('Login terlebih dahulu.'); window.location = '../index.php'</script>";
}else
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
        <div class="panel-heading">Ubah Password</div>
        <div class="panel-body">
          <form role="form" action="../../proses/proses.php" method="post">
            <fieldset>
              <div class="form-group">
                <label class="sel1">Masukan Password Baru</label>
                <input class="form-control" placeholder="Password" name="password" type="text">
              </div>
              <button name="edit_password_pakar" class="btn btn-primary">Simpan</button>
              <br>
              <br>
			        <a href="../profil.php"><span class="fa fa-arrow-left"></span> <b>BATAL</b></a>
            </fieldset>
          </form>
        </div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.row -->  
  <!-- End Isi -->
  <div class="col-sm-12">
      <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/pengguna/konsultasi.php">Andri Rizki Saputra</a></p>
  </div>
  <script src="../../tampilan/js/jquery-1.11.1.min.js"></script>
  <script src="../../tampilan/js/bootstrap.min.js"></script>
</body>
</html>