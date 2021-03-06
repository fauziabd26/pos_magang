<section class="section">
	<div class="section-header">
		<h1>Ubah Password Admin</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/admin') ?>">Data Admin</a></div>
			<div class="breadcrumb-item">Ubah Password Admin</div>
		</div>
	</div>
	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_ubah_password/' . $admin['id_user']) ?>" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/admin') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Admin
							</a>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-6">
							<label for="password" class="d-block">Password Baru</label>
							<input id="password" type="password" class="form-control" name="password" placeholder='Masukkan Password Baru'>
						</div>
						<div class="form-group col-6">
							<label for="password_confirm" class="d-block">Password Confirmation</label>
							<input id="password_confirm" type="password" class="form-control" name="password_confirm" placeholder='Masukkan Password Confirmation'>
						</div>
					</div>
					<button class="btn btn-primary btn-block">Update Password</button>
				</div>
			</form>
		</div>
	</div>
</section>
