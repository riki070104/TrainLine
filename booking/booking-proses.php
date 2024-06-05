<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Permintaan untuk tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keberangkatan'])) {
    $keberangkatan = $_POST['keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $tgl_keberangkatan = $_POST['tgl_keberangkatan'];
    $jml_tiket = $_POST['jml_tiket'];

    $sql = "INSERT INTO tb_pesanan (keberangkatan, tujuan, tgl_keberangkatan, jml_tiket) VALUES ('$keberangkatan', '$tujuan', '$tgl_keberangkatan', '$jml_tiket')";

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

    // Query untuk hapus data berdasarkan id_pesanan
    $sql = "DELETE FROM tb_pesanan WHERE id_pesanan = '$delete_id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: booking.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
