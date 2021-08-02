<section class="section">
	<div class="section-header">
		<h1>Data Produk</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Data Produk</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<a href="<?= base_url('owner/produkTambah') ?>" class="btn btn-primary">
							<i class="fas fa-user-plus mr-2"></i> Tambah Data Produk
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Jenis</th>
								<th>Foto</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach ($produk as $row) : ?>
                                <tr>
                                    <td>1</td>
                                    <td><?= $row->nama_produk ?></td>
                                    <td><?= $row->jenis ?></td>
                                    <td>Foto</td>
                                    <td>
                                        <a href="<?= base_url('owner/adminEdit') ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
