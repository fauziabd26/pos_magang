<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Transaksi</title>
	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?= base_url('assets/dist/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dist/select2/select2.min.css') ?>">
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
</head>

<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<!-- <div class="mr-auto">
					<ul class="navbar-nav">
						<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
					</ul>
				</div> -->
				<ul class="navbar-nav navbar-right ml-auto">
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="<?= base_url('assets/img/avatar/avatar-1.png') ?>" class="rounded-circle mr-1">
							<div class="d-sm-none d-lg-inline-block">Admin</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Menu List</div>
							<a href="features-profile.html" class="dropdown-item has-icon">
								<i class="far fa-user"></i> Profile
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
								<i class="fas fa-sign-out-alt"></i> Logout
							</a>
						</div>
					</li>
				</ul>
			</nav>

			<!-- Main Content -->
			<div class="main-content" style="padding-left: 30px">
				<div class="section-body">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-7 col-12">
									<input type="search" class="form-control mt-3 mb-3" placeholder="Cari produk berdasarkan nama">
									<div class="row mb-5">
										<div class="col">
											<button class="btn btn-primary mr-2">Kemeja</button>
											<button class="btn btn-primary mr-2">Celana</button>
											<button class="btn btn-primary mr-2">Jas</button>
											<button class="btn btn-primary mr-2">Jaket</button>
											<button class="btn btn-primary mr-2">Hoodie</button>
											<button class="btn btn-primary mr-2">Jeans</button>
											<button class="btn btn-primary mr-2">Chino</button>
										</div>
									</div>
									<div style="height: 300px; overflow-x: hidden; overflow-y: scroll;">
										<div class="row">
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Flannel</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Basic</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Jas Hitam</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Hoodie Premium</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Celana Bahan</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Celana Jeans</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kaos Bola</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Muslim</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Muslim</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Muslim</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Muslim</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Muslim</small></p>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 col-12">
												<div class="card card-primary">
													<div class="card-body">
														<img alt="image" src="<?= base_url('assets/img/example-image.jpg') ?>" class="img-fluid">
														<p class="mt-1"><small>Kemeja Muslim</small></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-12">
									<!-- <div style="height: 200px; "> -->
									<table class="table" style="display: block;">
										<thead style="display: block;">
											<tr style="width: 100%; table-layout: fixed;display: inline-table;">
												<th>Item</th>
												<th>Qty</th>
												<th>Harga</th>
												<th>Sub Total</th>
											</tr>
										</thead>
										<tbody style=" width: 100%; table-layout: fixed; height:140px; overflow-y:scroll;display: inline-table;">
											<tr>
												<td>Kemaja Flannel</td>
												<td>1</td>
												<td>Rp 50.000</td>
												<td>Rp 50.000</td>
											</tr>
											<tr>
												<td>Kemaja Basic</td>
												<td>2</td>
												<td>Rp 50.000</td>
												<td>Rp 100.000</td>
											</tr>
											<tr>
												<td>Kemaja Basic</td>
												<td>2</td>
												<td>Rp 50.000</td>
												<td>Rp 100.000</td>
											</tr>
											<tr>
												<td>Kemaja Basic</td>
												<td>2</td>
												<td>Rp 50.000</td>
												<td>Rp 100.000</td>
											</tr>
											<tr>
												<td>Kemaja Basic</td>
												<td>2</td>
												<td>Rp 50.000</td>
												<td>Rp 100.000</td>
											</tr>
										</tbody>
									</table>
									<!-- </div> -->
									<div class="row mx-1 mt-5">
										<div class="col-6">
											<div class="form-group row">
												<label class="col-8 col-form-label">Jml Item :</label>
												<div class="col-4">
													<input class="form-control text-right" value="3">
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group row">
												<label class="col-4 col-form-label">Total :</label>
												<div class="col-8">
													<input class="form-control text-right bg-white" value="Rp 500.000" disabled>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 mx-1">
										<div class="form-group row">
											<label class="col col-form-label">Diskon :</label>
											<div class="col">
												<input class="form-control text-right">
											</div>
										</div>
									</div>
									<div class="col-12 mx-1">
										<div class="form-group row">
											<label class="col col-form-label">Jumlah Yang Harus Dibayar :</label>
											<div class="col">
												<input class="form-control text-right bg-white" value="Rp 500.000" disabled>
											</div>
										</div>
									</div>
									<button class="btn btn-primary float-right">Konfirmasi</button>
									<button class="btn btn-outline-secondary float-right mr-2">Reset</button>
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
	</script>
</body>

</html>
