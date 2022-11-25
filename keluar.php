<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 80px;
            }
            .zoomable:hover{
                transform: scale(2.5);
                transition: 0.2s ease;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="index.php">PESIRIS</a>
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
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-plus -alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
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
                        <h1 class="mt-4">Barang Keluar</h1>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalkeluar">
                            Ambil Barang
                            </button>
                            <a href="exportkeluar.php" class="btn btn-info">Laporan</a>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                        <input type="date" name="tgl_mulai" class="form-control ml-3">
                                        <input type="date" name="tgl_selesai" class="form-control ml-3">
                                        <button type="submit" name="filter_tgl" class="btn btn-info ml-3"> Filter </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">

                            <?php
                            //ambil nilai variabel error
                            if (isset($_GET['error']))
                            {
                            $error=$_GET['error'];
                            }
                            else
                            {
                            $error="";
                            }
                            //pesan error
                            $pesan="";
                            if ($error=="overqty"){
                                $ambilsemuadatastock = mysqli_query($conn, "select * from stock s, keluar k where s.idbarang = k.idbarang");
                                while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                    $idbarangnya = $data['idbarang'];
                                
                            ?>
                            <div class="alert alert-danger alert-dismissible" id="notif<?=$idk;?>">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Perhatian!</strong> Stock Barang yang Dipilih Kurang!!
                           </div>

                           <?php
                            }}
                           ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Penerima</th>
                                                <th>Qty</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php


                                        if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];
                                            if($mulai!=null || $selesai!=null){
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idkeluar DESC");
                                            } else {
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang");
                                            }
                                        }else {
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang");
                                        }

                                            while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                $idk = $data['idkeluar'];
                                                $idb = $data['idbarang'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $penerima = $data['penerima'];

                                                //cek ada gambar atau tidak
                                                $gambar = $data['image'];//ambil gambar
                                                if($gambar==null){
                                                    //jika tidak ada gambar
                                                    $img = '(No Photo)';
                                                } else {
                                                    //jika ada gambar
                                                    $img = '<img src="assets/img/'.$gambar.'" class="zoomable">';
                                                }
                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$img;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$qty;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>"> <i class="fa fa-edit"> </i></#>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>"> <i class="fa fa-trash"> </i></#>
                                                    </button>
                                                </td>
                                                
                                            </tr>


                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Barang</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <input type='text' name='namabarang' value="<?=$namabarang;?>" placeholder="Nama Barang" class='form-control' required>
                                                <br>
                                                <input type="text" name="penerima" value="<?=$penerima;?>" placeholder="Penerima" class="form-control" required>
                                                <br>
                                                <input type="text" name="qty" value="<?=$qty;?>" placeholder="Penerima" class="form-control" required>
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="idk" value="<?=$idk;?>">
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                                                </div>
                                                </form>
                                                
                                            </div>
                                            </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?=$idk;?>">
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
                                                Apakah Anda yakin ingin menghapus <?=$namabarang;?>?
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                <input type="hidden" name="idk" value="<?=$idk;?>">
                                                <br>
                                                <br>
                                                <!-- Modal footer -->
                                                <div class="modal-footer-center">
                                                <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
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
                $ambilsemuadatanya = mysqli_query($conn,"select * from stock");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray['namabarang'];
                    $idbarangnya = $fetcharray['idbarang'];
            ?>

            <option value="<?=$idbarangnya;?>"> <?=$namabarangnya;?></option>

            <?php
                }
            ?>
        </select>
        <br>
        <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
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
