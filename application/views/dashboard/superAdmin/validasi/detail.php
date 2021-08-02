<section class="section">
	<div class="section-header">
		<h1>Detail Data Owner Belum Valid <?= $owner["user"]["nama"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/owner') ?>">Data Owner</a></div>
			<div class="breadcrumb-item"><?= $owner["user"]["nama"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-5">
					<div class="col">
						<a href="<?= base_url('superadmin/validasi_owner') ?>" class="btn btn-primary">
							<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Owner
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-divider">
							<i class="fas fa-store"></i> Identitas Toko
							<hr>
						</div>
						<div class="form-group">
							<label for='nama'>Nama Toko</label>
							<input type="text" id="nama" class="form-control" value="<?= $owner["nama_toko"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label>Alamat Lengkap Toko</label>
							<textarea class="form-control" disabled><?= $owner["alamat"] ?? "-" ?></textarea>
						</div>
						<div class="form-group">
							<label>Deskripsi Toko</label>
							<textarea class="form-control" disabled><?= $owner["deskripsi_toko"] ?? "-" ?></textarea>
						</div>
					</div>
					<div class="col-6">
						<div class="form-divider">
							<i class="fas fa-user"></i> Identitas Diri
							<hr>
						</div>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input id="nama" class="form-control" value="<?= $owner["user"]["nama"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" value="<?= $owner["user"]["email"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label for="no_hp">Nomer Handhphone</label>
							<input id="no_hp" class="form-control" value="<?= $owner["user"]["no_hp"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label for='foto_ktp'>Foto KTP</label>
							<img src="<?= base_url('assets/ktp/ktp1.jpg') ?>" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-success btn-block"><i class="fas fa-check"></i> Valid</button>
				<button class="btn btn-danger btn-block"><i class="fas fa-ban"></i> Tidak Valid</button>
			</div>
		</div>
	</div>
</section>
