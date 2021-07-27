<section class="section">
	<div class="section-header">
		<h1>Data Owner</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Owner</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Owner</th>
								<th>Nama Toko</th>
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
								<td>Toko Serba Guna</td>
								<td>dimas@gmail.com</td>
								<td>Indramayu</td>
								<td>08976523412</td>
								<td>
									<a href="<?= base_url('superadmin/ownerEdit') ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
									<a href="<?= base_url('superadmin/ownerDetail') ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
