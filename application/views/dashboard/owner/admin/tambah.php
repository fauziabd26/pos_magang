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
		<?php echo form_open_multipart();?>
			<form action="<?= base_url('owner/proses_tambah_admin') ?>" method="POST"  enctype="multipart/form-data">
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
					<div class="form-group">
						<label for='nama'>Nama Lengkap</label>
						<input type="text" id="nama" class="form-control" name="nama" placeholder='Masukkan Nama Lengkap' value="<?= set_value('nama') ?>" autofocus>
						<small class="text-danger font-weight-bold">
							<?php echo form_error('nama'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for='email'>Email</label>
						<input type="email" id="email" class="form-control" name="email" placeholder='Masukkan Email' value="<?= set_value('email') ?>">
						<small class="text-danger font-weight-bold">
							<?php echo form_error('email'); ?>
						</small>
					</div>
					<div class="row">
						<div class="form-group col-6">
							<label for="password" class="d-block">Password</label>
							<input id="password" type="password" class="form-control" name="password" placeholder='Masukkan Password' value="<?= set_value('password'); ?>">
							<small class="text-danger font-weight-bold">
							<?php echo form_error('password'); ?>
						</small>
						</div>
						<div class="form-group col-6">
							<label for="password_confirm" class="d-block">Password Confirmation</label>
							<input id="password_confirm" type="password" class="form-control" name="password_confirm" placeholder='Masukkan Password Confirmation' value="<?= set_value('password_confirm'); ?>">
							<small class="text-danger font-weight-bold">
							<?php echo form_error('password_confirm'); ?>
						</small>
						</div>
					</div>
					<div class="form-group">
						<label for='no_hp'>Nomer Handphone</label>
						<input type="number" id="no_hp" class="form-control" name="no_hp" placeholder='Masukkan Nomer Handphone' value="<?= set_value('no_hp'); ?>">
						<small class="text-danger font-weight-bold">
							<?php echo form_error('no_hp'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for='file'>Foto Admin</label>
						<?php echo form_error('photo'); ?>
						<input type="file" id="file" class="form-control" name="file" value="<?= set_value('photo'); ?>" />
						<!-- <input type="hidden" id="photo" name="old_image"  /> -->
						<small>*Format File Menggunakan IMG, PNG</small><br>
						<small>*File Maksimal Berukuran 2Mb</small>
						<small class="text-danger font-weight-bold">
							<?php echo form_error('photo'); ?>
						</small>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</section>