<section class="section">
    <div class="section-header">
        <h1>Harga</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Harga</div>
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
                        <a href="<?= base_url('owner/harga_tambah') ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Harga
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>

                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Nama Harga</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hargas as $no => $harga) : ?>
                            <tr>
                                <td><?php echo ++$no; ?></td>
                                <td><?= $harga["nama_produk"] ?></td>
                                <td><?= $harga["nama_harga"] ?></td>
                                <td><?= $harga["nominal"] ?></td>
                                <td>
                                    <a href="<?= base_url('owner/harga_edit/' . $harga["id_harga"]) ?>"
                                        class="btn btn-warning"><i class="fas fa-edit"></i> Ubah</a>
										
                                    <a href="#" data-toggle="modal" data-target="#hapus-data<?= $harga['id_harga']?>" class="btn btn-danger"><i
                                            class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Hapus -->
<?php foreach($hargas as $harga) : ?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="hapus-data<?= $harga['id_harga']?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('owner/harga_hapus') ?>" method="delete"
                enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <h4 class="modal-title">Hapus Data</h4>
                    <div class="form-group">
                        <label class="control-label">Apakah Anda Yaqin ingin hapus???</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('owner/harga_hapus/'. $harga['id_harga'])?>" class="btn btn-info"> Ya</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>
<!-- END Modal Hapus -->
<script>
$(document).ready(function() {
    // Untuk sunting
    $('#edit-data').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)

        // Isi nilai pada field
        modal.find('#id_harga').attr("value", div.data('id_harga'));
        modal.find('#nama_harga').attr("value", div.data('nama_harga'));
        modal.find('#nominal').html(div.data('nominal'));
    });
});
</script>