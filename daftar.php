<?php
$tahun = date('Y');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEM PAKAR</title>
  <link href="tampilan/css/bootstrap.min.css" rel="stylesheet">
  <link href="tampilan/css/datepicker3.css" rel="stylesheet">
  <link href="tampilan/css/styles.css" rel="stylesheet">
  
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
				<div class="panel-heading">Daftar</div>
				<div class="panel-body">
					<form role="form" action="proses/proses.php" method="post">
						<fieldset>
							<div class="form-group">
								<label>Masukan Username</label>
								<input class="form-control" placeholder="username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<label>Masukan Nama</label>
								<input class="form-control" placeholder="nama" name="nama" type="text" autofocus="">
							</div>
							<div class="form-group">
								<label>Merek Mobil</label>
								<input class="form-control" placeholder="merek mobil" name="merk" type="text" autofocus="">
							</div>
							<div class="form-group">
								<label>Masukan Password</label>
								<input class="form-control" placeholder="password" name="password" type="password" value="">
							</div>
							<button  class="btn btn-primary btn-block" name="daftar">Daftar</button>
						</fieldset>
						<br>
						<p><a href="index.php">⬅ <b>BATAL</b></a></p>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
  <!-- End Isi -->
  <div class="col-sm-12">
      <p class="back-link">Copyright © 2019 <a href="http://localhost/sistem_pakar/">Andri Rizki Saputra</a></p>
  </div>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>