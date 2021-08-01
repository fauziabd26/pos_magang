<section class="section">
	<div class="section-header">
		<h1>Data Histori Transaksi</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Histori Transaksi</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>Nomer Transaksi</th>
								<th>Nama Customer</th>
								<th>Jenis Transaksi</th>
								<th>Tanggal</th>
								<th>Total Transaksi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($historis as $no => $histori) : ?>
								<tr>
									<td><?= $histori["id"] ?></td>
									<td><?= $histori["nama_customer"] ?></td>
									<td>
										<div class="badge <?= $histori['jenis'] == 'produk' ? "badge-primary" : "badge-success" ?> text-capitalize"><?= $histori["jenis"] ?></div>
									</td>
									<td><?= date_indo($histori["tgl_transaksi"]) ?></td>
									<td><?= 'Rp ' . number_format($histori["total_transaksi"]) ?></td>
									<td>
										<a href="<?= base_url('admin/historiTransaksiDetail/'.$histori["id"]) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
