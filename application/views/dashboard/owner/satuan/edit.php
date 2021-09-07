<section class="section">
    <div class="section-header">
        <h1>Edit Data Satuan <?= $satuan["nama_satuan"] ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/index_satuan') ?>">Data satuan</a></div>
            <div class="breadcrumb-item"><?= $satuan["nama_satuan"] ?></div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('owner/proses_edit_satuan/' . $satuan['id_satuan']) ?>" method="POST">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="<?= base_url('owner/index_satuan') ?>" class="btn btn-primary">
                                <i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Satuan
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='nama_satuan'>Nama Satuan</label>
                        <input type="text" id="nama_satuan" class="form-control" name="nama_satuan"
                            value="<?= $satuan["nama_satuan"] ?>" autofocus>
                    </div>
                    <div class="form-group">
                        <label for='nominal' class="col-lg-5 col-sm-5 control-label">Pilih Produk</label>
                        <div class="col-lg-10">
                            <select name="id_produk" class="form-control">test
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