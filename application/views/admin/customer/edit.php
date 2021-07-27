<section class="section">
	<div class="section-header">
		<h1>Edit Data Customer</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/customer') ?>">Data Customer</a></div>
			<div class="breadcrumb-item">Dimas Addriansyah</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="#" method="POST">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<a href="<?= base_url('admin/customer') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Customer
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
					<div class="form-group">
						<label for='no_hp'>Nomer Handphone</label>
						<input type="number" id="no_hp" class="form-control" name="no_hp" placeholder='Masukkan Nomer Handphone'>
					</div>
					<div class="form-group mb-0">
						<label>Alamat Lengkap</label>
						<textarea class="form-control" placeholder="Masukan Alamat Lengkap"></textarea>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</section>
