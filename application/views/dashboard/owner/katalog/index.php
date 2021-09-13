<section class="section">
	<div class="section-header">
		<h1>Katalog Produk</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Katalog Produk</div>
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
						<a href="<?= base_url('owner/katalog_tambah') ?>" class="btn btn-primary">
							<i class="fas fa-plus mr-2"></i> Tambah Data Katalog Produk
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Toko</th>
								<th>Nama Produk</th>
								<th>Kategori</th>
								<th>Satuan</th>
								<th>Nama Harga</th>
								<th>Nominal</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($katalog as $no => $row) : ?>
								<tr>
									<td><?= ++$no; ?></td>
									<td><?= $row["nama_toko"] ?? '-' ?></td>
									<td><?= $row["nama_produk"] ?></td>
									<td><?= $row["nama_kategori"] ?></td>
									<td><?= $row["nama_satuan"] ?></td>
									<td><?= $row["nama_harga"] ?></td>
									<td>Rp <?= number_format($row["nominal"]) ?></td>
									<td>
										<a href="<?= base_url('owner/katalog_edit/' . $row["id_detail_produk"]) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Ubah</a>
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
