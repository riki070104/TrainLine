<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keberangkatan'])) {
    // Ambil data dari form
    $keberangkatan = $_POST['keberangkatan'];
    $tanggal = date('Y-m-d'); // Tanggal saat ini
    
    // Query untuk mendapatkan informasi tujuan, jumlah tiket, dan total harga berdasarkan keberangkatan
    $sql_info = "SELECT tujuan, jml_tiket FROM tb_pesanan WHERE keberangkatan = '$keberangkatan'";
    $result_info = $conn->query($sql_info);
    
    // Periksa apakah query berhasil dieksekusi
    if ($result_info && $result_info->num_rows > 0) {
        // Ambil data informasi dari hasil query
        $row_info = $result_info->fetch_assoc();
        $tujuan = $row_info['tujuan'];
        $jumlah_tiket = $row_info['jml_tiket'];

        // Query untuk memasukkan data baru ke dalam tabel transaksi
        $sql = "INSERT INTO tb_transaksi (keberangkatan, tujuan, tanggal, jumlah_tiket) 
                VALUES ('$keberangkatan', '$tujuan', '$tanggal', '$jumlah_tiket')";

        if ($conn->query($sql) === TRUE) {
            header('Location: transaksi.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Handle jika tidak ada informasi yang ditemukan untuk keberangkatan yang dipilih
        echo "Tidak ada informasi yang ditemukan untuk keberangkatan yang dipilih.";
    }
}


// Permintaan untuk edit data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $keberangkatan = $_POST['keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
    $jml_tiket = $_POST['jml_tiket'];

    $sql = "UPDATE tb_transaksi SET keberangkatan = '$keberangkatan', tujuan = '$tujuan', tanggal_keberangkatan = '$tanggal_keberangkatan', jml_tiket = '$jml_tiket' WHERE id_transaksi = '$id_transaksi'";

    if ($conn->query($sql) === TRUE) {
        header('Location: booking.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Permintaan untuk hapus data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $sql = "DELETE FROM tb_transaksi WHERE id_transaksi = '$delete_id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: transaksi.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
