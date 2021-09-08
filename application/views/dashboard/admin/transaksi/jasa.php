<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Transaksi Penjualan Jasa</title>
	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?= base_url('assets/dist/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dist/select2/select2.min.css') ?>">
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
	<style>
		table.scroll {
			width: 100%;
			/* Optional */
			/* border-collapse: collapse; */
			/* border-spacing: 0; */
			/* border: 2px solid black; */
		}

		table.scroll tbody,
		table.scroll thead {
			display: block;
		}

		thead tr th {
			height: 30px;
			line-height: 30px;
			/*text-align: left;*/
		}

		table.scroll tbody {
			height: 100px;
			overflow-y: auto;
			overflow-x: hidden;
		}

		tbody {
			/* border-top: 2px solid black; */
			height: 140px !important;
		}

		tbody td,
		thead th {
			width: 20%;
			/* Optional */
			/* border-right: 1px solid black; */
		}

		tbody td:last-child,
		thead th:last-child {
			border-right: none;
		}
	</style>
</head>

<body class="bg-primary">
	<div id="app">
		<div class="main-wrapper">
			<div class="row justify-content-between mt-3 mr-4">
				<ul class="ml-1">
					<a class="btn bg-white text-primary btn-lg">
						Transaksi Penjualan Jasa
					</a>
				</ul>
				<ul class="mr-1">
					<a href="<?= base_url('admin/dashboard') ?>" class="btn bg-white text-primary btn-lg">
						Kembali Ke Halaman Dashboard <i class="fas fa-arrow-right pl-2"></i>
					</a>
				</ul>
			</div>

			<!-- Main Content -->
			<div class="main-content" style="padding-left: 30px ;padding-top: 0px !important">
				<div class="section-body">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-12">
									<!-- <input type="search" class="form-control mt-3 mb-3" placeholder="Cari produk berdasarkan nama">
									<div class="row mb-5">
										<div class="col">
											<?php foreach ($kategories as $kategori) : ?>
												<button class="btn btn-primary text-capitalize mr-2"><?= $kategori['nama_kategori'] ?></button>
											<?php endforeach; ?>
										</div>
									</div> -->
									<div style="height: 520px; overflow-x: hidden; overflow-y: scroll;">
										<div class="row">
											<?php if (!empty($produks)) { ?>
												<?php foreach ($produks as $produk) : ?>
													<div class="col-md-6 col-lg-4 col-12">
														<form action="<?= base_url('admin/proses_tambah_transaksi_jasa/' . $produk['id_harga']) ?>" method="POST">
															<button style="text-decoration: none;" class="card card-primary">
																<div class="card-body">
																	<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid mb-2">
																	<span class="text-capitalize font-weight-bold"><?= $produk['nama_produk'] ?></span><br>
																	<small class="text-capitalize"><?= $produk['jenis'] ?></small><br>
																	<small>Rp <?= number_format($produk['nominal'] ?? "-")  ?> / <?= $produk['nama_harga'] ?></small>
																</div>
															</button>
														</form>
													</div>
												<?php endforeach; ?>
											<?php } else { ?>
												<div class="col">
													<p class="text-center">Tidak Ada Produk Dengan Jenis Jasa</p>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<!-- <div style="height: 200px; "> -->
									<?php if (!empty($transaksi['total_transaksi'])) { ?>
										<table class="table scroll">
											<thead>
												<tr>
													<th>Item</th>
													<th>Qty</th>
													<th>Harga</th>
													<th>Sub Total</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?= $transaksi['id_transaksi'] ?>
												<?php
												foreach ($detail_transaksi as $row) : ?>
													<tr>
														<td class="text-capitalize"><?= $row['nama_produk'] ?? "-" ?> / <?= $produk['nama_harga'] ?></td>
														<td>
															<div class="row align-items-center">
																<form action="<?= base_url('admin/stok_kurang/' . $row['id_detail_trans_produk']) ?>" method="POST">
																	<?php if ($row['qty'] > 1) { ?>
																		<button class="btn btn-danger btn-xs mr-3" style="padding : 2px 6px">
																			<i class="fas fa-minus" style="font-size: 8px"></i>
																		</button>
																	<?php } ?>
																</form>
																<span><?= $row['qty'] ?></span>
																<form action="<?= base_url('admin/stok_tambah/' . $row['id_detail_trans_produk']) ?>" method="POST">
																	<button class="btn btn-primary btn-xs ml-3" style="padding : 2px 6px">
																		<i class="fas fa-plus" style="font-size: 8px"></i>
																	</button>
																</form>
															</div>
														</td>
														<td>Rp <?= number_format($row['nominal'] ?? "-") ?> </td>
														<td>Rp <?= number_format($row['sub_total'] ?? "-") ?></td>
														<td>
															<a href="<?= base_url('admin/hapus_detail_transaksi/' . $row['id_detail_trans_produk']) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<!-- </div> -->
										<form action="<?= base_url('admin/konfirmasi/' . $transaksi['id_transaksi']) ?>" method="POST">
											<div class="row mx-1 mt-5">
												<div class="col-6">
													<div class="form-group row">
														<label class="col-8 col-form-label">Jml Item :</label>
														<div class="col-4">
															<!-- SUM QTY -->
															<input class="form-control bg-white text-right" value="<?= $sum_qty ?? '' ?>" disabled>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group row">
														<label class="col-4 col-form-label">Total :</label>
														<div class="col-8">
															<input class="form-control text-right bg-white" value="Rp <?= number_format($transaksi['total_transaksi']) ?>">
														</div>
													</div>
												</div>
											</div>
											<div class="row mx-1">
												<div class="col-6">
													<div class="form-group row">
														<label class="col-5 col-form-label">Nama Customer :</label>
														<div class="col-7">
															<input class="form-control bg-white text-right" name="nama_cust" value="<?= set_value('nama_cust') ?>">
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group row">
														<label class="col-4 col-form-label">Diskon :</label>
														<div class="col-8">
															<input class="form-control text-right" name="diskon">
														</div>
													</div>
												</div>
											</div>
											<div class="row mx-1">
												<div class="col-6">
													<div class="form-group row">
														<label class="col-5 col-form-label">Jumlah Yang Harus Dibayar :</label>
														<div class="col-7">
															<input class="form-control text-right bg-white" value="Rp <?= number_format($transaksi['total_transaksi']) ?>" disabled>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group row">
														<label class="col-4 col-form-label">Uang Bayar :</label>
														<div class="col-8">
															<input class="form-control text-right bg-white" name="bayar" value="<?= set_value('bayar') ?>">
														</div>
													</div>
												</div>
											</div>
											<button class="btn btn-primary float-right btn-block">Konfirmasi</button>
											<!-- <button class="btn btn-outline-secondary float-right mr-2">Reset</button> -->
										</form>
									<?php } else { ?>
										<div class="align-items-center text-center mt-4">
											<img src="<?= base_url('assets/img/empty.png') ?>" width="350px" height="350px">
											<h6 class="mt-3">Transaksi Kosong, Tambahkan Produk Terlebih Dahulu</h6>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- General JS Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="<?= base_url('assets/js/stisla.js') ?>"></script>

	<!-- JS Libraies -->
	<script src="<?= base_url('assets/dist/datatables/jquery.dataTables.js') ?>"></script>
	<script src="<?= base_url('assets/dist/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
	<script src="<?= base_url('assets/dist/select2/select2.full.min.js') ?>"></script>

	<!-- Template JS File -->
	<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom.js') ?>"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});

		// Change the selector if needed
		var $table = $('table.scroll'),
			$bodyCells = $table.find('tbody tr:first').children(),
			colWidth;

		// Adjust the width of thead cells when window resizes
		$(window).resize(function() {
			// Get the tbody columns width array
			colWidth = $bodyCells.map(function() {
				return $(this).width();
			}).get();

			// Set the width of thead columns
			$table.find('thead tr').children().each(function(i, v) {
				$(v).width(colWidth[i]);
			});
		}).resize(); // Trigger resize handler
	</script>
</body>

</html>
