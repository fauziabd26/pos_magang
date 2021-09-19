<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Struk</title>
</head>

<body>
	<div class="col">
		<div class="heading">
			<h3><?= $transaksi['nama_toko'] ?></h3>
			<table>
				<tr>
					<td>Nama Kasir</td>
					<td>:</td>
					<td><?= $this->session->userdata('nama') ?></td>
				</tr>
				<tr>
					<td>Nomer Transaksi</td>
					<td>:</td>
					<td><?= $transaksi['id_transaksi'] ?></td>
				</tr>
				<tr>
					<td>Tanggal Transaksi</td>
					<td>:</td>
					<td><?= format_indo($transaksi['tggl_transaksi']) ?></td>
				</tr>
				<tr>
					<td>Nama Customer</td>
					<td>:</td>
					<td><?= $transaksi['nama_cust'] ?></td>
				</tr>
			</table>
		</div>
		<hr>
		<div class="main">
			<table style="table-layout: auto; width: 100%;">
				<thead>
					<tr>
						<td>No</td>
						<td>Nama Produk</td>
						<td>Qty</td>
						<td style="text-align: right;">Harga</td>
						<td style="text-align: right;">Subtotal</td>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($detail_transaksi as $data) : ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $data['nama_produk'] ?></td>
							<td><?= $data['qty'] ?></td>
							<td style="text-align: right;"><?= number_format($data['nominal']) ?></td>
							<td style="text-align: right;"><?= number_format($data['sub_total']) ?></td>
						</tr>
					<?php endforeach; ?>
					<tr style="text-align: right;">
						<td colspan="3" style="padding-top: 60px;"></td>
						<td>Total Harga :</td>
						<td><?= number_format($transaksi['total_transaksi']) ?></td>
					</tr>
					<tr style="text-align: right;">
						<td colspan="3"></td>
						<td>Uang Bayar :</td>
						<td><?= number_format($transaksi['bayar']) ?></td>
					</tr>
					<tr style="text-align: right;">
						<td colspan="3"></td>
						<td>Kembali :</td>
						<td><?= number_format($transaksi['bayar'] - $transaksi['total_transaksi']) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="footer">
			<h5>Terima Kasih Telah Berbelanja Di Toko Kami</h4>
		</div>
	</div>
</body>

</html>
