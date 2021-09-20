<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Katalog Produk</title>
		<style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #d3d3d3;
                color: black;
            }
        </style>
    </head>
    <body>
        <div style="text-align:center">
            <h3> Laporan Katalog Produk </h3>
        </div><br>
        <div class="section-body">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="table">
								<thead class="thead-dark">
									<tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori Produk</th>
                                        <th>Satuan Produk</th>
                                        <th>Harga</th>
									</tr>
								</thead>
								<?php if (!empty($katalog_produk)) { ?>
									<?php foreach ($katalog_produk as $no => $row) : ?>
										<tbody>
											<tr>
												<td><?= ++$no ?></td>
												<td><?= $row["nama_produk"] ?></td>
												<td><?= $row["nama_kategori"] ?></td>
												<td><?= $row["nama_satuan"] ?></td>
												<td><?= $row["nama_harga"] ?></td>
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