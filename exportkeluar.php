<?php
require 'function.php';
require 'cek.php';
?>
<html>
<title>Laporan Barang Keluar</title>
<div class="container py-5">
<a href="keluar.php" class="btn btn-primary">< Back</a>
<header class="text-center">
    <h1 class="display-4">Laporan Barang Keluar</h1>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</header>

<body>
<div class="container">
			<h2>Record Barang Keluar</h2>
			<div class="row">
			<form method="post" class="form-inline">
                <input type="date" name="tgl_mulai" class="form-control ml-3">
                <input type="date" name="tgl_selesai" class="form-control ml-3">
                <button type="submit" name="filter_tgl" class="btn btn-info ml-3"> Filter </button>
            </form>
            </div>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="mauexportkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
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
                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$qty;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                    Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                    Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            };
                                            ?>

                                        </tbody>
                                    </table>
					
				</div>
</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexportkeluar').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>