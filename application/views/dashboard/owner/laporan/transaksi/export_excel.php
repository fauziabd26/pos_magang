<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Laporan_transaksi.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
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