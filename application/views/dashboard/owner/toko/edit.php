<section class="section">
	<div class="section-header">
		<h1>Edit Data Toko <?= $toko["nama_toko"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/toko') ?>">Data Toko</a></div>
			<div class="breadcrumb-item"><?= $toko["nama_toko"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_edit_toko/' . $toko['id_toko']) ?>" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/toko') ?>" class="btn btn-primary">
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
					<div class="form-group">
						<label for='nama_toko'>Nama Toko</label>
						<input type="text" id="nama_toko" class="form-control" name="nama_toko" value="<?= $toko["nama_toko"] ?>" autofocus>
					</div>
					<div class="form-group">
						<label for='deskripsi_toko'>Deskripsi Toko</label>
						<textarea name="deskripsi_toko" id="deskripsi_toko" class="form-control"><?= $toko["deskripsi_toko"] ?></textarea>
					</div>
					<div class="form-group">
						<label for='alamat'>Alamat Toko</label>
						<textarea name="alamat" id="alamat" class="form-control"><?= $toko["alamat"] ?></textarea>
					</div>
					<div class="form-group">
						<label for='foto_toko'>Dokumen Toko <small>*Jika Ingin Mengganti Foto</small></label>
						<input type="file" id="foto_toko" class="form-control" name="foto_toko">
						<small>*File Maksimal Berukuran 2Mb</small>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
