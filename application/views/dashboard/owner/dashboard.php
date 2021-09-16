<section class="section">
    <div class="section-header">
        <h1>Dashboard Owner</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Katalog Produk</div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $totalProdukBarang ?? '0' ?></div>
                                <div class="card-stats-item-label">Barang</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $totalProdukJasa ?? '0' ?></div>
                                <div class="card-stats-item-label">Jasa</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $totalProdukBarang + $totalProdukJasa ?? '0' ?>
                                </div>
                                <div class="card-stats-item-label">Total</div>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <a href="<?= base_url('owner/katalog') ?>" class="card card-statistic-1"
                            style="text-decoration: none">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-archive"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Katalog Produk</h4>
                                </div>
                                <div class="card-body">
                                    <div class="count"><?= $totalProdukBarang + $totalProdukJasa ?? '0' ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="row mx-1 mt-4">
                        <div class="col-6">
                            <a href="<?= base_url('owner/admin') ?>" class="card card-statistic-1"
                                style="text-decoration: none">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="count"><?= $totalAdmin ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?= base_url('owner/index_satuan') ?>" class="card card-statistic-1"
                                style="text-decoration: none">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Satuan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="count"><?= $totalSatuan ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?= base_url('owner/index_kategori') ?>" class="card card-statistic-1"
                                style="text-decoration: none">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Kategori</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="count"><?= $totalKategori ?></div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?= base_url('owner/index_harga') ?>" class="card card-statistic-1"
                                style="text-decoration: none">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Harga</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="count"><?= $totalHarga ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Terbaru</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">Lihat Semua <i
                                    class="fas fa-chevron-right pl-2"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nomer Transaksi</th>
                                        <th>Nama Customer</th>
                                        <th>Total Transaksi</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transaksis)) { ?>
                                    <?php foreach (array_slice($transaksis, 0, 5) as $no => $transaksi) : ?>
                                    <tr>
                                        <td><?= $transaksi["id_transaksi"] ?></td>
                                        <td class="font-weight-600"><?= $transaksi["nama_cust"] ?></td>
                                        <td>Rp <?= number_format($transaksi["total_transaksi"]) ?></td>
                                        <td>
                                            <div
                                                class="badge <?= $transaksi['jenis_transaksi'] == 'barang' ? "badge-primary" : "badge-success" ?> text-capitalize">
                                                <?= $transaksi["jenis_transaksi"] ?></div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak Ada Transaksi Terbaru</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Produk Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="owl-carousel owl-theme owl-loaded owl-drag" id="products-carousel">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(-635px, 0px, 0px); transition: all 0.25s ease 0s; width: 1112px;">
                                    <div class="owl-item cloned" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-3-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">oPhone S9 Limited</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half"></i>
                                                    </div>
                                                    <div class="text-muted text-small">86 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-1-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">Headphone Blitz</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                    <div class="text-muted text-small">63 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item pb-3">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-4-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">iBook Pro 2018</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="text-muted text-small">67 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-3-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">oPhone S9 Limited</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half"></i>
                                                    </div>
                                                    <div class="text-muted text-small">86 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-1-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">Headphone Blitz</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                    <div class="text-muted text-small">63 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned active" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item pb-3">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-4-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">iBook Pro 2018</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="text-muted text-small">67 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 148.75px; margin-right: 10px;">
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image"
                                                        src="<?= base_url('assets/img/products/product-3-50.png') ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">oPhone S9 Limited</div>
                                                    <div class="product-review">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half"></i>
                                                    </div>
                                                    <div class="text-muted text-small">86 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>