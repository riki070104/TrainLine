<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

include "../koneksi.php";

// Inisialisasi variabel untuk pesan kesalahan
$error_msg = "";

// Ambil id_pesanan dari URL
$id_pesanan = $_GET['id'];

// Query untuk mengambil data pesanan berdasarkan id_pesanan
$sql = "SELECT * FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'";
$result = $conn->query($sql);

// Pastikan data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan!";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan</title>
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
                        <i class="Logout" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- navbar end -->

        <!-- Content Start -->
        <div class="content">
            <div class="booking-container">
                <h2>Edit Pemesanan Tiket Kereta Api</h2>
                <form action="booking-prosesedit.php" method="POST">
                    <input type="hidden" name="id_pesanan" value="<?php echo $row['id_pesanan']; ?>">
                    <label for="keberangkatan">Keberangkatan:</label>
                    <input type="text" id="keberangkatan" name="keberangkatan" placeholder="Masukkan Keberangkatan" value="<?php echo $row['keberangkatan']; ?>" required>
                    <label for="tujuan">Tujuan:</label>
                    <input type="text" id="tujuan" name="tujuan" placeholder="Masukkan Tujuan" value="<?php echo $row['tujuan']; ?>" required>
                    <label for="tgl_keberangkatan">Tanggal Keberangkatan:</label>
                    <input type="date" id="tgl_keberangkatan" name="tgl_keberangkatan" value="<?php echo $row['tgl_keberangkatan']; ?>" required>
                    <label for="jml_tiket">Jumlah Tiket:</label>
                    <input type="number" id="jml_tiket" name="jml_tiket" placeholder="Jumlah tiket" value="<?php echo $row['jml_tiket']; ?>" required>
                    <div class="button-group">
                        <button type="submit" name="update">Update</button>
                    </div>
                </form>
                <span class="error"><?php echo $error_msg; ?></span>
            </div>
        </div>
        <!-- Content End -->
    </div>
</body>

</html>
