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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
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
        <div class="d-none d-md-flex align-items-center ">
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
                        <a href="index.php">
                            <img class="image" src="assets\img\logo2.png"  width="150px" style="margin: 1px;padding: 0px; color:dark;">
                        </a>                        
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Home
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
                        <a class="nav-link" href="profile.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-people-fill -alt"></i></div>
                            Profile
                        </a>
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
                    <h1 class="mt-2 text-center border border-primary badge-success text-uppercase">Pegadaian Sistem Inventaris</h1>
                    <div class="container">
                        <?php
                            $totalbarang = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(namabarang) AS total FROM stock"))
                        ?>
                        
                        <div class="grafik border row d-flex justify-content-between align-items-center text-center">
                            <div class="col-6 my-4 font-weight-bold">
                                <h2>Total Barang</h2>
                                <h3><?=$totalbarang['total']?></h3>
                            </div>
                            <div id="grafik-1" class="col-6 my-4">
                                <h2>Total Barang per Kategori</h2>
                                <canvas id="chartTotalItems"></canvas>
                            </div>
                            <div id="grafik-2" class="col-6 my-4">
                                <h2>Barang paling banyak di Ambil</h2>
                                <canvas id="chartTopWithdrawnItems"></canvas>
                            </div>
                            <div id="grafik-3" class="col-6 my-4">
                                <h2>Barang hampir Habis !</h2>
                                <canvas id="chartLowStockItems"></canvas>
                            </div>
                            <div id="grafik-4" class="col-12 my-4">
                                <h2>Barang paling banyak Masuk</h2>
                                <canvas id="chartMostAddedItems"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to get random color for charts
        function getDistinctColors(count) {
        var colors = [];
        for (var i = 0; i < count; i++) {
            var hue = (360 / count) * i;
            colors.push(`hsla(${hue}, 100%, 70%, 1)`);
        }
        return colors;
    }

    // Function to create and render a chart
    function renderChart(ctx, data, labels, type, title) {
        var colors = getDistinctColors(data.length);
        var myChart = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

        // Function to fetch data from the server and render charts
        function fetchDataAndRenderCharts() {
            fetch('fetch_data.php?action=getTotalItemsByCategory')
            .then(response => response.json())
            .then(data => {
                var labels = data.map(item => item.kategori);
                var quantities = data.map(item => item.total_items);
                var ctx5 = document.getElementById('chartTotalItems').getContext('2d');
                var type = 'bar';
                renderChart(ctx5, quantities, labels, type, "Dataset Barang terbanyak per Kategori");
            });
            
            fetch('fetch_data.php?action=getTopWithdrawnItems')
                .then(response => response.json())
                .then(data => {
                    var labels = data.map(item => item.namabarang);
                    var quantities = data.map(item => item.total_qty);
                    var ctx2 = document.getElementById('chartTopWithdrawnItems').getContext('2d');
                    var type = 'pie';
                    renderChart(ctx2, quantities, labels, type, 'Top 5 Withdrawn Items');
                });

            fetch('fetch_data.php?action=getLowStockItems')
                .then(response => response.json())
                .then(data => {
                    var labels = data.map(item => item.namabarang);
                    var quantities = data.map(item => item.stock);
                    var ctx3 = document.getElementById('chartLowStockItems').getContext('2d');
                    var type = 'doughnut';
                    renderChart(ctx3, quantities, labels, type, 'Low Stock Items');
                });

            fetch('fetch_data.php?action=getMostAddedItems')  // Add this block
                .then(response => response.json())
                .then(data => {
                    var labels = data.map(item => item.namabarang);
                    var quantities = data.map(item => item.total_qty);
                    var ctx4 = document.getElementById('chartMostAddedItems').getContext('2d');
                    var type = 'polarArea';
                    renderChart(ctx4, quantities, labels, type, 'Most Added Items');
                });
        }

        fetchDataAndRenderCharts();
    });
</script>
</body>

</html>