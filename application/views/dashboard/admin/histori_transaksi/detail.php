<section class="section">
	<div class="section-header">
		<h1>Detail <?= $histori['id'] ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/histori_transaksi') ?>">Data Histori Transaksi</a></div>
			<div class="breadcrumb-item"><?= $histori['id'] ?></div>
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
								<input class="form-control bg-white" value="<?= $histori['id'] ?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Tanggal Transaksi</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" value="<?= date_indo($histori['tgl_transaksi']) ?>" disabled>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Jenis Transaksi</label>
							<div class="col-12 col-md-9">
								<input class="form-control text-capitalize <?= $histori['jenis'] == 'produk' ? "bg-primary" : "bg-success" ?> text-white" value="<?= $histori['jenis'] ?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12 col-md-3 col-form-label">Nama Customer</label>
							<div class="col-12 col-md-9">
								<input class="form-control bg-white" value="<?= $histori['nama_customer'] ?>" disabled>
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
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
