<?php
require 'function.php';

// cek login
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
// cocokin dengan db, mencari datanya ada atau ga
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
//hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung>0){
        $_SESSION['log'] = 'True';
		$_SESSION['login_success'] = 'True';
		$data = mysqli_fetch_array($cekdatabase);

        $_SESSION['user_id'] = $data['iduser'];
        header('location:index.php');
    } else {
		// header('location:login.php');
		echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Login Gagal",
                text: "Invalid email or password",
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = "login.php";
            });
        });
      </script>';
	};
}




if(!isset($_SESSION['log'])){

} else{
    header('location:index.php');

}
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
<title>LOGIN PT. PEGADAIAN</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/sweetalert2.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo2.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
	<script src="./assets/bootstrap.bundle.min.js"></script>
	<script src="./assets/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	
</head>

<body background='assets/img/Screenshot (133).png'>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<p class="lead">LOGIN</p>
							</div>
							<form action="login.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="text" name="email" class="form-control" placeholder="email" required>
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="password" class="form-control" placeholder="password" required>
								</div>
								<p>Belum punya akun? <a href="register.php">Daftar</a></p>
								<input type="submit" name="login" class="btn btn-primary btn-lg btn-block" value="LOGIN">
							</form>
							<br>
							<center>
								<p>Created By Magenta </p>
							</center>
						</div>
					</div>
				  <div class="right">
						<div class="overlay"></div>
						<div class="content text text-center">
						  <img src="assets/img/logo2.png" alt="logo-icon" width="268" height="136">
						  <img src="assets/img/logoa.png" alt="logo-icon" width="140px" height="140px">
						  <p>Scan QR untuk cek persediaan barang</p>
							<br>
							
							<h1 class="heading">PEGADAIAN SISTEM INVENTARIS</h1>

						</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
	<!-- <script>
  Swal.fire("Hello, world!");
</script> -->

</body>

</html>
