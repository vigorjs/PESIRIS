<?php
require 'function.php';

// cek login
if(isset($_POST['daftar'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
// tambah ke db
    $query = mysqli_query($conn, "INSERT INTO login SET email='$email', password='$password'");
    if($query){
        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else{
        header('location:register.php');
    }
};

if(!isset($_SESSION['log'])){

} else{
    header('location:index.php');
}
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>REGISTER PT. PEGADAIAN</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/sweet/sweetalert2.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo2.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
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
								<p class="lead">REGISTER</p>
							</div>
							<form action="register.php" method="post">
								<div class="form-group">
									<label for="signup-email" class="control-label sr-only">Email</label>
									<input type="text" name="email" class="form-control" placeholder="email" required>
								</div>
								<div class="form-group">
									<label for="signup-password" class="control-label sr-only">Password</label>
									<input type="password" name="password" class="form-control" placeholder="password"
										required>
								</div>
								<input type="submit" name="daftar" class="btn btn-primary btn-lg btn-block">
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
	
	<?php
            if (isset($registrationError) && $registrationError) {
                echo "<script>
                        alert('Registration Error. Please try again.');
                    </script>";
            }
        ?>

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
    	$(document).ready(function () {
        	$('form').submit(function (e) {
           		e.preventDefault(); // prevent the form from submitting
            
            	Swal.fire({
                	icon: 'success',
                	title: 'Registration Successful!',
                	text: 'Welcome to PT. PEGADAIAN',
                	showConfirmButton: true
            		}).then(function() {
                	window.location.href = 'index.php';
            	});
        	});
   	 	});
</script>

	
</body>

</html>