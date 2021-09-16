<section class="section">
    <div class="section-header">
        <h1>Edit Data Foto Produk <?= $foto_produks["nama_produk"] ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/index_foto_produk') ?>">Data Foto Produk</a></div>
            <div class="breadcrumb-item"><?= $foto_produks["nama_produk"] ?></div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('owner/proses_edit_fotoProduk/' . $foto_produks['id_foto_produk']) ?>" method="POST">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="<?= base_url('owner/index_foto_produk') ?>" class="btn btn-primary">
                                <i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Foto Produk
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='nama_produk' class="col-lg-5 col-sm-5 control-label">Nama Produk</label>
                        <div class="col-lg-10">
                            <select name="id_produk" class="form-control">
                                <?php foreach ($produks as $produk) : ?>
                                <option value="<?= $produk["id_produk"] ?>"><?= $produk['nama_produk'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-block">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>