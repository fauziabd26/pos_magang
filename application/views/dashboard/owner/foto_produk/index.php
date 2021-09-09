<section class="section">
    <div class="section-header">
        <h1>Foto Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Foto Produk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="<?= base_url('owner/foto_produk_tambah') ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Foto Produk
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Foto Produk</th>
                                <th>Id Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($foto_produks)) { ?>
                            <?php $no = 1;
								foreach ($foto_produks as $no => $row) : ?>
                            <tr>
                                <td><?= ++$no; ?></td>
                                <td><?= $row["nama_foto_produk"] ?></td>
                                <td><?= $row["id_produk"] ?></td>
                                <td>
                                    <a href="<?= base_url('owner/foto_produk_edit/' . $row["id_foto_produk"]) ?>"
                                        class="btn btn-warning"><i class="fas fa-edit"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#hapus-data<?= $row['id_foto_produk'] ?>"
                                        class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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
<!-- Modal Hapus -->
<?php if (!empty($satuans)) { ?>
<?php foreach ($satuans as $satuan) : ?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
    id="hapus-data<?= $satuan['id_satuan'] ?>" class="modal fade">
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
                    <a href="<?= base_url('owner/satuan_hapus/' . $satuan['id_satuan']) ?>" class="btn btn-info"> Ya</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php } ?>
<!-- END Modal Hapus -->