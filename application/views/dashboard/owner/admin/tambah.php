<section class="section">
	<div class="section-header">
		<h1>Tambah Data Admin</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/admin') ?>">Data Admin</a></div>
			<div class="breadcrumb-item">Tambah Data Admin</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="#" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('owner/admin') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Admin
							</a>
						</div>
					</div>
					<div class="form-group">
						<label for='nama'>Nama Lengkap</label>
						<input type="text" id="nama" class="form-control" name="nama" placeholder='Masukkan Nama Lengkap' autofocus>
					</div>
					<div class="form-group">
						<label for='email'>Email</label>
						<input type="email" id="email" class="form-control" name="email" placeholder='Masukkan Email'>
					</div>
					<div class="row">
						<div class="form-group col-6">
							<label for="password" class="d-block">Password</label>
							<input id="password" type="password" class="form-control" name="password" placeholder='Masukkan Password'>
						</div>
						<div class="form-group col-6">
							<label for="password_confirm" class="d-block">Password Confirmation</label>
							<input id="password_confirm" type="password" class="form-control" name="password_confirm" placeholder='Masukkan Password Confirmation'>
						</div>
					</div>
					<div class="form-group">
						<label for='no_hp'>Nomer Handphone</label>
						<input type="number" id="no_hp" class="form-control" name="no_hp" placeholder='Masukkan Nomer Handphone'>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</section>
