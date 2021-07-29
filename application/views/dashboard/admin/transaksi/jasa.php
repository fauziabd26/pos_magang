<section class="section">
	<div class="section-header">
		<h1>Transaksi Jasa</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Transaksi Jasa</div>
		</div>
	</div>

	<div class="section-body">
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h4>Transaksi</h4>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-lg-4 col-12 col-form-label">Tanggal</label>
							<div class="col-lg-8 col-12">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fas fa-calendar"></i>
										</div>
									</div>
									<input type="text" class="form-control" value="23/08/2021" disabled>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="customer" class="col-lg-4 col-12 col-form-label">Customer</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" id="customer" placeholder="Masukan Customer">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h4>Jasa</h4>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-lg-4 col-12 col-form-label">Jasa</label>
							<div class="col-lg-8 col-12">
								<select class="form-control select2">
									<option>Loundry Express</option>
									<option>Loundry Kilat</option>
									<option>Loundry Biasa</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="qty" class="col-lg-4 col-12 col-form-label">Qty</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" id="qty" placeholder="Masukan Qty">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h4>Total Transaksi</h4>
					</div>
					<div class="card-body mb-2">
						<h2 class="text-right">Rp. 500.000</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Jasa</th>
								<th>Kategori</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h4>Harga</h4>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-lg-4 col-12 col-form-label">Subtotal</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" value="Rp. 500.000" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="diskon" class="col-lg-4 col-12 col-form-label">Diskon</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" id="diskon" placeholder="Masukan Diskon">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-12 col-form-label">Total</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" value="Rp. 500.000" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h4>Pembayaran</h4>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-lg-4 col-12 col-form-label">Uang Bayar</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" id="customer" placeholder="Masukan Uang Bayar">
							</div>
						</div>
						<div class="form-group row">
							<label for="qty" class="col-lg-4 col-12 col-form-label">Kembali</label>
							<div class="col-lg-8 col-12">
								<input type="text" class="form-control" id="qty" value="" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h4>Konfirmasi</h4>
					</div>
					<div class="card-body mb-2">
						<button class="btn btn-primary btn-block">Konfirmasi</button>
						<button type="reset" class="btn btn-outline-primary btn-block">Reset</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
