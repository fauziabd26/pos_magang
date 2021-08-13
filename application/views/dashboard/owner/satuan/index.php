<section class="section">
	<div class="section-header">
		<h1>Satuan</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Satuan</div>
		</div>
	</div>


	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<a href="#" data-toggle="modal" data-target="#tambah-data" class="btn btn-primary">
							<i class="fas fa-plus mr-2"></i> Tambah Data Satuan
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Satuan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($satuans as $no => $satuan) : ?>
								<tr>
									<td><?= $satuan["id"] ?></td>
									<td><?= $satuan["nama_satuan"] ?></td>
									<td>
										<a href="#" data-toggle="modal" data-target="#edit-data" class="btn btn-warning">Ubah</a>
										<a href="#" data-toggle="modal" data-target="#hapus-data" class="btn btn-danger">Hapus</a>
									</td>
								</tr>
							<?php endforeach; ?>
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
						<label class="col-lg-5 col-sm-5 control-label">Nama Satuan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Satuan">
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
						<label class="col-lg-5 col-sm-5 control-label">Nama Satuan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" value="<?= $satuan["nama_satuan"] ?>">
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
