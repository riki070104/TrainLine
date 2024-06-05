<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Query untuk mengambil data dari tabel tb_pesanan
$sql = "SELECT * FROM tb_pesanan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/booking.css">
</head>

<body>
    <div class="body">
        <!-- navbar start -->
        <nav class="side-bar">
            <div class="user-p">
                <img src="../image/TrainLine.png" alt="User Image">
            </div>
            <ul>
                <li>
                    <a href="../Admin.php">
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
                    <a href="../transaksi/transaksi.php">
                        <i class="Transaction" aria-hidden="true"></i>
                        <span>Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="../Logout.php">
                        <i class="Logout" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- navbar end -->

        <div class="content">
            <h2>Data Pemesanan Tiket Kereta Api</h2>
            <button onclick="window.location.href='booking-input.php'" class="add-button">Tambah Data</button>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keberangkatan</th>
                        <th>Tujuan</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Jumlah Tiket</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1; // Inisialisasi nomor urut
                        // Output data dari setiap baris
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["keberangkatan"] . "</td>";
                            echo "<td>" . $row["tujuan"] . "</td>";
                            echo "<td>" . $row["tgl_keberangkatan"] . "</td>";
                            echo "<td>" . $row["jml_tiket"] . "</td>";
                            echo "<td>";
                            echo "<button onclick=\"window.location.href='booking-edit.php?id=" . $row['id_pesanan'] . "'\">Edit</button>";
                            echo "<form action='booking-proses.php' method='POST' style='display: inline;'>";
                            echo "<input type='hidden' name='delete_id' value='" . $row['id_pesanan'] . "'>";
                            echo "<button type='submit'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data</td></tr>"; // Perbarui colspan menjadi 6
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</body>

</html>

<?php
// Tutup koneksi setelah selesai menggunakan
$conn->close();
?>