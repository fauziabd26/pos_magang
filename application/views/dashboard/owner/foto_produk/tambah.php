<section class="section">
	<div class="section-header">
		<h1>Tambah Data Foto Produk</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/foto_produk_tambah') ?>">Data Foto
					Produk</a></div>
			<div class="breadcrumb-item">Tambah Data Foto Produk</div>
		</div>
	</div>
	<div class="section-body">
		<div class="card">
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
				<form action="<?= base_url('owner/proses_tambah_fotoProduk') ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for='nominal'>Pilih Produk</label>
						<div>
							<select name="id_produk" class="form-control">
								<?php foreach ($produks as $produk) : ?>
									<option value="<?= $produk["id_produk"] ?>"><?= $produk['nama_produk'] ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small class="text-danger font-weight-bold">
								<?php echo form_error('id_produk'); ?>
							</small>
						</div>
					</div>
					<div class="form-group">
						<label for='nama_foto_produk'>Foto Produk</label>
						<?php echo form_error('nama_foto_produk'); ?>
						<input type="file" id="nama_foto_produk" class="form-control" name="nama_foto_produk" value="<?= set_value('nama_foto_produk'); ?>" />
						<small>*Format File Menggunakan IMG, PNG</small><br>
						<small>*File Maksimal Berukuran 2Mb</small>
						<small class="text-danger font-weight-bold">
							<?php echo form_error('nama_foto_produk'); ?>
						</small>
					</div>
					<button class="btn btn-primary btn-block">Submit</button>
				</form>
			</div>
		</div>
	</div>
</section>
