<section class="section">
	<div class="section-header">
		<h1>Dashboard Admin</h1>
	</div>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card card-statistic-2">
					<div class="card-stats mb-4">
						<div class="card-stats-title">Data Transaksi</div>
						<div class="card-stats-items">
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalTransaksiProduk ?></div>
								<div class="card-stats-item-label">Produk</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalTransaksiJasa ?></div>
								<div class="card-stats-item-label">Jasa</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalTransaksiProduk + $totalTransaksiJasa ?></div>
								<div class="card-stats-item-label">Total Transaksi</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header justify-content-between">
							<h4>Transaksi Terbaru</h4>
							<a href="<?= base_url('admin/historiTransaksi') ?>" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right pl-2"></i></a>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive table-invoice">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nomer Transaksi</th>
										<th>Nama Customer</th>
										<th>Jenis Transaksi</th>
										<th>Tanggal</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach (array_slice($transaksis, 0, 5) as $no => $transaksi) : ?>
										<tr>
											<td><?= $transaksi["id"] ?></td>
											<td class="font-weight-600"><?= $transaksi["nama_customer"] ?></td>
											<td>
												<div class="badge <?= $transaksi['jenis'] == 'produk' ? "badge-primary" : "badge-success" ?> text-capitalize"><?= $transaksi["jenis"] ?></div>
											</td>
											<td><?= date_indo($transaksi["tgl_transaksi"]) ?></td>
											<td>
												<a href="<?= base_url('admin/historiTransaksiDetail/' . $transaksi["id"]) ?>" class="btn btn-primary">Detail</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
