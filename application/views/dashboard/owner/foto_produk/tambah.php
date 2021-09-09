<section class="section">
    <div class="section-header">
        <h1>Tambah Data Foto Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/foto_produk_tambah') ?>">Data Foto
                    Produk</a></div>
            <div class="breadcrumb-item">Tambah Data Foto Produk</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <form action="<?php base_url('owner/proses_tambah_fotoProduk') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for='nominal'>Pilih Produk</label>
                        <div>
                            <select name="id_produk" class="form-control">test
                                <?php foreach ($produks as $produk) : ?>
                                <option value="<?= $produk["id_produk"] ?>"><?= $produk['nama_produk'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger font-weight-bold">
							<?php echo form_error('id_produk'); ?>
						    </small>
                        </div>
                    </div>

                    <div class="form-group">
						<label for='nama_foto_produk'>Foto Produk</label>
						<?php echo form_error('nama_foto_produk'); ?>
						<input type="file" id="nama_foto_produk" class="form-control" name="nama_foto_produk" value="<?= set_value('nama_foto_produk'); ?>" />
						<!-- <input type="hidden" id="nama_foto_produk" name="old_image"  /> -->
						<small>*Format File Menggunakan IMG, PNG</small><br>
						<small>*File Maksimal Berukuran 2Mb</small>
						<small class="text-danger font-weight-bold">
							<?php echo form_error('nama_foto_produk'); ?>
						</small>
					</div>
                    <div class="card-footer">
            <button class="btn btn-primary btn-block">Submit</button>
        </div>
        </form>
            </div>
        </div>
        

    </div>
</section>