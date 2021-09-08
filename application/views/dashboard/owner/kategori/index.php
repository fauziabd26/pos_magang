<section class="section">
	<div class="section-header">
		<h1>Kategori</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Kategori</div>
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
							<i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('error') ?>
						</div>
					</div>
				<?php } ?>
				<div class="row mb-3">
					<div class="col">
						<a href="<?= base_url('owner/kategori_tambah') ?>" class="btn btn-primary">
							<i class="fas fa-plus mr-2"></i> Tambah Data Kategori
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($kategories)) { ?>
								<?php $no = 1;
								foreach ($kategories as $no => $kategori) : ?>
									<tr>
										<td><?= ++$no; ?></td>
										<td><?= $kategori["nama_kategori"] ?></td>
										<td>
											<a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
											<a href="#" data-toggle="modal" data-target="#hapus-data<?= $kategori['id_kategori'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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

<!-- Modal Hapus -->
<?php if (!empty($kategories)) { ?>
	<?php foreach ($kategories as $kategori) : ?>
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="hapus-data<?= $kategori['id_kategori'] ?>" class="modal fade">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Hapus Data <?= $kategori['nama_kategori'] ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Apakah Anda Yakin Ingin Hapus ???</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<a href="<?= base_url('owner/proses_hapus_kategori/' . $kategori['id_kategori']) ?>" class="btn btn-danger">Ya, Hapus</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php } ?>

<!-- <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			</div>
			<form class="form-horizontal" action="<?= base_url('owner/tambah') ?>" method="post">
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
	</div> -->
<!-- END Modal Hapus -->
