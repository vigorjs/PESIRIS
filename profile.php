<?php
require 'function.php';
require 'cek.php';
if(isset($_SESSION['user_id'])){
    $user_logged = mysqli_fetch_array((mysqli_query($conn, "SELECT * FROM login WHERE iduser='$_SESSION[user_id]'")));   
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <style>
        .zoomable {
            width: 80px;
        }

        .zoomable:hover {
            transform: scale(2.5);
            transition: 0.2s ease;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
            <a class="navbar-brand" href="index.php">PESIRIS</a>
        </button>
        <?php
            if(isset($_SESSION['user_id'])){
        ?>
        <span class="navbar-text">
            Hallo, <?= $user_logged['email'] ?>
        </span>
        <?php
            }
        ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <img class="image" src="assets\img\logo2.png" width="150px"
                            style="margin: 1px;padding: 0px; color: dark;">
                        <a class="nav-link" href="profile.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-people-fill -alt"></i></div>
                            Profile
                        </a>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-plus -alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Barang Keluar
                        </a>

                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-left -alt"></i></div>
                            Log out
                        </a>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="d-flex align-items-center justify-content-between px-4 mt-4">
                    <h1 class="fw-bold">Your Profile</h1>
                    <a href="." class="btn btn-primary btn-lg" style="font-size: 18px;">Go Dashboard</a>
                </div>
                <form action="editprofile.php" method="post" enctype="multipart/form-data">
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php }else if(isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php  } ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 px-4 mt-3">
                                <label for="email" class="mt-4" style="font-size: 20px;">Your Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="<?= $user_logged['email'] ?>" placeholder="Enter Your Email" required readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 px-4">
                                <label for="password" class="mt-4" style="font-size: 20px;">Your Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Your Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1 px-4">
                                <label for="password" class="mt-4" style="font-size: 20px;">Your New Password</label>
                                <input type="password" name="password_baru" id="password_baru" class="form-control"
                                    placeholder="Enter Your New Password">
                                <span class="text-info">Fill in if you want to change the password</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1 px-4">
                                <label for="password" class="mt-4" style="font-size: 20px;">Confirm Your New
                                    Password</label>
                                <input type="password" name="password_baru2" id="password_baru2" class="form-control"
                                    placeholder="Confirm Your New Password">
                            </div>
                        </div>
                        <div class="text-end align-items-center px-5 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg" style="font-size: 20px;"
                                name="action">Save</button>
                        </div>




                    </div>

            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>