<section class="section">
	<div class="section-header">
		<h1>Data Customer</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Customer</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<a href="<?= base_url('admin/customerTambah') ?>" class="btn btn-primary">
							<i class="fas fa-user-plus mr-2"></i> Tambah Data Customer
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Customer</th>
								<th>Email</th>
								<th>Alamat</th>
								<th>No Handphone</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Dimas Addriansyah</td>
								<td>dimas@gmail.com</td>
								<td>Indramayu</td>
								<td>08976523412</td>
								<td>
									<a href="<?= base_url('admin/customerEdit') ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
									<a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
