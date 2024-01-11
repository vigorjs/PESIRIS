<?php
require 'function.php';
require 'cek.php';

// Check the action parameter
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getTotalItemsByCategory':
            getTotalItemsByCategory();
            break;
        case 'getTopWithdrawnItems':
            getTopWithdrawnItems();
            break;
        case 'getLowStockItems':
            getLowStockItems();
            break;
        case 'getMostAddedItems':
            getMostAddedItems();
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'Action parameter not provided']);
}

function getMostAddedItems() {
    global $conn;

    $query = "SELECT s.namabarang, SUM(m.qty) AS total_qty
              FROM stock s
              JOIN masuk m ON s.idbarang = m.idbarang
              GROUP BY s.namabarang
              ORDER BY total_qty DESC
              LIMIT 5";

    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'namabarang' => $row['namabarang'],
            'total_qty' => (int)$row['total_qty'],
        ];
    }

    echo json_encode($data);
}

function getTotalItemsByCategory() {
    global $conn;

    $query = "SELECT kategori, COUNT(*) AS total_items FROM stock GROUP BY kategori";
    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'kategori' => (string)$row['kategori'],
            'total_items' => (int)$row['total_items'],
            ];
    }

    echo json_encode($data);
}

function getTopWithdrawnItems() {
    global $conn;

    $query = "SELECT s.namabarang, SUM(k.qty) AS total_qty
              FROM stock s
              JOIN keluar k ON s.idbarang = k.idbarang
              GROUP BY s.namabarang
              ORDER BY total_qty DESC
              LIMIT 5";

    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'namabarang' => $row['namabarang'],
            'total_qty' => (int)$row['total_qty'],
        ];
    }

    echo json_encode($data);
}

function getLowStockItems() {
    global $conn;

    $query = "SELECT namabarang, stock, kategori FROM stock 
              WHERE (kategori = 'Marketing Kit' AND stock <= 10)
              OR (kategori = 'Brosur' AND stock <= 100)
              OR (kategori != 'Kendaraan' AND stock <= 10)
              OR (kategori = 'ATK' AND stock <= 50)";

    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'namabarang' => $row['namabarang'],
            'stock' => (int)$row['stock'],
            'kategori' => $row['kategori'],
        ];
    }

    echo json_encode($data);
}

?>
