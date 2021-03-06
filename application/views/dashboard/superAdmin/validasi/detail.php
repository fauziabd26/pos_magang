<section class="section">
	<div class="section-header">
		<h1>Detail Data Toko Pending <?= $toko["nama_toko"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/toko') ?>">Data Toko</a></div>
			<div class="breadcrumb-item"><?= $toko["nama_toko"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-5">
					<div class="col">
						<a href="<?= base_url('superadmin/validasi_toko') ?>" class="btn btn-primary">
							<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Toko
						</a>
					</div>
					<div class="col text-right">
						<?php if ($toko["status_toko"] == "valid") { ?>
							<span class="btn btn-success text-capitalize">Status : <?= $toko["status_toko"] ?> <i class="fas fa-check ml-2"></i></span>
						<?php } elseif ($toko["status_toko"] == "pending") { ?>
							<span class="btn btn-warning text-capitalize">Status : <?= $toko["status_toko"] ?> <i class="fas fa-hourglass ml-2"></i></span>
						<?php } else { ?>
							<span class="btn btn-danger text-capitalize">Status : <?= $toko["status_toko"] ?> <i class="fas fa-ban ml-2"></i></span>
						<?php } ?>
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
							<input type="text" id="nama" class="form-control" value="<?= $toko["nama_toko"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label>Alamat Lengkap Toko</label>
							<textarea class="form-control" disabled><?= $toko["alamat"] ?? "-" ?></textarea>
						</div>
						<div class="form-group">
							<label>Deskripsi Toko</label>
							<textarea class="form-control" disabled><?= $toko["deskripsi_toko"] ?? "-" ?></textarea>
						</div>
					</div>
					<div class="col-6">
						<div class="form-divider">
							<i class="fas fa-user"></i> Identitas Pemilik
							<hr>
						</div>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input id="nama" class="form-control" value="<?= $toko["nama_owner"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" value="<?= $toko["email"] ?? "-" ?>" disabled>
						</div>
						<div class="form-group">
							<label for="no_hp">Nomer Handhphone</label>
							<input id="no_hp" class="form-control" value="<?= $toko["no_hp"] ?? "-" ?>" disabled>
						</div>
						<!-- <div class="form-group">
							<label for='foto_ktp'>Foto KTP</label>
							<img src="<?= base_url('assets/ktp/ktp1.jpg') ?>" class="img-fluid">
						</div> -->
					</div>
				</div>
			</div>
			<div class="card-footer">
				<a href="<?= base_url('superadmin/status_valid/' . $toko["id_toko"]) ?>" class="btn btn-success btn-block"><i class="fas fa-check mr-1"></i> Valid</a><br>
				<a href="<?= base_url('superadmin/status_tidak_valid/' . $toko["id_toko"]) ?>" class="btn btn-danger btn-block mt-2"><i class="fas fa-ban"></i> Tidak Valid</a>
			</div>
		</div>
	</div>
</section>
