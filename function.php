<?php
session_start();
//koneksi database
$conn = mysqli_connect('localhost','root','','stock_barang');

//tambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $kategori = $_POST['kategori'];
    $ambilsemuadatastock = mysqli_query($conn, "select * from stock");
    $data = mysqli_fetch_array($ambilsemuadatastock);


    //soal gambar
    $allowed_extension = array('png','jpg','jpeg','heic',);
    $nama = $_FILES['file']['name'];//ngambil nama file gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot));//ngambil ekstensinya
    $ukuran = $_FILES['file']['size'];//ngambil size gambarnya
    $file_tmp = $_FILES['file']['tmp_name'];//ngambil lokasi gambar

    //penamaan file --> enkripsi
    $image =md5(uniqid($nama,true) . time()).'.'.$ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya

    //validasi barang udah ada atau belum
    $cek = mysqli_query($conn, "select * from stock where namabarang = '$namabarang'");
    $hitung = mysqli_fetch_array($cek);

    if($hitung<1){
        //proses upload gambar
        if(in_array($ekstensi, $allowed_extension) === true){
            //validasi ukuran file
                if($ukuran<15000000){
                    move_uploaded_file($file_tmp,'assets/img/'.$image);

                    $addtotable = mysqli_query($conn,"Insert Into stock (namabarang, deskripsi, kategori, stock, image) values('$namabarang','$deskripsi','$kategori','$stock','$image')");
                    if($addtotable){
                        // header('location:index.php');
                        echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "success",
                            title: "Berhasil Tambah Barang",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "index.php";
                                });
                                });
                            </script>';
                    } 
                }else{
                    //kalau filenya lebih dari 15mb
                    echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "File Terlalu Besar",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "index.php";
                                });
                                });
                            </script>';
                }
        }else {
            $allowed_extension = array('png','jpg','jpeg','heic',"");
            if($ekstensi == ""){
                $addtotable = mysqli_query($conn,"Insert Into stock (namabarang, deskripsi, kategori, stock) values('$namabarang','$deskripsi','$kategori','$stock')");
                if($addtotable){
                    // header('location:index.php');
                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                    icon: "success",
                    title: "Berhasil Tambah Barang",
                    showConfirmButton: true,
                    timer: 2000
                        }).then(function() {
                        window.location.href = "index.php";
                        });
                        });
                    </script>';
                }
            } else{
                //kalau filenya bukan jpg/png
                echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "File Bukan jpg/png",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "index.php";
                                });
                                });
                            </script>';
            }
        }
    }else {
        //jika sudah ada
        echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "Barang Sudah Ada",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "index.php";
                                });
                                });
                            </script>';
    }
}
        
//addnewbarang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $penyerah = $_POST['penyerah'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;


    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, penyerah, qty) values('$barangnya', '$penerima', '$penyerah', '$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        // header('location:masuk.php');
        echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "success",
                            title: "Stok Barang Berhasil Ditambah",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "masuk.php";
                                });
                                });
                            </script>';
    } else{
        // header('location:masuk.php');
        echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "masuk.php";
                                });
                                });
                            </script>';
    }
}

//addnewbarang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $penyerah = $_POST['penyerah'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    if($qty>$stocksekarang){
        // header('location:keluar.php?error=overqty');
        echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "Perhatian! Stock Barang yang Dipilih Kurang!!",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "keluar.php?error=overqty";
                                });
                                });
                            </script>';
        } else{
        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty, penyerah) values('$barangnya', '$penerima', '$qty', '$penyerah')");
        $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
        if($addtokeluar&&$updatestockmasuk){
            // header('location:keluar.php');
            echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "success",
                            title: "Berhasil Ambil Barang",
                            showConfirmButton: true,
                            timer: 2000
                                }).then(function() {
                                window.location.href = "keluar.php";
                                });
                                });
                            </script>';
        }
    }
}

//update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    //soal gambar
    $allowed_extension = array('png','jpg','jpeg','heic');
    $nama = $_FILES['file']['name'];//ngambil nama file gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot));//ngambil ekstensinya
    $ukuran = $_FILES['file']['size'];//ngambil size gambarnya
    $file_tmp = $_FILES['file']['tmp_name'];//ngambil lokasi gambar

    //penamaan file --> enkripsi
    $image =md5(uniqid($nama,true) . time()).'.'.$ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya
    
    if($ukuran==0){
        //jika tidak ingin upload
        $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang ='$idb'");
        if($update){
            header('location:index.php');
        } else{
            header('location:index.php');
        }
    } else{
        //jika ingin upload
        move_uploaded_file($file_tmp,'assets/img/'.$image);
        $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi', image='$image' where idbarang ='$idb'");
        if($update){
            header('location:index.php');
        } else{
            header('location:index.php');
        }
    }
}

//Hapus Barang di stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb']; //idbarang

    $gambar = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'assets/img/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else{
        header('location:index.php');
    }
}

//update data barang masuk

if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $penyerah = $_POST['penyerah'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock ='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan', penyerah='$penyerah' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock ='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan', penyerah='$penyerah' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    }
}


//delete barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock-$qty;

    $update = mysqli_query($conn, "update stock set stock ='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}


//update data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $namabarang = $_POST['namabarang'];
    $penerima = $_POST['penerima'];
    $penyerah = $_POST['penyerah'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty - $qtyskrg;
        if($selisih > $stockskrg){
            header('location:keluar.php?error=overqty');
        } else {
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn, "update stock set stock ='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima', penyerah='$penyerah' where idkeluar='$idk'");
                if($kurangistocknya&&$updatenya){
                    header('location:keluar.php');
                } else {
                    echo 'Gagal';
                    header('location:keluar.php');
                }
            }
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock ='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima', penyerah='$penyerah' where idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php');
            }
    }
}

//delete barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock+$qty;

    $update = mysqli_query($conn, "update stock set stock ='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}

?>
