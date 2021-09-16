<section class="section">

    <div class="section-header">
        <h1>Katalog Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Katalog Produk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        <i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
                <?php } elseif ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        <i class="fas fa-check mr-2"></i> <?= $this->session->flashdata('error') ?>
                    </div>
                </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col">
                        <a href="<?= base_url('owner/katalog_tambah') ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Katalog Produk
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Toko</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Nama Harga</th>
                                <th class="text-center">Nominal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php if (!empty($katalog)) { ?>
                            <?php foreach ($katalog as $no => $row) : ?>
                            <tr>
                                <td class="text-center"><?= ++$no; ?></td>
                                <td class="text-center"><?= $row["nama_toko"] ?? '-' ?></td>
                                <td class="text-center"><?= $row["nama_produk"] ?></td>
                                <td class="text-center"><?= $row["nama_kategori"] ?></td>
                                <td class="text-center"><?= $row["nama_satuan"] ?></td>
                                <td class="text-center"><?= $row["nama_harga"] ?></td>
                                <td class="text-center">Rp <?= number_format($row["nominal"]) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('owner/katalog_edit/' . $row["id_detail_produk"]) ?>"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>