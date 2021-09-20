<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Katalog Produk</title>
    </head>
    <body>
        <div style="text-align:center">
            <h3> Laporan Katalog Produk </h3>
        </div>
        <div class="section-body">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table cellpadding="10" width="100%" >
								<thead class="thead-dark" align="center">
									<tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Kategori Produk</th>
                                        <th class="text-center">Satuan Produk</th>
                                        <th class="text-center">Harga</th>
									</tr>
								</thead>
								<?php if (!empty($katalog_produk)) { ?>
									<?php foreach ($katalog_produk as $no => $row) : ?>
										<tbody align="center">
											<tr>
												<td class="text-center"><?= ++$no ?></td>
												<td class="text-center"><?= $row["nama_produk"] ?></td>
												<td class="text-center"><?= $row["nama_kategori"] ?></td>
												<td class="text-center"><?= $row["nama_satuan"] ?></td>
												<td class="text-center"><?= $row["nama_harga"] ?></td>
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