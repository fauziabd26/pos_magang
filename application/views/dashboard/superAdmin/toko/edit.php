<section class="section">
	<div class="section-header">
		<h1>Edit Data Toko <?= $toko["nama_toko"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/toko') ?>">Data Toko</a></div>
			<div class="breadcrumb-item"><?= $toko["nama_toko"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('superadmin/proses_edit_toko') ?>" method="POST">
				<div class="card-body">
					<div class="row mb-5">
						<div class="col">
							<a href="<?= base_url('superadmin/toko') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Toko
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-divider">
								<i class="fas fa-store"></i> Identitas Toko
								<hr>
							</div>
							<div class="form-group">
								<label for='nama'>Nama Toko</label>
								<input type="text" id="nama" class="form-control" name="nama" value="<?= $toko["nama_toko"] ?? "-" ?>">
							</div>
							<div class="form-group">
								<label>Alamat Lengkap Toko</label>
								<textarea class="form-control"><?= $toko["alamat"] ?? "-" ?></textarea>
							</div>
							<div class="form-group">
								<label>Deskripsi Toko</label>
								<textarea class="form-control"><?= $toko["deskripsi_toko"] ?? "-" ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
