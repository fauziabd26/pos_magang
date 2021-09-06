<section class="section">
    <div class="section-header">
        <h1>Tambah Data Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/produk') ?>">Data Barang</a></div>
            <div class="breadcrumb-item">Tambah Data Barang</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('owner/proses_tambah_produk') ?>" method="POST">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="<?= base_url('owner/produk') ?>" class="btn btn-primary">
                                <i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Produk
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='nama_produk' class="col-lg-5 col-sm-5 control-label">Nama Produk</label>
                        <input type="text" id="nama_produk" class="form-control" name="nama_produk"
                            placeholder="Masukan Nama Produk" autofocus>
                    </div>
                    <div class="form-group">
                        <label for='jenis' class="col-lg-5 col-sm-5 control-label">Jenis Produk</label>
                        <input type="text" id="jenis" class="form-control" name="jenis" value="Barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for='nominal' class="col-lg-5 col-sm-5 control-label">Pilih Toko</label>
                        <div class="col-lg-10">
                            <select name="id_toko" class="form-control">test
                                <?php foreach ($tokos as $toko) : ?>
                                <option value="<?= $toko["id_toko"] ?>"><?= $toko['nama_toko'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-block">Submit</button>
                    </div>
            </form>

        </div>
    </div>
</section>