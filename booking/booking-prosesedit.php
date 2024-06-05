<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Permintaan untuk edit data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan']; // Ambil id_pesanan dari form
    $keberangkatan = $_POST['keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $tgl_keberangkatan = $_POST['tgl_keberangkatan'];
    $jml_tiket = $_POST['jml_tiket'];

    // Query untuk update data berdasarkan id_pesanan
    $sql = "UPDATE tb_pesanan SET keberangkatan = '$keberangkatan', tujuan = '$tujuan', tgl_keberangkatan = '$tgl_keberangkatan', jml_tiket = '$jml_tiket' WHERE id_pesanan = '$id_pesanan'";

    if ($conn->query($sql) === TRUE) {
        header('Location: booking.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}