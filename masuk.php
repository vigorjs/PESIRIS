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
        <title>Barang Masuk</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
            <a class="navbar-brand" href="index.php">PESIRIS</a>
        </button>
        <?php
            if(isset($_SESSION['user_id'])){
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
                        <img class="image" src="assets\img\logo2.png"  width="150px" style="margin: 1px;padding: 0px; color:dark;">
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
                    <div class="container-fluid">
                        <h1 class="mt-4">Barang Masuk</h1>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalmasuk">
                            Masukkan Barang
                            </button>
                            <a href="exportmasuk.php" class="btn btn-info">Laporan</a>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Penerima</th>
                                                <th>Penyerah</th>
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
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idmasuk DESC");
                                            } else{
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                            }
                                        }else {
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                        }
                                            
                                            while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                $idb = $data['idbarang'];
                                                $idm = $data['idmasuk'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                                $penyerah = $data['penyerah'];

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
                                                <td><?=$keterangan;?></td>
                                                <td><?=$penyerah;?></td>
                                                <td><?=$qty;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idm;?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idm;?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idm;?>">
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
                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" placeholder="Penerima" class="form-control" required>
                                                <br>
                                                <input type="text" name="penyerah" value="<?=$penyerah;?>" placeholder="Penyerah" class="form-control" required>
                                                <br>
                                                <input type="text" name="qty" value="<?=$qty;?>" placeholder="Jumlah" class="form-control" required>
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                </div>
                                                </form>
                                                
                                            </div>
                                            </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?=$idm;?>">
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
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                <br>
                                                <br>
                                                <!-- Modal footer -->
                                                <div class="modal-footer-center">
                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
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


    <!-- The Modal Masukkan Barang -->
    <div class="modal fade" id="myModalmasuk">
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
                $ambilsemuadatanya = mysqli_query($conn,"select * from stock");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray['namabarang'];
                    $idbarangnya = $fetcharray['idbarang'];
            ?>

            <option value="<?=$idbarangnya;?>">
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

</html>
