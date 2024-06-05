<?php
include '../koneksi.php';
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

// Inisialisasi Dompdf
$dompdf = new Dompdf();

// Query untuk mengambil data dari tabel tb_transaksi
$query = mysqli_query($conn, "SELECT * FROM tb_transaksi");

// HTML untuk isi PDF
$html = '<center><h3>Data Transaksi Tiket Kereta Api</h3></center><hr/><br>';
$html .= '<table border="1" width="100%" cellpadding="10" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keberangkatan</th>
                <th>Tujuan</th>
                <th>Jumlah Tiket</th>
                <th>Total Harga</th>
              </tr>
            </thead>
            <tbody>';

$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= '<tr>
                <td>' . $no . '</td>
                <td>' . $row['tanggal'] . '</td>
                <td>' . $row['keberangkatan'] . '</td>
                <td>' . $row['tujuan'] . '</td>
                <td>' . $row['jumlah_tiket'] . '</td>
                <td>' . $row['total_harga'] . '</td>
              </tr>';
    $no++;
}

$html .= '</tbody></table>';

// Load HTML ke Dompdf
$dompdf->loadHtml($html);

// Set ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Output file PDF ke browser
$dompdf->stream("laporan_transaksi.pdf", array("Attachment" => 0));
?>
