<?php
session_start();
$error_msg = ""; // Initialize error message variable

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Import koneksi database
require_once '../koneksi.php';

// Jika formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $keberangkatan = $_POST['keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $tgl_keberangkatan = $_POST['tgl_keberangkatan'];
    $jml_tiket = $_POST['jml_tiket'];

    // Hitung total harga dengan nilai acak di atas 200 ribu
    $total_harga = rand(200000, 500000);

    // Persiapkan dan jalankan query untuk menyimpan data di tb_transaksi
    $sql_transaksi = "INSERT INTO tb_transaksi (keberangkatan, tujuan, tanggal, jumlah_tiket, total_harga) VALUES ('$keberangkatan', '$tujuan', '$tgl_keberangkatan', $jml_tiket, $total_harga)";

    if ($conn->query($sql_transaksi) === TRUE) {
        // Simpan ID transaksi yang baru saja dibuat
        $id_transaksi = $conn->insert_id;

        // Persiapkan dan jalankan query untuk menyimpan data di tb_pesanan
        $sql_pesanan = "INSERT INTO tb_pesanan (id_transaksi, keberangkatan, tujuan, tgl_keberangkatan, jml_tiket) VALUES ($id_transaksi, '$keberangkatan', '$tujuan', '$tgl_keberangkatan', $jml_tiket)";

        if ($conn->query($sql_pesanan) === TRUE) {
            // Redirect ke halaman booking.php setelah berhasil menyimpan data
            header('Location: booking.php');
            exit;
        } else {
            // Jika terjadi kesalahan saat menyimpan data di tb_pesanan, hapus data yang sudah disimpan di tb_transaksi
            $conn->query("DELETE FROM tb_transaksi WHERE id_transaksi = $id_transaksi");
            $error_msg = "Error: " . $sql_pesanan . "<br>" . $conn->error;
        }
    } else {
        // Jika terjadi kesalahan saat menyimpan data di tb_transaksi
        $error_msg = "Error: " . $sql_transaksi . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>
    <link rel="stylesheet" href="../css/booking.css">
</head>

<body>
    <div class="container">
        <!-- navbar start -->
        <nav class="side-bar">
            <div class="user-p">
                <img src="../image/TrainLine.png" alt="User Image">
            </div>
            <ul>
                <li>
                    <a href="Admin.php">
                        <i class="Dashboard" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="booking.php">
                        <i class="Booking" aria-hidden="true"></i>
                        <span>Booking</span>
                    </a>
                </li>
                <li>
                    <a href="transaction.php">
                        <i class="Transaction" aria-hidden="true"></i>
                        <span>Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="Logout.php">
                        <i class="../Logout" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- navbar end -->

        <!-- Content Start -->
        <div class="content">
            <div class="booking-container">
                <h2>Pemesanan Tiket Kereta Api</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <label for="keberangkatan">Keberangkatan:</label>
                    <input type="text" id="keberangkatan" name="keberangkatan" placeholder="Masukkan Keberangkatan" required>
                    <label for="tujuan">Tujuan:</label>
                    <input type="text" id="tujuan" name="tujuan" placeholder="Masukkan Tujuan" required>
                    <label for="tgl_keberangkatan">Tanggal Keberangkatan:</label>
                    <input type="date" id="tgl_keberangkatan" name="tgl_keberangkatan" required>
                    <label for="jml_tiket">Jumlah Tiket:</label>
                    <input type="number" id="jml_tiket" name="jml_tiket" placeholder="Jumlah tiket" required>
                    <div class="button-group">
                        <button type="submit">Tambah</button>
                    </div>
                </form>
                <span class="error"><?php echo $error_msg; ?></span>
            </div>
        </div>
        <!-- Content End -->
    </div>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>
