<section class="section">
	<div class="section-header">
		<h1>Laporan Katalog Produk</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
			<div class="breadcrumb-item">Laporan Katalog Produk</div>
		</div>
	</div>

	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">						
						<a href="<?php echo base_url(). 'owner/pdf_katalog'; ?>" target="_blank" class="btn btn-outline-danger">
							<i class="fas fa-file-pdf"></i> Unduh Laporan
						</a>
						
						<a href="" target="_blank" class="btn btn-outline-success">
							<i class="fas fa-file-excel"></i> Unduh Laporan
						</a>
					</div>
				</div>
				<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
                                <th>Kategori Produk</th>
								<th>Satuan Produk</th>
                                <th>Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($katalog_produk as $no => $row) : ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $row["nama_produk"] ?></td>
									<td><?= $row["nama_kategori"] ?></td>
                                    <td><?= $row["nama_satuan"] ?></td>
									<td><?= $row["nama_harga"] ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>