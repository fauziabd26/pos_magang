<section class="section">
	<div class="section-header">
		<h1>Dashboard Super Admin</h1>
	</div>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card card-statistic-2">
					<div class="card-stats mb-4">
						<div class="card-stats-title">Data Owner</div>
						<div class="card-stats-items">
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalPending ?> <i class="fas fa-ban" style="color: #fc544b;"></i></div>
								<div class="card-stats-item-label">Belum Valid</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalValid ?> <i class="fas fa-check" style="color: #47c363;"></i></div>
								<div class="card-stats-item-label">Valid</div>
							</div>
							<div class="card-stats-item">
								<div class="card-stats-item-count"><?= $totalOwner ?> <i class="fas fa-user" style="color: #6777ef;"></i></div>
								<div class="card-stats-item-label">Total</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header justify-content-between">
						<h4>Data Owner Belum Valid Terbaru</h4>
						<a href="<?= base_url('superadmin/validasiOwner') ?>" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right pl-2"></i></a>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive table-invoice">
							<table class="table table-striped">
								<thead>
									<th>No</th>
									<th>Nama Owner</th>
									<th>Nama Toko</th>
									<th>Email</th>
									<th>Alamat</th>
									<th>Nomer Handphone</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 0 ?>
									<?php foreach (array_slice($owners, 0, 5) as $owner) : ?>
										<tr>
											<td><?= ++$no ?></td>
											<?php foreach ($owner["user"] as $user) : ?>
												<td class="font-weight-600"><?= $user['nama'] ?></td>
											<?php endforeach; ?>
											<td><?= $owner["nama_toko"] ?? "-" ?></td>
											<?php foreach ($owner["user"] as $user) : ?>
												<td><?= $user['email'] ?></td>
											<?php endforeach; ?>
											<?php foreach ($owner["user"] as $user) : ?>
												<td><?= $user['alamat'] ?></td>
											<?php endforeach; ?>
											<?php foreach ($owner["user"] as $user) : ?>
												<td><?= $user['no_hp'] ?></td>
											<?php endforeach; ?>
											<td>
												<a href="<?= base_url('superadmin/validasiDetail/' . $owner["id"]) ?>" class="btn btn-primary">Detail</a>
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
