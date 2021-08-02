<section class="section">
	<div class="section-header">
		<h1>Edit Data Admin <?= $admin["nama"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/admin') ?>">Data Admin</a></div>
			<div class="breadcrumb-item"><?= $admin["nama"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="#" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/admin') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Admin
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama'>Nama Lengkap</label>
						<input type="text" id="nama" class="form-control" name="nama" value="<?= $admin["nama"] ?>" autofocus>
					</div>
					<div class="form-group">
						<label for='email'>Email</label>
						<input type="email" id="email" class="form-control" name="email" value="<?= $admin["email"] ?>">
					</div>
					<div class="form-group">
						<label for='no_hp'>Nomer Handphone</label>
						<input type="number" id="no_hp" class="form-control" name="no_hp" value="<?= $admin["no_hp"] ?>">
					</div>
					<div class="form-group mb-0">
						<label>Alamat Lengkap</label>
						<textarea class="form-control"><?= $admin["alamat"] ?></textarea>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?= base_url('owner/admin_ubah_password') ?>" class="btn btn-outline-primary btn-block">Ubah Password</a>
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
