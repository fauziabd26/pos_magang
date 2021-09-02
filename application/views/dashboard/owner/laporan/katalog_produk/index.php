<section class="section">
	<div class="section-header">
		<h1>Laporan Katalog Produk</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Laporan Katalog Produk</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<a href="#" data-toggle="modal" data-target="#tambah-data" class="btn btn-primary">
							<i class="fas fa-user-plus mr-2"></i> Tambah Laporan
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
                                <th>Kategori Produk</th>
								<th>Foto Produk</th>
								<th>Satuan Produk</th>
                                <th>Harga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($katalog_produk as $no => $row) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $row["nama_produk"] ?></td>
									<td><?= $row["nama_kategori"] ?></td>
									<td><?= $row["nama_foto_produk"] ?></td>
                                    <td><?= $row["nama_satuan"] ?></td>
									<td><?= $row["nama_harga"] ?></td>
									<td>
										<a href="#" data-toggle="modal" data-target="#edit-data" class="btn btn-warning btn-sm">Ubah</a>
										<a href="#" data-toggle="modal" data-target="#hapus-data" class="btn btn-danger btn-sm">Hapus</a>
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
					<h4 class="modal-title">Tambah Laporan</h4>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Produk</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama_produk" placeholder="Tuliskan Nama Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Kategori Produk</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama_kategori" placeholder="Tuliskan Kategori Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Foto Produk</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama_foto_produk" placeholder="Tuliskan Foto Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Satuan Produk</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="satuan_produk" placeholder="Tuliskan Satuan Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Harga</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama_harga" placeholder="Tuliskan Harga Laporan">
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
						<label class="col-lg-5 col-sm-5 control-label">Nama Produk</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" value="<?= $row["nama_produk"] ?>">
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
						<label class="control-label">Apakah Anda Yakin ingin hapus???</label>
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