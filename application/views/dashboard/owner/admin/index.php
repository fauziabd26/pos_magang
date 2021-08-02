<section class="section">
	<div class="section-header">
		<h1>Data Admin</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Admin</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<a href="<?= base_url('owner/admin_tambah') ?>" class="btn btn-primary">
							<i class="fas fa-user-plus mr-2"></i> Tambah Data Admin
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Admin</th>
								<th>Email</th>
								<th>Alamat</th>
								<th>No Handphone</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0 ?>
							<?php foreach ($admins as $admin) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $admin["nama"] ?></td>
									<td><?= $admin["email"] ?></td>
									<td><?= $admin["alamat"] ?></td>
									<td><?= $admin["no_hp"] ?></td>
									<td>
										<a href="<?= base_url('owner/admin_edit/' . $admin["id"]) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
										<a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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