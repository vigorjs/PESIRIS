<?php
require 'function.php';
require 'cek.php';

//dapetin id barang yang dipassing di halaman sebelumnya
$idbarang = $_GET['id'];
//get informasi detail barang berdasarkan database
$get = mysqli_query($conn, "select * from stock where idbarang = '$idbarang'");
$fetch = mysqli_fetch_assoc($get);
//set variable
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];

//cek ada gambar atau tidak
$gambar = $fetch['image'];//ambil gambar
if($gambar==null){
    //jika tidak ada gambar
    $img = '(No Photo)';
} else {
    //jika ada gambar
    $img = '<img src="assets/img/'.$gambar.'" class="zoomable">';
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
        <title>Stock - Detail Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
                height: 100px;
            }
            .zoomable:hover{
                transform: scale(1.8);
                transition: 0.2s ease;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">PESIRIS</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <img class="image" src="assets\img\logo2.png"  width="150px" style="margin: 1px;padding: 0px color:dark;">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                Log out
                            </a>

                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail Barang</h1>
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <h2><?=$namabarang;?></h2>
                                <?=$img;?>
                            </div>
                            <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">Deskripsi</div>
                                <div class="col-md-9">: <?=$deskripsi;?></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">Stock</div>
                                <div class="col-md-9">: <?=$stock;?></div>
                            </div>

                            <br><br>
                            <h3>Record Barang Masuk</h3>
                            <div class="card mb-4 mt-4"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Masukkan Barang
                            </button></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ambildatamasuk = mysqli_query($conn, "select * from masuk where idbarang='$idbarang'");
                                            $i = 1;
                                            while($fetch = mysqli_fetch_array($ambildatamasuk)){
                                                $tanggal = $fetch['tanggal'];
                                                $keterangan = $fetch['keterangan'];
                                                $qty = $fetch['qty'];
                                            
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$qty;?></td>
                                            </tr>

                                            <?php
                                            };
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <h3>Record Barang Keluar</h3>
                            <div class="card mb-4 mt-4">    
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalkeluar">
                            Ambil Barang
                            </div>
                            </button>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ambildatamasuk = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                            $i = 1;
                                            while($fetch = mysqli_fetch_array($ambildatamasuk)){
                                                $tanggal = $fetch['tanggal'];
                                                $penerima = $fetch['penerima'];
                                                $qty = $fetch['qty'];
                                            
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$qty;?></td>
                                            </tr>

                                            <?php
                                            };
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                </hr>
                            

                            </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

    <!-- The Modal Masukkan Barang -->
    <div class="modal fade" id="myModal">
    <div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal" name="tambahbarangmasuk">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">

        <select id="pilihan" name="barangnya" class="form-control">
            <?php 
                $ambilsemuadatanya = mysqli_query($conn,"select * from stock where idbarang='$idbarang'");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray['namabarang'];
                    $idbarangnya = $fetcharray['idbarang'];
            ?>

            <option value="<?=$idbarang;?>">
                <?=$namabarangnya;?>
            </option>

            <?php
                }
            ?>
        </select>
        <br>
        <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
        <br>
        <input type="text" name="penyerah" placeholder="Penyerah" class="form-control" required>
        <br>
        <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
        </div>
    
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>

  <!-- The Modal Ambil Barang -->
  <div class="modal fade" id="myModalkeluar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Keluar</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">

        <select name="barangnya" class="form-control">
            <?php 
                $ambilsemuadatanya = mysqli_query($conn,"select * from stock where idbarang='$idbarang'");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray['namabarang'];
                    $idbarangnya = $fetcharray['idbarang'];
            ?>

            <option value="<?=$idbarang;?>"> <?=$namabarangnya;?></option>

            <?php
                }
            ?>
        </select>
        <br>
        <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
        <br>
        <input type="text" name="penyerah" placeholder="Penyerah" class="form-control" required>
        <br>
        <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
        <input type="hidden" name="idb" value="<?=$idb;?>">
        <input type="hidden" name="idk" value="<?=$idk;?>">
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="barangkeluar" data-target="#notif<?=$idk;?>">Submit </button>
        </div>
        </form>
        
      </div>
    </div>
  </div>

</html>
