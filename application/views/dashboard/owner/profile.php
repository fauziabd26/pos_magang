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
			<form action="<?= base_url('profile/ubah_profile/' . $this->session->userdata('id_user')) ?>" method="POST" enctype="multipart/form-data">
				<div class="card-body">
					<?php if ($this->session->flashdata('success')) { ?>
						<div class="alert alert-success alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>×</span>
								</button>
								<i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('success') ?>
							</div>
						</div>
					<?php } elseif ($this->session->flashdata('error')) { ?>
						<div class="alert alert-danger alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>×</span>
								</button>
								<i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('error') ?>
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<div class="col">
							<div class="form-divider">
								<i class="fas fa-user mr-2"></i> Identitas Diri
								<hr>
							</div>
							<div class="form-group">
								<label for="nama">Nama Lengkap</label>
								<input id="nama" type="text" class="form-control" name="nama" value="<?= set_value('nama', $data['nama']) ?>">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" type="email" class="form-control" name="email" value="<?= set_value('email', $data['email']) ?>">
							</div>
							<div class="form-group">
								<label for="no_hp">Nomer Handhphone</label>
								<input id="no_hp" type="number" class="form-control" name="no_hp" value="<?= set_value('no_hp', $data['no_hp']) ?>">
							</div>
							<div class="form-group">
								<label for='photo'>Foto <small>*jika ingin mengganti foto</small></label>
								<img src="<?= base_url('assets/img/user/' . $data['photo']) ?>" class="img-fluid">
								<input id="photo" type="file" class="form-control mt-4 mb-2" name="photo">
								<small>*Format File Menggunakan IMG, PNG</small><br>
								<small>*File Maksimal Berukuran 2Mb</small>
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
