<section class="section">
	<div class="section-header">
		<h1>Edit Data Harga <?= $harga["nama_harga"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/index_harga') ?>">Data Harga</a></div>
			<div class="breadcrumb-item"><?= $harga["nama_harga"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_edit_harga/' . $harga['id_harga']) ?>" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/index_harga') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Harga
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama_harga'>Nama Harga</label>
						<input type="text" id="nama_harga" class="form-control" name="nama_harga" value="<?= $harga["nama_harga"] ?>" autofocus>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
