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
								<div class="card-stats-item-count"><?= $totalTransaksiProduk ?? '0' ?></div>
								<div class="card-stats-item-label">Produk</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item">
									<div class="card-stats-item-count"><?= $totalTransaksiJasa ?? '0' ?></div>
									<div class="card-stats-item-label">Jasa</div>
								</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item">
									<div class="card-stats-item-count"><?= $totalTransaksi ?? '0' ?></div>
									<div class="card-stats-item-label">Total</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header justify-content-between">
						<h4>Transaksi Terbaru</h4>
						<a href="<?= base_url('admin/histori_transaksi') ?>" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right pl-2"></i></a>
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
									<?php if (!empty($transaksis)) { ?>
										<?php foreach (array_slice($transaksis, 0, 5) as $transaksi) : ?>
											<tr>
												<td><?= $transaksi["id_transaksi"] ?></td>
												<td class="font-weight-600"><?= $transaksi["nama_cust"] ?></td>
												<td>
													<div class="badge <?= $transaksi['jenis_transaksi'] == 'produk' ? "badge-primary" : "badge-success" ?> text-capitalize"><?= $transaksi["jenis_transaksi"] ?></div>
												</td>
												<td><?= format_indo($transaksi["tggl_transaksi"]) ?></td>
												<td>
													<a href="<?= base_url('admin/histori_transaksi_detail/' . $transaksi["id_transaksi"]) ?>" class="btn btn-primary">Detail</a>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php } else { ?>
										<tr>
											<td colspan="5" class="text-center">Tidak Ada Data Transaksi Terbaru</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
