<?php
require 'function.php';
require 'cek.php';
?>
<html>
<title>Laporan Stock Barang</title>
<div class="container py-5">
<a href="index.php" class="btn btn-primary">< Back</a>
<header class="text-center">
    <h1 class="display-4">Laporan Stock Barang</h1>
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
			<h2>Stock Barang</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="mauexport" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Qty</th>
                                                <th>QR Code</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from stock");
                                            $i = 1;
                                            while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $stock = $data['stock'];
                                                $idb = $data['idbarang'];

                                                //generate qr
                                                $url = "http://localhost/inventaris/detail.php?id=".$idb;
                                                $qrcode = "https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=".$url."&choe=UTF-8";
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?php echo $namabarang;?></td>
                                                <td><?php echo $deskripsi;?></td>
                                                <td><?php echo $stock;?></td>
                                                <td><img src="<?=$qrcode;?>"></td>
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
    $('#mauexport').DataTable( {
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