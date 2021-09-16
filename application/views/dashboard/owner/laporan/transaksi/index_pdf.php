<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Transaksi</title>
    </head>
    <body>
        <div style="text-align:center">
            <h3> Laporan Transaksi </h3>
        </div> 
        <div class="section-body">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table cellpadding="10" width="100%" >
								<thead class="thead-dark" align="center">
									<tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Jenis Transaksi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Diskon</th>
                                        <th class="text-center">Pembayaran</th>
                                        <th class="text-center">Total Transaksi</th>
									</tr>
								</thead>
								<?php if (!empty($transaksi)) { ?>
									<?php foreach ($transaksi as $no => $row) : ?>
										<tbody align="center">
											<tr>
												<td class="text-center"><?= ++$no ?></td>
												<td class="text-center"><?= $row["tggl_transaksi"] ?></td>
												<td class="text-center"><?= $row["nama_cust"] ?></td>
												<td class="text-center"><?= $row["jenis_transaksi"] ?></td>
												<td class="text-center"><?= $row["status"] ?></td>
                                                <td class="text-center"><?= $row["diskon"] ?></td>
												<td class="text-center"><?= $row["bayar"] ?></td>
												<td class="text-center"><?= $row["total_transaksi"] ?></td>
											</tr>
										</tbody>
									<?php endforeach; ?>
								<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>