<section class="section">
	<div class="section-header">
		<h1>Edit Data kategori <?= $kategori["nama_kategori"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/index_kategori') ?>">Data kategori</a>
			</div>
			<div class="breadcrumb-item"><?= $kategori["nama_kategori"] ?></div>
		</div>
	</div>
	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_edit_kategori/' . $kategori['id_kategori']) ?>" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/index_kategori') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Kategori
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama_kategori'>Nama Kategori</label>
						<input type="text" id="nama_kategori" class="form-control" name="nama_kategori" value="<?= $kategori["nama_kategori"] ?>" autofocus>
					</div>
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
