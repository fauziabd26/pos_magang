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

						<div class="col">
							<div class="form-divider">
								<i class="fas fa-user mr-2"></i> Identitas Diri
								<hr>
							</div>
							<div class="form-group">
								<label for="nama">Nama Lengkap</label>
								<input id="nama" type="text" class="form-control" name="nama" value="<?= set_value('nama', $this->session->userdata('nama')) ?>">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" type="email" class="form-control" name="email" value="<?= set_value('email', $this->session->userdata('email')) ?>">
							</div>
							<div class="form-group">
								<label for="no_hp">Nomer Handhphone</label>
								<input id="no_hp" type="number" class="form-control" name="no_hp" value="<?= set_value('no_hp', $this->session->userdata('no_hp')) ?>">
							</div>
							<div class="form-group">
								<label for='photo'>Foto KTP</label>
								<img src="<?= base_url('assets/ktp/ktp1.jpg') ?>" class="img-fluid">
								<input id="photo" type="file" class="form-control mt-4" name="photo">
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Update</button>
					<a href="<?= base_url('owner/dashboard') ?>" class="btn btn-outline-primary btn-block">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</section>
