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
			<form action="<?= base_url('owner/proses_tambah_admin') ?>" method="POST" enctype="multipart/form-data">
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
							<a href="<?= base_url('owner/admin') ?>" class="btn btn-primary">
								<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Admin
							</a>
						</div>
					</div>
					<form action="<?= base_url('owner/proses_tambah_admin') ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for='id_toko' <?= form_error('id_toko') ? 'class=text-danger' : 'control-label' ?>>Pilih Toko</label>
							<div>
								<select name="id_toko" class="form-control select2 <?= form_error('id_toko') ? 'is-invalid' : '' ?>">
									<?php foreach ($tokos as $toko) : ?>
										<option value="<?= $toko["id_toko"] ?>"><?= $toko['nama_toko'] ?></option>
									<?php endforeach; ?>
								</select>
								<small class="text-danger font-weight-bold">
									<?= form_error('id_toko'); ?>
								</small>
							</div>
						</div>
						<div class="form-group">
							<label for='nama' <?= form_error('nama') ? 'class = text-danger' : '' ?>>Nama Lengkap</label>
							<input type="text" id="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" placeholder='Masukkan Nama Lengkap' value="<?= set_value('nama') ?>" autofocus>
							<small class="text-danger font-weight-bold">
								<?= form_error('nama'); ?>
							</small>
						</div>
						<div class="form-group">
							<label for='email' <?= form_error('email') ? 'class = text-danger' : '' ?>>Email</label>
							<input type="email" id="email" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" name="email" placeholder='Masukkan Email' value="<?= set_value('email') ?>">
							<small class="text-danger font-weight-bold">
								<?= form_error('email'); ?>
							</small>
						</div>
						<div class="row">
							<div class="form-group col-6">
								<label for="password" class="d-block <?= form_error('password') ? 'text-danger' : '' ?>">Password</label>
								<input id="password" type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" name="password" placeholder='Masukkan Password' value="<?= set_value('password'); ?>">
								<small class="text-danger font-weight-bold">
									<?= form_error('password'); ?>
								</small>
							</div>
							<div class="form-group col-6">
								<label for="password_confirm" class="d-block <?= form_error('password_confirm') ? 'text-danger' : '' ?>">Password Confirmation</label>
								<input id="password_confirm" type="password" class="form-control <?= form_error('password_confirm') ? 'is-invalid' : '' ?>" name="password_confirm" placeholder='Masukkan Password Confirmation' value="<?= set_value('password_confirm'); ?>">
								<small class="text-danger font-weight-bold">
									<?= form_error('password_confirm'); ?>
								</small>
							</div>
						</div>
						<div class="form-group">
							<label for='no_hp' <?= form_error('no_hp') ? 'class = text-danger' : '' ?>>Nomer Handphone</label>
							<input type="number" id="no_hp" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" placeholder='Masukkan Nomer Handphone' value="<?= set_value('no_hp'); ?>">
							<small class="text-danger font-weight-bold">
								<?= form_error('no_hp'); ?>
							</small>
						</div>
						<div class="form-group">
							<label for='photo' <?= form_error('photo') ? 'class = text-danger' : '' ?>>Foto Admin</label>
							<input type="file" id="photo" class="form-control <?= form_error('photo') ? 'is-invalid' : '' ?>" name="photo" value="<?= set_value('photo'); ?>" required>
							<small>*Format File Menggunakan IMG, PNG</small><br>
							<small>*File Maksimal Berukuran 2Mb</small>
							<small class="text-danger font-weight-bold">
								<?= form_error('photo'); ?>
							</small>
						</div>
				</div>
				<button class="btn btn-primary btn-block">Submit</button>
			</form>
		</div>
	</div>
</section>
