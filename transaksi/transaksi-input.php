<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
include "../koneksi.php";

// Ambil data keberangkatan dari tb_pesanan
$sql_keberangkatan = "SELECT DISTINCT keberangkatan FROM tb_pesanan";
$result_keberangkatan = $conn->query($sql_keberangkatan);
$keberangkatan_options = '';
if ($result_keberangkatan->num_rows > 0) {
    while ($row_keberangkatan = $result_keberangkatan->fetch_assoc()) {
        $keberangkatan_options .= "<option value='" . htmlspecialchars($row_keberangkatan['keberangkatan']) . "'>" . htmlspecialchars($row_keberangkatan['keberangkatan']) . "</option>";
    }
}

$conn->close();
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
                    <a href="../Admin.php">
                        <i class="Dashboard" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../booking/booking.php">
                        <i class="Booking" aria-hidden="true"></i>
                        <span>Booking</span>
                    </a>
                </li>
                <li>
                    <a href="transaksi.php">
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
                <h2><?php echo isset($_GET['id']) ? 'Edit' : 'Tambah'; ?> Pemesanan Tiket Kereta Api</h2>
                <form id="bookingForm" action="transaksi-proses.php" method="POST">
                    <input type="hidden" name="id_transaksi" value="<?php echo htmlspecialchars($id_transaksi); ?>">
                    <label for="keberangkatan">Keberangkatan:</label>
                    <select id="keberangkatan" name="keberangkatan" required>
                        <option value="">Pilih Keberangkatan</option>
                        <?php echo $keberangkatan_options; ?>
                    </select>
                    <label>
                    <div class="button-group">
                        <button type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Tambah'; ?></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Content End -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#keberangkatan').change(function() {
                var selectedKeberangkatan = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'get_transaksi_data.php', // Change this to your actual PHP file to fetch data
                    data: {
                        keberangkatan: selectedKeberangkatan
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#tujuan').val(data.tujuan);
                        $('#tanggal').val(data.tanggal);
                        $('#jml_tiket').val(data.jml_tiket);
                        $('#total_harga').val(data.total_harga);
                    },
                    error: function(xhr, status, error) {
                        console.error(status + ": " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>