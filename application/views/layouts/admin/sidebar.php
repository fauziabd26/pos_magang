<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html">Admin</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html">ADM</a>
		</div>
		<ul class="sidebar-menu">
			<li <?= $this->uri->segment(2) == 'dashboard' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
					<i class="fas fa-fire"></i> <span>Dashboard</span>
				</a>
			</li>
			<!-- <li class="menu-header">Data</li>
			<li <?= $this->uri->segment(2) == 'customer' || $this->uri->segment(2) == 'customerTambah' || $this->uri->segment(2) == 'customerEdit' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('admin/customer') ?>">
					<i class="fas fa-user"></i> <span>Customer</span>
				</a>
			</li> -->
			<li class="menu-header">Transaksi POS</li>
			<li <?= $this->uri->segment(2) == 'transaksi_produk' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('admin/transaksi_barang') ?>">
					<i class="fas fa-cash-register"></i> <span>Produk</span>
				</a>
			</li>
			<li <?= $this->uri->segment(2) == 'transaksi_jasa' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('admin/transaksi_jasa') ?>">
					<i class="fas fa-cash-register"></i> <span>Jasa</span>
				</a>
			</li>
			<li class="menu-header">Histori</li>
			<li <?= $this->uri->segment(2) == 'histori_transaksi' || $this->uri->segment(2) == 'histori_transaksi_detail' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('admin/histori_transaksi') ?>">
					<i class="fas fa-history"></i> <span>Histori Transaksi</span>
				</a>
			</li>
		</ul>
	</aside>
</div>

