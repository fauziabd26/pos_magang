<section class="section">
	<div class="section-header">
		<h1>Data Toko</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Toko</div>
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
								<th>Nama Toko</th>
								<th>Alamat</th>
								<th>Nama Owner</th>
								<th>Email</th>
								<th>No Handphone</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0 ?>
							<?php foreach ($data as $toko) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $toko["nama_toko"] ?? "-" ?></td>
									<td><?= $toko['alamat'] ?></td>
									<td><?= $toko['user']['nama'] ?></td>
									<td><?= $toko['user']['email'] ?></td>
									<td><?= $toko['user']['no_hp'] ?></td>
									<td>
										<a href="<?= base_url('superadmin/toko_edit/' . $toko["id_toko"]) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
										<a href="<?= base_url('superadmin/toko_detail/' . $toko["id_toko"]) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
