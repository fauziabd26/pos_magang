<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html">Owner</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html">Own</a>
		</div>
		<ul class="sidebar-menu">
			<li <?= $this->uri->segment(2) == 'dashboard' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('owner/dashboard') ?>">
					<i class="fas fa-fire"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="menu-header">Data</li>
			<li <?= $this->uri->segment(2) == 'toko' || $this->uri->segment(2) == 'toko_edit' || $this->uri->segment(2) == 'toko_tambah' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('owner/toko') ?>">
					<i class="fas fa-store"></i> <span>Data Toko</span>
				</a>
			</li>
			<li <?= $this->uri->segment(2) == 'admin' || $this->uri->segment(2) == 'admin_edit' || $this->uri->segment(2) == 'admin_tambah' || $this->uri->segment(2) == 'admin_ubah_password' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('owner/admin') ?>">
					<i class="fas fa-user"></i> <span>Data Admin</span>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
					<span>Data Produk</span>
				</a>
				<ul class="dropdown-menu">
					<li <?= $this->uri->segment(2) == 'produk' ? 'class=active' : '' ?>><a class="nav-link" href="<?= base_url('owner/produk') ?>"><i class=" fas fa-cash-register"></i>Barang</a></li>
					<li <?= $this->uri->segment(2) == 'jasa' ? 'class=active' : '' ?>><a class="nav-link" href="<?= base_url('owner/index_jasa') ?>"><i class="fas fa-cubes"></i>Jasa</a></li>
					<li><a class="nav-link" href="#"><i class="fa fa-images"></i>Foto</a></li>
				</ul>
			</li>
			<li <?= $this->uri->segment(2) == 'harga' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('owner/index_harga') ?>">
					<i class="fas fa-coins"></i> <span>Data Harga</span>
				</a>
			</li>
			<li <?= $this->uri->segment(2) == 'kategori' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('owner/index_kategori') ?>">
					<i class="fas fa-clipboard-list"></i> <span>Data Kategori</span>
				</a>
			</li>
			<li <?= $this->uri->segment(2) == 'satuan' ? 'class=active' : '' ?>>
				<a class="nav-link" href="<?= base_url('owner/index_satuan') ?>">
					<i class="fas fa-clipboard-list"></i> <span>Data Satuan</span>
				</a>
			</li>
			<li class="menu-header">Laporan</li>
			<li>
				<a class="nav-link" href="#">
					<i class="fas fa-clipboard"></i> <span>Laporan Transaksi</span>
				</a>
			</li>
			<li>
				<a class="nav-link" href="#">
					<i class="fas fa-clipboard"></i> <span>Laporan Katalog Produk</span>
				</a>
			</li>
			<li>
				<a class="nav-link" href="#">
					<i class="fas fa-clipboard"></i> <span>Laporan Customer</span>
				</a>
			</li>
		</ul>
	</aside>
</div>
