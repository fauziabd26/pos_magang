<section class="section">
	<div class="section-header">
		<h1>Tambah Data Toko</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/toko') ?>">Data Toko</a></div>
			<div class="breadcrumb-item">Tambah Data Toko</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_tambah_toko') ?>" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/toko') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Toko
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama_toko'>Nama Toko</label>
						<input type="text" id="nama_toko" class="form-control" name="nama_toko" placeholder="Masukan Nama Toko" autofocus>
					</div>
					<div class="form-group">
						<label for='deskripsi_toko'>Deskripsi Toko</label>
						<textarea name="deskripsi_toko" id="deskripsi_toko" class="form-control" placeholder="Masukan Deskripsi Toko"></textarea>
					</div>
					<div class="form-group">
						<label for='alamat'>Alamat Toko</label>
						<textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat Toko"></textarea>
					</div>
					<div class="form-group">
						<label for='foto_toko'>Dokumen Toko</label>
						<input type="file" id="foto_toko" class="form-control" name="foto_toko">
						<small>*Format File Menggunakan PDF, IMG, PNG</small><br>
						<small>*File Maksimal Berukuran 2Mb</small>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</section>
