<section class="section">
	<div class="section-header">
		<h1>Data Owner Belum Valid</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Owner Belum Valid</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Owner</th>
								<th>Nama Toko</th>
								<th>Email</th>
								<th>Alamat</th>
								<th>No Handphone</th>
								<th width="15%">Validasi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0 ?>
							<?php foreach ($owners as $owner) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<?php foreach ($owner["user"] as $user) : ?>
										<td><?= $user['nama'] ?></td>
									<?php endforeach; ?>
									<td><?= $owner["nama_toko"] ?? "-" ?></td>
									<?php foreach ($owner["user"] as $user) : ?>
										<td><?= $user['email'] ?></td>
									<?php endforeach; ?>
									<?php foreach ($owner["user"] as $user) : ?>
										<td><?= $user['alamat'] ?></td>
										<?php foreach ($owner["user"] as $user) : ?>
											<td><?= $user['no_hp'] ?></td>
										<?php endforeach; ?>
									<?php endforeach; ?>
									<td>
										<a href="#" class="btn btn-success btn-sm"><i class="fas fa-check mr-1"></i> Valid</a><br>
										<a href="#" class="btn btn-danger btn-sm mt-2"><i class="fas fa-ban"></i> Belum Valid</a>
									</td>
									<td>
										<a href="<?= base_url('superadmin/validasi_detail/' . $owner["id"]) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
