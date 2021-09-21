<section class="section">
	<div class="section-header">
		<h1>Edit Data Foto Produk <?= $foto_produks["nama_produk"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/index_foto_produk') ?>">Data Foto Produk</a></div>
			<div class="breadcrumb-item"><?= $foto_produks["nama_produk"] ?></div>
		</div>
	</div>
	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_edit_fotoProduk/' . $foto_produks['id_foto_produk']) ?>" method="POST" enctype="multipart/form-data">
				<div class="card-body">
					<?php if ($this->session->flashdata('error')) { ?>
						<div class="alert alert-danger alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>×</span>
								</button>
								<i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('error') ?>
							</div>
						</div>
					<?php } ?>
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/index_foto_produk') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Foto Produk
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama_produk' class="control-label">Nama Produk</label>
						<select name="id_produk" class="form-control">
							<option value=""><?= $foto_produks["nama_produk"] ?></option>
							<?php foreach ($produks as $produk) : ?>
								<option value="<?= $produk["id_produk"] ?>"><?= $produk['nama_produk'] ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for='nama_foto_produk'>Foto <small>*jika ingin mengganti foto</small></label>
						<div class="text-center">
							<img src="<?= base_url('assets/img/products/' . $foto_produks['nama_foto_produk']) ?>" class="my-2" width="200px" height="200px">
						</div>
						<input id="nama_foto_produk" type="file" class="form-control mt-4 mb-2" name="nama_foto_produk">
						<small>*Format File Menggunakan IMG, PNG</small><br>
						<small>*File Maksimal Berukuran 2Mb</small>
					</div>
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
