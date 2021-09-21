<section class="section">
	<div class="section-header">
		<h1>Edit Data Admin <?= $admin["nama"] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/admin') ?>">Data Admin</a></div>
			<div class="breadcrumb-item"><?= $admin["nama"] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<form action="<?= base_url('owner/proses_edit_admin/' . $admin['id_user']) ?>" method="POST">
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
						<?php echo form_error('nama'); ?>
						<input type="text" id="nama" class="form-control" name="nama" value="<?= set_value('nama', $admin['nama']) ?>" autofocus>
					</div>
					<div class="form-group">
						<label for='email'>Email</label>
						<?php echo form_error('email'); ?>
						<input type="email" id="email" class="form-control" name="email" value="<?= set_value('email', $admin['email']) ?>" autofocus>
					</div>
					<div class="form-group">
						<label for='no_hp'>Nomer Handphone</label>
						<?php echo form_error('no_hp'); ?>
						<input type="number" id="no_hp" class="form-control" name="no_hp" value="<?= set_value('no_hp', $admin['no_hp']) ?>" autofocus>
					</div>
					<a href="<?= base_url('owner/admin_ubah_password/' . $admin["id_user"]) ?>" class="btn btn-outline-primary btn-block">Ubah Password</a>
					<button class="btn btn-primary btn-block">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
