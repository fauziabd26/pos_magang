<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title> Laporan Transaksi </title>
      <style>
           ::selection { background-color: #E13300; color: white; }
           ::-moz-selection { background-color: #E13300; color: white; }
 
           body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
           }
 
           main {
                width: 80%;
                padding: 20px;
                background-color: white;
                min-height: 300px;
                border-radius: 5px;
                margin: 30px auto;
                box-shadow: 0 0 8px #D0D0D0;
           }
           table {
                border-top: solid thin #000;
                border-collapse: collapse;
           }
           
           th, td {
                border-top: solid thin #000;
                padding: 6px 12px;
           }
 
           a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
           }

      </style>
 </head>
 
 <body>
      <main>
           <h1>Laporan Excel </h1>
           <p><a href="<?php echo base_url('owner/excel_transaksi_i') ?>">Export ke Excel</a></p>
           <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
						<th>Tanggal Transaksi</th>
						<th>Nama Customer</th>
						<th>Jenis Transaksi</th>
						<th>Status</th>
						<th>Diskon</th>
						<th>Pembayaran</th>
						<th>Total Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $no => $row) : ?>
					    <tr>
						    <td><?= ++$no ?></td>
						    <td><?= $row["tggl_transaksi"] ?></td>
						    <td><?= $row["nama_cust"] ?></td>
						    <td><?= $row["jenis_transaksi"] ?></td>
						    <td><?= $row["status"] ?></td>
						    <td><?= $row["diskon"] ?></td>
						    <td><?= $row["bayar"] ?></td>
						    <td><?= $row["total_transaksi"] ?></td>
					    </tr>
				    <?php endforeach; ?>
                </tbody>
           </table>
      </main>
 </body>
 </html>
