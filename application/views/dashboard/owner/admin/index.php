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
						<a href="#" data-toggle="modal" data-target="#tambah-data" class="btn btn-primary">
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
									<td><?= $admin["no_hp"] ?></td>
									<td>
										<a href="<?= base_url('owner/admin_edit/' . $admin["id_user"]) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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
<!-- Modal Tambah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			</div>
			<form action="#" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<h4>
								Tambah Data Admin
							</h4>
						</div>
					</div>
					<div class="form-group">
						<label for='nama'>Nama Lengkap</label>
						<input type="text" id="nama" class="form-control" name="nama" placeholder='Masukkan Nama Lengkap' autofocus>
					</div>
					<div class="form-group">
						<label for='email'>Email</label>
						<input type="email" id="email" class="form-control" name="email" placeholder='Masukkan Email'>
					</div>
					<div class="row">
						<div class="form-group col-6">
							<label for="password" class="d-block">Password</label>
							<input id="password" type="password" class="form-control" name="password" placeholder='Masukkan Password'>
						</div>
						<div class="form-group col-6">
							<label for="password_confirm" class="d-block">Password Confirmation</label>
							<input id="password_confirm" type="password" class="form-control" name="password_confirm" placeholder='Masukkan Password Confirmation'>
						</div>
					</div>
					<div class="form-group">
						<label for='no_hp'>Nomer Handphone</label>
						<input type="number" id="no_hp" class="form-control" name="no_hp" placeholder='Masukkan Nomer Handphone'>
					</div>
					<div class="form-group mb-0">
						<label>Alamat Lengkap</label>
						<textarea class="form-control" placeholder="Masukan Alamat Lengkap"></textarea>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END Modal Tambah -->
<!-- Modal Hapus -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="hapus-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('admin/tambah') ?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<h4 class="modal-title">Hapus Data</h4>
					<div class="form-group">
						<label class="control-label">Apakah Anda Yaqin ingin hapus???</label>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-info" type="submit"> Ya&nbsp;</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"> Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END Modal Hapus -->
