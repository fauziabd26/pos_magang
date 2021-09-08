<section class="section">
	<div class="section-header">
		<h1>Data Toko</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Toko</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
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
							<i class="fas fa-times mr-2"></i> <?= $this->session->flashdata('error') ?>
						</div>
					</div>
				<?php } ?>
				<div class="row mb-3">
					<div class="col">
						<a href="<?= base_url('owner/toko_tambah') ?>" class="btn btn-primary">
							<i class="fas fa-plus mr-2"></i> Tambah Data Toko
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Toko</th>
								<th>Deskripsi Toko</th>
								<th>Alamat</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($tokos)) { ?>
								<?php $no = 1;
								foreach ($tokos as $toko) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $toko["nama_toko"] ?></td>
										<td><?= $toko["deskripsi_toko"] ?></td>
										<td><?= $toko["alamat"] ?></td>
										<td>
											<?php if ($toko["status_toko"] == "valid") { ?>
												<span class="badge badge-success text-capitalize"><?= $toko["status_toko"] ?></span>
											<?php } elseif ($toko["status_toko"] == "pending") { ?>
												<span class="badge badge-warning text-capitalize"><?= $toko["status_toko"] ?></span>
											<?php } else { ?>
												<span class="badge badge-danger text-capitalize"><?= $toko["status_toko"] ?></span>
											<?php } ?>
										</td>
										<td>
											<a href="<?= base_url('owner/toko_edit/' . $toko["id_toko"]) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
											<!-- <a href="<?= base_url('owner/toko_hapus/' . $toko["id_toko"]) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
										</td>
									</tr>
								<?php endforeach; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal Tambah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('admin/tambah') ?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<h4 class="modal-title">Tambah Data</h4>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Harga</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Harga">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END Modal Tambah -->
<!-- Modal Edit -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('admin/tambah') ?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<h4 class="modal-title">Edit Data</h4>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Harga</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" value="<?= $harga["nama_harga"] ?>">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END Modal edit -->
<!-- Modal Hapus -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="hapus-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('admin/tambah') ?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<h4 class="modal-title">Hapus Data</h4>
					<div class="form-group">
						<label class="control-label">Apakah Anda Yaqin ingin hapus???</label>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-info" type="submit"> Ya&nbsp;</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"> Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END Modal Hapus -->
