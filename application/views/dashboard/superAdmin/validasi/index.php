<section class="section">
	<div class="section-header">
		<h1>Data Toko Pending</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Toko Pending</div>
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
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Toko</th>
								<th>Nama Owner</th>
								<th>Alamat</th>
								<th>Deskripsi Toko</th>
								<th>Dokumen Toko</th>
								<th width="15%">Validasi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data as $toko) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $toko["nama_toko"] ?? "-" ?></td>
									<td><?= $toko['nama_owner'] ?? "-" ?></td>
									<td><?= $toko['alamat'] ?></td>
									<td><?= $toko['deskripsi_toko'] ?></td>
									<td><?= $toko['foto_toko'] ?? "-" ?></td>
									<td>
										<a href="<?= base_url('superadmin/status_valid/' . $toko["id_toko"]) ?>" class="btn btn-success btn-sm"><i class="fas fa-check mr-1"></i> Valid</a><br>
										<a href="<?= base_url('superadmin/status_tidak_valid/' . $toko["id_toko"]) ?>" class="btn btn-danger btn-sm mt-2"><i class="fas fa-ban"></i> Tidak Valid</a>
									</td>
									<td>
										<a href="<?= base_url('superadmin/validasi_detail/' . $toko["id_toko"]) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
