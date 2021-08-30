<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Login Page</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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
							<?php if ($this->session->flashdata('success')) { ?>
								<div class="alert alert-success alert-dismissible show fade mt-2">
									<div class="alert-body">
										<button class="close" data-dismiss="alert">
											<span>×</span>
										</button>
										<i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('success') ?>
									</div>
								</div>
							<?php } elseif ($this->session->flashdata('error')) { ?>
								<div class="alert alert-danger alert-dismissible show fade mt-2">
									<div class="alert-body">
										<button class="close" data-dismiss="alert">
											<span>×</span>
										</button>
										<i class="fas fa-times mr-2"></i> <?= $this->session->flashdata('error') ?>
									</div>
								</div>
							<?php } ?>
							<div class="card-header">
								<h4>Login</h4>
							</div>
							<div class="card-body">
								<form action="<?= base_url('auth/proses_login') ?>" method="POST" class="needs-validation" novalidate="">
									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email" placeholder="example@gmail.com" tabindex="1" required autofocus>
										<div class="invalid-feedback">
											Please fill in your email
										</div>
									</div>
									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password</label>
											<!-- <div class="float-right">
												<a href="auth-forgot-password.html" class="text-small">
													Forgot Password?
												</a>
											</div> -->
										</div>
										<input id="password" type="password" class="form-control" name="password" placeholder="Masukan Password" tabindex="2" required>
										<div class="invalid-feedback">
											please fill in your password
										</div>
									</div>
									<div class="form-group">
										<button type="submit" name="loginPost" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Login
										</button>
										<div class="mt-5 text-center">
											Belum Mempunyai Akun? <a href="<?= base_url('auth/register') ?>">Register</a>
										</div>
									</div>
									<!-- <div class="card-header justify-content-around">
										<h4>Halaman Sementara</h4>
									</div>
									<a href="<?= base_url('/superadmin/dashboard') ?>" class="btn btn-primary btn-lg btn-block">
										Dashboard Super Admin
									</a>
									<a href="<?= base_url('/owner/dashboard') ?>" class="btn btn-primary btn-lg btn-block">
										Dashboard Owner
									</a>
									<a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-primary btn-lg btn-block">
										Dashboard Admin
									</a> -->
								</form>
							</div>
						</div>
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
