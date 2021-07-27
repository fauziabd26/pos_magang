<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html">Super Admin</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html">SA</a>
		</div>
		<ul class="sidebar-menu">
			<li <?= $this->uri->segment(2) == 'dashboard' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('superadmin/dashboard') ?>">
					<i class="fas fa-fire"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="menu-header">Data</li>
			<li <?= $this->uri->segment(2) == 'owner' || $this->uri->segment(2) == 'ownerEdit' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('superadmin/owner') ?>">
					<i class="fas fa-user"></i> <span>Data Owner</span>
				</a>
			</li>
			<li class="menu-header">Validasi Data</li>
			<li>
				<a class="nav-link" href="#">
					<i class="fas fa-ban" style="color: #fc544b;"></i> <span>Data Belum Valid</span>
				</a>
			</li>
		</ul>
	</aside>
</div>
