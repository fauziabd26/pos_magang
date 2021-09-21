<section class="section">
	<div class="section-header">
		<h1>Dashboard Owner</h1>
	</div>

	<div class="section-body">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
				<div class="card card-statistic-2">
					<div class="card-stats">
						<div class="card-stats-title">Katalog Produk</div>
						<div class="card-stats-items">
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalProdukBarang ?? '0' ?></div>
								<div class="card-stats-item-label">Barang</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalProdukJasa ?? '0' ?></div>
								<div class="card-stats-item-label">Jasa</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalProdukBarang + $totalProdukJasa ?? '0' ?>
								</div>
								<div class="card-stats-item-label">Total</div>
							</div>
						</div>
					</div>
					<div class="col mt-3">
						<a href="<?= base_url('owner/katalog') ?>" class="card card-statistic-1" style="text-decoration: none">
							<div class="card-icon shadow-primary bg-primary">
								<i class="fas fa-archive"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Total Katalog Produk</h4>
								</div>
								<div class="card-body">
									<div class="count"><?= $totalProdukBarang + $totalProdukJasa ?? '0' ?></div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="card card-statistic-2">
					<div class="row mx-1 mt-4">
						<div class="col-6">
							<a href="<?= base_url('owner/admin') ?>" class="card card-statistic-1" style="text-decoration: none">
								<div class="card-icon bg-primary">
									<i class="fas fa-user"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Data Admin</h4>
									</div>
									<div class="card-body">
										<div class="count"><?= $totalAdmin ?></div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-6">
							<a href="<?= base_url('owner/index_satuan') ?>" class="card card-statistic-1" style="text-decoration: none">
								<div class="card-icon bg-primary">
									<i class="fas fa-clipboard-list"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Data Satuan</h4>
									</div>
									<div class="card-body">
										<div class="count"><?= $totalSatuan ?></div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-6">
							<a href="<?= base_url('owner/index_kategori') ?>" class="card card-statistic-1" style="text-decoration: none">
								<div class="card-icon bg-primary">
									<i class="fas fa-clipboard-list"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Data Kategori</h4>
									</div>
									<div class="card-body">
										<div class="count"><?= $totalKategori ?></div>

									</div>
								</div>
							</a>
						</div>
						<div class="col-6">
							<a href="<?= base_url('owner/index_harga') ?>" class="card card-statistic-1" style="text-decoration: none">
								<div class="card-icon bg-primary">
									<i class="fas fa-coins"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Data Harga</h4>
									</div>
									<div class="card-body">
										<div class="count"><?= $totalHarga ?></div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Produk Terbaru</h4>
					</div>
					<div class="card-body">
						<div class="owl-carousel owl-theme" id="products-carousel">
							<?php if (!empty($produks)) { ?>
								<?php foreach (array_slice($produks, 0, 6) as $produk) : ?>
									<div>
										<div class="product-item pb-3">
											<div class="product-image">
												<img alt="image" src="../assets/img/products/product-4-50.png" class="img-fluid">
											</div>
											<div class="product-details">
												<div class="product-name"><?= $produk['nama_produk'] ?></div>
												<div class="text-capitalize text-muted text-small"><?= $produk['nama_kategori'] ?></div>
												<div class="text-capitalize text-muted text-small mb-2"><?= $produk['jenis'] ?></div>
												<div class="text-primary font-weight-bold">Rp <?= number_format($produk['nominal']) ?> / <?= $produk['nama_satuan'] ?></div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							<?php } else { ?>
								<p>Gada</p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Transaksi Terbaru</h4>
						<div class="card-header-action">
							<a href="<?= base_url('owner/index_laporan_trans') ?>" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right pl-2"></i></a>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive table-invoice">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nomer Transaksi</th>
										<th>Tanggal Transaksi</th>
										<th>Nama Customer</th>
										<th>Total Transaksi</th>
										<th>Jenis Transaksi</th>
										<th>Nama Toko</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($transaksis)) { ?>
										<?php foreach (array_slice($transaksis, 0, 5) as $no => $transaksi) : ?>
											<tr>
												<td><?= $transaksi["id_transaksi"] ?></td>
												<td><?= format_indo($transaksi["tggl_transaksi"]) ?></td>
												<td class="font-weight-600"><?= $transaksi["nama_cust"] ?></td>
												<td>Rp <?= number_format($transaksi["total_transaksi"]) ?></td>
												<td>
													<div class="badge <?= $transaksi['jenis_transaksi'] == 'barang' ? "badge-primary" : "badge-success" ?> text-capitalize">
														<?= $transaksi["jenis_transaksi"] ?></div>
												</td>
												<td><?= $transaksi["nama_toko"] ?></td>
											</tr>
										<?php endforeach; ?>
									<?php } else { ?>
										<tr>
											<td colspan="6" class="text-center">Tidak Ada Transaksi Terbaru</td>
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
