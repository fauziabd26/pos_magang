<section class="section">
	<div class="section-header">
		<h1>Data Owner</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Owner</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="#" method="POST">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-divider">
								<i class="fas fa-store"></i> Identitas Toko
								<hr>
							</div>
							<div class="form-group">
								<label for='nama'>Nama Toko</label>
								<input type="text" id="nama" class="form-control" name="nama" placeholder='Masukkan Nama Toko' autofocus>
							</div>
							<div class="form-group">
								<label>Alamat Lengkap Toko</label>
								<textarea class="form-control" placeholder="Masukan Alamat Toko Lengkap"></textarea>
							</div>
							<div class="form-group">
								<label>Deskripsi Toko</label>
								<textarea class="form-control" placeholder="Masukan Deskripsi Toko"></textarea>
							</div>
						</div>
						<div class="col-6">
							<div class="form-divider">
								<i class="fas fa-user"></i> Identitas Diri
								<hr>
							</div>
							<div class="form-group">
								<label for="nama">Nama Lengkap</label>
								<input id="nama" type="text" class="form-control" name="nama" placeholder="Masukan Nama Lengkap">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" type="email" class="form-control" name="email" placeholder="Masukan Email">
							</div>
							<div class="form-group">
								<label for="no_hp">Nomer Handhphone</label>
								<input id="no_hp" type="number" class="form-control" name="no_hp" placeholder="Masukan Nomer Handphone">
							</div>
							<div class="form-group">
								<label for='foto_ktp'>Foto KTP</label>
								<img src="<?= base_url('assets/ktp/ktp1.jpg') ?>" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
