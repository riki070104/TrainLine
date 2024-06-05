<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

// Query untuk mengambil data dari tabel tb_transaksi
$sql = "SELECT * FROM tb_transaksi";
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
          <a href="../booking/booking.php">
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
          <a href="Logout.php">
            <i class="../Logout" aria-hidden="true"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- navbar end -->

    <div class="content">
      <h2>Data Transaksi Tiket Kereta Api</h2>
      <button onclick="window.location.href='transaksi-input.php'" class="add-button">Tambah Data</button>
      <button onclick="window.location.href='transaksi-cetak.php'" class="add-button">Cetak PDF</button>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keberangkatan</th>
            <th>Tujuan</th>
            <th>Jumlah Tiket</th>
            <th>Total Harga</th>
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
              echo "<td>" . $row["tanggal"] . "</td>";
              echo "<td>" . $row["keberangkatan"] . "</td>";
              echo "<td>" . $row["tujuan"] . "</td>";
              echo "<td>" . $row["jumlah_tiket"] . "</td>";
              echo "<td>" . $row["total_harga"] . "</td>";
              echo "<td>";
              echo "<button onclick=\"window.location.href='edit.php?id=" . $row['id_transaksi'] . "'\">Edit</button>";
              echo '<button type="button" class="btn-delete" data-id="' . $row['id_transaksi'] . '">Delete</button>';
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
<script>
    // Menggunakan event delegation untuk menangani klik pada tombol "Delete"
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("btn-delete")) {
            // Konfirmasi penghapusan
            if (confirm("Apakah Anda yakin ingin menghapus transaksi ini?")) {
                var deleteId = event.target.getAttribute("data-id");
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "transaksi-proses.php");

                var hiddenInput = document.createElement("input");
                hiddenInput.setAttribute("type", "hidden");
                hiddenInput.setAttribute("name", "delete_id");
                hiddenInput.setAttribute("value", deleteId);

                form.appendChild(hiddenInput);
                document.body.appendChild(form);

                form.submit();
            }
        }
    });
</script>

</html>
