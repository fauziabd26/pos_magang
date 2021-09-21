<section class="section">
	<div class="section-header">
		<h1>Edit Data Produk Jasa <?= $jasas["nama_produk"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/produk') ?>">Data Produk</a></div>
			<div class="breadcrumb-item"><?= $jasas["nama_produk"] ?></div>
		</div>
	</div>
	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_edit_jasa/' . $jasas['id_produk']) ?>" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/produk') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Produk
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama_produk' class="control-label">Nama produk</label>
						<input type="text" id="nama_produk" class="form-control" name="nama_produk" value="<?= $jasas["nama_produk"] ?>" autofocus>
					</div>
					<div class="form-group">
						<label for='jenis' class="control-label">Jenis Produk</label>
						<input type="text" id="jenis" class="form-control" name="jenis" value="Jasa" readonly>
					</div>
					<div class="form-group">
						<label for='nominal' class="control-label">Pilih Toko</label>
						<select name="id_toko" class="form-control">
							<?php foreach ($tokos as $toko) : ?>
								<option value="<?= $toko["id_toko"] ?>"><?= $toko['nama_toko'] ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
