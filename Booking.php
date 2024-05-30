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
    <title>Pemesanan</title>
    <link rel="stylesheet" href="css/booking.css">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <div class="body">
        <div class="booking-container">
            <h2>Pemesanan Tiket Kereta Api</h2>
            <form action="#" method="POST">
                <label for="departure">Keberangkatan:</label>
                <input type="text" id="departure" name="departure" required>
                <label for="destination">Tujuan:</label>
                <input type="text" id="destination" name="destination" required>
                <label for="date">Tanggal Keberangkatan:</label>
                <input type="date" id="date" name="date" required>
                <button type="submit">Pesan</button>
            </form>
            <div class="button-group">
                <a href="admin.php" class="back-button">Back</a>
                <a href="kategori.php" class="continue-button">Next</a>
                <button onclick="window.location.href='#'" class="edit-button">Edit</button>
                <button onclick="window.location.href='#'" class="add-button">Tambah</button>
            </div>
        </div>
    </div>
</body>

</html>
