<section class="section">
	<div class="section-header">
		<h1>Laporan Transaksi</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Laporan Transaksi</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<a href="<?php echo base_url() . 'owner/pdf_transaksi'; ?>" target="_blank" class="btn btn-outline-danger">
							<i class="fas fa-file-pdf"></i> Unduh Laporan
						</a>
						
						<a href="<?php echo base_url('owner/excel_transaksi') ?>" target="_blank" class="btn btn-outline-success">
							<i class="fas fa-file-excel"></i> Unduh Laporan
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Tanggal Transaksi</th>
								<th>Nama Customer</th>
								<th>Jenis Transaksi</th>
								<th>Status</th>
								<th>Diskon</th>
								<th>Pembayaran</th>
								<th>Total Transaksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($transaksi)) { ?>
								<?php foreach ($transaksi as $no => $row) : ?>
									<tr>
										<td><?= ++$no ?></td>
										<td><?= format_indo($row["tggl_transaksi"]) ?></td>
										<td><?= $row["nama_cust"] ?></td>
										<td class="text-capitalize"><?= $row["jenis_transaksi"] ?></td>
										<td class="text-capitalize"><?= $row["status"] ?></td>
										<td><?= $row["diskon"] ?? '-' ?></td>
										<td>Rp<?= number_format($row["bayar"]) ?></td>
										<td>Rp <?= number_format($row["total_transaksi"]) ?></td>
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
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">??</button>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('admin/tambah') ?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<h4 class="modal-title">Tambah Laporan</h4>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Laporan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Laporan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Laporan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Laporan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Laporan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Laporan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-5 col-sm-5 control-label">Nama Laporan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Laporan">
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
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">??</button>
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
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">??</button>
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
