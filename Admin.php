<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi.php sudah ada dan terkonfigurasi dengan benar

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Ambil data dari database untuk widget
$queryTotalTransaksi = "SELECT COUNT(*) AS total_harga FROM tb_transaksi";
$resultTotalTransaksi = $conn->query($queryTotalTransaksi);
$totalTransaksi = $resultTotalTransaksi->fetch_assoc()['total_harga'];

$queryTotalBooking = "SELECT COUNT(*) AS jml_tiket FROM tb_pesanan";
$resultTotalBooking = $conn->query($queryTotalBooking);
$totalBooking = $resultTotalBooking->fetch_assoc()['jml_tiket'];

$queryTotalUsers = "SELECT COUNT(*) AS id FROM user";
$resultTotalUsers = $conn->query($queryTotalUsers);
$totalUsers = $resultTotalUsers->fetch_assoc()['id'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Tambahkan beberapa styling dasar untuk widget */
        .widget-container {
            display: flex;
            justify-content: space-around;
            margin: 50px 0;
        }

        .widget {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .widget:hover {
            transform: translateY(-5px); /* Bergerak ke atas 5px saat hover */
        }

        .widget h2 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        .widget p {
            margin: 0;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="body">
        <!-- navbar start -->
        <nav class="side-bar">
            <div class="user-p">
                <img src="image/TrainLine.png" alt="User Image">
            </div>
            <ul>
                <li>
                    <a href="Admin.php">
                        <i class="Dashboard" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="booking/booking.php">
                        <i class="Booking" aria-hidden="true"></i>
                        <span>Booking</span>
                    </a>
                </li>
                <li>
                    <a href="transaksi/transaksi.php">
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

        <section class="section-1">
            <h1>WELCOME</h1>
            <p>Admin</p>

            <div class="widget-container">
                <div class="widget">
                    <h2>Pesan Sekarang</h2>
                   
                </div>
                <div class="widget">
                    <h2>Diskon</h2>

                </div>
                <div class="widget">
                    <h2>Harga Ekonomis</h2>

                </div>
            </div>
        </section>
    </div>
</body>

</html>
