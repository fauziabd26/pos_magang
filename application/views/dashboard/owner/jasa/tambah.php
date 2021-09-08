<section class="section">
    <div class="section-header">
        <h1>Tambah Data Produk Jasa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/index_jasa') ?>">Data Produk Jasa</a></div>
            <div class="breadcrumb-item">Tambah Data Produk Jasa</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('owner/proses_tambah_jasa') ?>" method="POST">
                <div class="card-body">
                <?php if ($this->session->flashdata('error')) { ?>
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
                            <a href="<?= base_url('owner/index_jasa') ?>" class="btn btn-primary">
                                <i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Produk Jasa
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='nama_produk' class="col-lg-5 col-sm-5 control-label">Nama Jasa</label>
                        <input type="text" id="nama_produk" class="form-control" name="nama_produk"
                            placeholder="Masukan Nama Produk" autofocus>
                            <small class="text-danger font-weight-bold">
							<?php echo form_error('nama_produk'); ?>
						    </small>
                    </div>
                    <div class="form-group">
                        <label for='jenis' class="col-lg-5 col-sm-5 control-label">Jenis Produk</label>
                        <input type="text" id="jenis" class="form-control" name="jenis" value="jasa" readonly>
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
                            <small class="text-danger font-weight-bold">
							<?php echo form_error('id_toko'); ?>
						    </small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-block">Submit</button>
                    </div>
            </form>

        </div>
    </div>
</section>