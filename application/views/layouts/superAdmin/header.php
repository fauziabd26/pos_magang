<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
	<div class="mr-auto">
		<ul class="navbar-nav mr-3">
			<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
		</ul>
	</div>
	<ul class="navbar-nav navbar-right">
		<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
				<img alt="image" src="<?= base_url('assets/img/avatar/avatar-1.png') ?>" class="rounded-circle mr-1">
				<div class="d-sm-none d-lg-inline-block">Super Admin</div>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-title">Menu List</div>
				<a href="features-profile.html" class="dropdown-item has-icon">
					<i class="far fa-user"></i> Profile
				</a>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('auth/login') ?>" class="dropdown-item has-icon text-danger">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
		</li>
	</ul>
</nav>
