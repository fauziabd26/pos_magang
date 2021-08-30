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
			<li <?= $this->uri->segment(2) == 'toko' || $this->uri->segment(2) == 'toko_edit' || $this->uri->segment(2) == 'toko_detail' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('superadmin/toko') ?>">
					<i class="fas fa-store"></i> <span>Data Toko</span>
				</a>
			</li>
			<li class="menu-header">Validasi Data</li>
			<li <?= $this->uri->segment(2) == 'validasi_toko' || $this->uri->segment(2) == 'validasi_detail' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('superadmin/validasi_toko') ?>">
					<i class="fas fa-ban" style="color: #ffc107;"></i> <span>Data Pending</span>
				</a>
			</li>
		</ul>
	</aside>
</div>
