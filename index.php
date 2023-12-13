<?php
require 'function.php';
require 'cek.php';
if (isset($_SESSION['user_id'])) {
    $user_logged = mysqli_fetch_array((mysqli_query($conn, "SELECT * FROM login WHERE iduser='$_SESSION[user_id]'")));

    if (isset($_SESSION['login_success']) && $_SESSION['login_success'] == true) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Login Berhasil",
                text: "Selamat datang kembali, ' . $user_logged['email'] . '!",
                showConfirmButton: false,
                timer: 4000 
            });
        });
    </script>';
        // Setel kembali variabel sesi agar tidak menunjukkan alert di muatan halaman selanjutnya
        $_SESSION['login_success'] = false;
    }
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
    <title>Dashboard - Stock Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script src="./assets/bootstrap.bundle.min.js"></script>
    <script src="./assets/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .zoomable {
            width: 80px;
        }

        .zoomable:hover {
            transform: scale(2.5);
            transition: 0.2s ease;
        }

        a {
            text-decoration: none;
            color: green;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
            <a class="navbar-brand" href="index.php">PESIRIS</a>
        </button>
        <?php
        if (isset($_SESSION['user_id'])) {
        ?>
            <div class="d-flex align-items-center ">
            <span class="navbar-text">
                Hallo, <?= $user_logged['email'] ?>
            </span>
            <span style="margin-left: 10px;"></span>
            <img src="assets/img/<?= $user_logged['photo'] ?>" class="avatar rounded-circle" style="width: 50px; height: 50px; object-fit:cover ml-3" alt="">
        </div>
        <?php
        }
        ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <img class="image" src="assets\img\logo2.png" width="150px" style="margin: 1px;padding: 0px; color: dark;">
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
                        <!-- <a class="nav-link" href="logout.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-left -alt"></i></div>
                            Log out
                        </a> -->

                        <a class="nav-link" href="#" onclick="confirmLogout()">
                            <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-left -alt"></i></div>
                            Log out
                        </a>

                        <script>
                            function confirmLogout() {
                                Swal.fire({
                                    title: "Konfirmasi Logout",
                                    text: "Anda yakin ingin logout?",
                                    icon: "question",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Logout"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Jika dikonfirmasi, arahkan ke halaman logout
                                        window.location.href = "logout.php";
                                    }
                                });
                            }
                        </script>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Stock Barang</h1>

                    <div class="card mb-4">

                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                            <a href="export.php" class="btn btn-info">Laporan</a>
                        </div>
                        <button type="button" class="btn btn-outline-primary mt-3" data-toggle="modal" data-target="#scanner">
                            Scan Barang
                        </button>

                        <div class="card-body">
                            <?php
                            $ambildatastock = mysqli_query($conn, "select * from stock where stock < 1");
                            while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                $namabarang = $fetch['namabarang'];

                            ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stock <?= $namabarang; ?> telah habis!
                                </div>

                            <?php
                            }
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Qty</th>
                                            <th>QR Code</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from stock");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                            $namabarang = $data['namabarang'];
                                            $deskripsi = $data['deskripsi'];
                                            $stock = $data['stock'];
                                            $idb = $data['idbarang'];

                                            //generate qr
                                            $url = "detail.php?id=" . $idb;
                                            $qrcode = "https://chart.googleapis.com/chart?chs=350x350&cht=qr&chl=" . $url . "&choe=UTF-8";

                                            //cek ada gambar atau tidak
                                            $gambar = $data['image']; //ambil gambar
                                            if ($gambar == null) {
                                                //jika tidak ada gambar
                                                $img = '(No Photo)';
                                            } else {
                                                //jika ada gambar
                                                $img = '<img src="assets/img/' . $gambar . '" class="zoomable">';
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $img; ?></td>
                                                <td><strong><a href="detail.php?id=<?= $idb; ?>"><?= $namabarang; ?></a></strong>
                                                </td>
                                                <td><?= $deskripsi; ?></td>
                                                <td><?= $stock; ?></td>
                                                <td><img src="<?= $qrcode; ?>" class="zoomable"></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idb; ?>"> <i class="fa fa-edit"> </i></#>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idb; ?>"> <i class="fa fa-trash"> </i></#>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type='text' name='namabarang' value="<?= $namabarang; ?>" placeholder="Nama Barang" class='form-control' required>
                                                                <br>
                                                                <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" placeholder="Kategori" class="form-control" required>
                                                                <br>
                                                                <input type="file" name="file" class="form-data">
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?= $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Barang?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body text-center">
                                                                <br>
                                                                Apakah Anda yakin ingin menghapus <?= $namabarang; ?>?
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <br>
                                                                <br>
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer-center">
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                                    <button type="button" class="btn btn-danger" onclick="showDeleteConfirmation('<?= $namabarang; ?>', <?= $idb; ?>)">
                                                                        Hapus
                                                                    </button>
                                                                </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>


                                        <?php
                                        };
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Inventaris 2022</div>
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
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type='text' name='namabarang' placeholder="Nama Barang" class='form-control' required>
                    <br>
                    <input type="text" name="deskripsi" placeholder="Kategori" class="form-control" required>
                    <br>
                    <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                    <br>
                    <input type="file" name="file" placeholder="Gambar" class="form-data">
                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                </div>


                <!-- Modal footer -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>


        </div>
    </div>
</div>

<!-- The Modal scanner -->
<div class="modal fade" id="scanner">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="qr-reader"></div>
            <script>
                function onScanSuccess(decodedText, decodedResult) {
                    if(decodedText.includes('detail.php?id=')) {
                        window.location.href = decodedText;
                    }else {
                        Swal.fire({
            icon: "error",
            title: "QR Code tidak valid",
            text: "QR Code yang dipindai tidak ada dalam data."
                                 });
                    }
                }
                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: 250
                    });
                html5QrcodeScanner.render(onScanSuccess);
            </script>

            <!-- Modal footer -->
            <div class="modal-footer">
                Scan QR-Code Barang
            </div>
            </form>

        </div>
    </div>
</div>



</html>