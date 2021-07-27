<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Register Page</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- CSS Libraries -->

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
						<div class="login-brand">
							<img src="<?= base_url('assets/img/stisla-fill.svg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
						</div>

						<div class="card card-primary">
							<div class="card-header">
								<h4>Register</h4>
							</div>

							<div class="card-body">
								<form method="POST">
									<div class="form-group">
										<label for="nama">Nama Lengkap</label>
										<input id="nama" type="text" class="form-control" name="nama" autofocus>
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email">
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label for="password" class="d-block">Password</label>
											<input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
											<div id="pwindicator" class="pwindicator">
												<div class="bar"></div>
												<div class="label"></div>
											</div>
										</div>
										<div class="form-group col-6">
											<label for="password_confirm" class="d-block">Password Confirmation</label>
											<input id="password_confirm" type="password" class="form-control" name="password_confirm">
										</div>
									</div>

									<div class="form-group">
										<label for="no_hp">Nomer Handhphone</label>
										<input id="no_hp" type="number" class="form-control" name="no_hp">
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="form-group">
										<label for="foto_ktp">Foto KTP</label>
										<input id="foto_ktp" type="file" class="form-control" name="foto_ktp">
										<small>*Ukuran maksimal foto 2mb</small>
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="form-divider">
										Toko Kamu
									</div>

									<div class="form-group">
										<label for="nama_toko">Nama Toko</label>
										<input id="nama_toko" type="text" class="form-control" name="nama_toko">
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="form-group">
										<label for="alamat">Alamat Toko</label>
										<input id="alamat" type="text" class="form-control" name="alamat">
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="form-group">
										<label for="deskripsi">Deskripsi Toko</label>
										<input id="deskripsi" type="text" class="form-control" name="deskripsi">
										<div class="invalid-feedback">
										</div>
									</div>

									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="agree" class="custom-control-input" id="agree">
											<label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block">
											Register
										</button>
										<a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary btn-lg btn-block">
											Kembali
										</a>
									</div>
								</form>
							</div>
						</div>
						<div class="simple-footer">
							Copyright &copy; Stisla 2018
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="<?= base_url('assets/js/stisla.js') ?>"></script>

	<!-- JS Libraies -->

	<!-- Template JS File -->
	<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom.js') ?>"></script>

	<!-- Page Specific JS File -->
</body>

</html>
