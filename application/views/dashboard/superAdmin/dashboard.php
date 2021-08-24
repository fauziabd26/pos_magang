<section class="section">
	<div class="section-header">
		<h1>Dashboard Super Admin</h1>
	</div>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card card-statistic-2">
					<div class="card-stats mb-4">
						<div class="card-stats-title">Data Toko</div>
						<div class="card-stats-items">
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalPending ?> <i class="fas fa-hourglass" style="color: blue;"></i></div>
								<div class="card-stats-item-label">Pending</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalValid ?> <i class="fas fa-check" style="color: #47c363;"></i></div>
								<div class="card-stats-item-label">Valid</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalTidakValid ?> <i class="fas fa-ban" style="color: #fc544b;"></i></div>
								<div class="card-stats-item-label">Tidak Valid</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalPending + $totalValid ?> <i class="fas fa-store" style="color: #6777ef;"></i></div>
								<div class="card-stats-item-label">Total</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header justify-content-between">
						<h4>Data Toko Belum Valid Terbaru</h4>
						<a href="<?= base_url('superadmin/validasi_toko') ?>" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right pl-2"></i></a>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive table-invoice">
							<table class="table table-striped">
								<thead>
									<th>No</th>
									<th>Nama Toko</th>
									<th>Nama Owner</th>
									<th>Alamat</th>
									<th>Deskripsi Toko</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach (array_slice($data, 0, 5) as $toko) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $toko["nama_toko"] ?? "-" ?></td>
											<td class="font-weight-600"><?= $toko['user']['nama'] ?? "-" ?></td>
											<td><?= $toko['alamat'] ?></td>
											<td><?= $toko['deskripsi_toko'] ?></td>
											<td>
												<a href="<?= base_url('superadmin/validasi_detail/' . $toko["id_toko"]) ?>" class="btn btn-primary">Detail</a>
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
