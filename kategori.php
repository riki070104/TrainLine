<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="css/kategori.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <div class="body">
        <div class="category-container">
            <h2>Daftar Kategori Tiket Kereta Api</h2>
            <ul>
                <li>Tiket Ekonomi</li>
                <li>Tiket Bisnis</li>
                <li>Tiket Eksekutif</li>
                <li>Tiket VIP</li>
            </ul>
            <a href="trasaction.php" class="view-order-button">Lihat Pesanan</a>
            <a href="admin.php" class="back-button">Back to Dashboard</a>
        </div>
</body>

</html>