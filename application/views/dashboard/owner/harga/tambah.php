<section class="section">
    <div class="section-header">
        <h1>Tambah Data Harga</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/index_harga') ?>">Data Harga</a></div>
            <div class="breadcrumb-item">Tambah Data Harga</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('owner/proses_tambah_harga') ?>" method="POST">
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
                            <a href="<?= base_url('owner/index_harga') ?>" class="btn btn-primary">
                                <i class="fas fa-chevron-left mr-2"></i> Kembali Ke Data Harga
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='nama_toko'>Nama Harga</label>
                        <input type="text" id="nama_harga" class="form-control" name="nama_harga"
                            placeholder="Masukan Nama Harga" autofocus>
                            <small class="text-danger font-weight-bold">
							<?php echo form_error('nama_harga'); ?>
						</small>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary btn-block">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</section>
