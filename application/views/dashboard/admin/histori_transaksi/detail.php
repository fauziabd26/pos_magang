<section class="section">
	<div class="section-header">
		<h1>Detail Transaksi <?= $transaksi['id_transaksi'] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/histori_transaksi') ?>">Data Histori Transaksi</a></div>
			<div class="breadcrumb-item"><?= $transaksi['id_transaksi'] ?></div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-5">
					<div class="col">
						<a href="<?= base_url('admin/histori_transaksi') ?>" class="btn btn-primary">
							<i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Histori
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Nomer Transaksi</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" value="<?= $transaksi['id_transaksi'] ?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Tanggal Transaksi</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" value="<?= format_indo($transaksi['tggl_transaksi']) ?>" disabled>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Jenis Transaksi</label>
							<div class="col-12 col-md-9">
								<input class="form-control text-capitalize <?= $transaksi['jenis_transaksi'] == 'produk' ? "bg-primary" : "bg-success" ?> text-white" value="<?= $transaksi['jenis_transaksi'] ?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Nama Customer</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" value="<?= $transaksi['nama_cust'] ?>" disabled>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Total Item</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" disabled>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Total Transaksi</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" value="Rp <?= number_format($transaksi['total_transaksi']) ?>" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="col-12">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Nama Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Sub Total</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($detail_transaksi)) { ?>
									<?php foreach ($detail_transaksi as $row) : ?>
										<tr>
											<td><?= $row['nama_produk'] ?></td>
											<td>Rp <?= number_format($row['nominal']) ?></td>
											<td><?= $row['qty'] ?></td>
											<td>Rp <?= number_format($row['sub_total']) ?></td>
										</tr>
									<?php endforeach; ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
