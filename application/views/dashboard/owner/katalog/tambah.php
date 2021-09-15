<section class="section">
    <div class="section-header">
        <h1>Tambah Data Katalog Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/katalog') ?>">Data Katalog Produk</a></div>
            <div class="breadcrumb-item">Tambah Data Katalog Produk</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('owner/katalog_tambah') ?>" method="POST">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="<?= base_url('owner/katalog') ?>" class="btn btn-primary">
                                <i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Katalog Produk
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for='nama_produk' class="control-label">Pilih Produk</label>
                                <select name="id_produk" class="form-control select2">
                                    <?php foreach ($produk as $row) : ?>
                                    <option value="<?= $row["id_produk"] ?>"><?= $row['nama_produk'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for='nominal' class="control-label">Pilih Kategori</label>
                                <select name="id_kategori" class="form-control select2">
                                    <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row["id_kategori"] ?>"><?= $row['nama_kategori'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for='nama_produk' class="control-label">Pilih Satuan</label>
                                <select name="id_satuan" class="form-control select2">
                                    <?php foreach ($satuan as $row) : ?>
                                    <option value="<?= $row["id_satuan"] ?>"><?= $row['nama_satuan'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for='nominal' class="control-label">Pilih Harga</label>
                                <select name="id_harga" class="form-control select2">
                                    <?php foreach ($harga as $row) : ?>
                                    <option value="<?= $row["id_harga"] ?>"><?= $row['nama_harga'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='nominal' class="control-label">Nominal</label>
                        <input type="text" id="nominal" class="form-control" name="nominal"
                            placeholder="Masukan Nominal" value="<?= set_value('nominal') ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
</section>