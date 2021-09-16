<section class="section">
	<div class="section-header">
		<h1>Laporan Customer</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Laporan Customer</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">						
						<a href="<?php echo base_url(). 'owner/pdf_customer'; ?>" target="_blank" class="btn btn-outline-danger">
							<i class="fas fa-file-pdf"></i> Unduh Laporan
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
								<th>Total Transaksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($customers as $no => $row) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $row["tggl_transaksi"] ?></td>
									<td><?= $row["nama_cust"] ?></td>
									<td><?= $row["jenis_transaksi"] ?></td>
									<td><?= $row["total_transaksi"] ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
