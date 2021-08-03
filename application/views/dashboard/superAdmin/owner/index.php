<section class="section">
	<div class="section-header">
		<h1>Data Owner</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Owner</div>
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
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0 ?>
							<?php foreach ($owners as $owner) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $owner['user']['nama'] ?></td>
									<td><?= $owner["nama_toko"] ?? "-" ?></td>
									<td><?= $owner['user']['email'] ?></td>
									<td><?= $owner['user']['alamat'] ?></td>
									<td><?= $owner['user']['no_hp'] ?></td>
									<td>
										<a href="<?= base_url('superadmin/owner_edit/' . $owner["id_toko"]) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
										<a href="<?= base_url('superadmin/owner_detail/' . $owner["id_toko"]) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
