<section class="section">
    <div class="section-header">
        <h1>Laporan Customer</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('owner/dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Customer</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="<?php echo base_url() . 'owner/pdf_customer'; ?>" target="_blank"
                            class="btn btn-danger">
                            <i class="far fa-file-pdf"></i> Unduh Laporan
                        </a>

                        <a href="" target="_blank" class="btn btn-success">
                            <i class="far fa-file-excel"></i> Unduh Laporan
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Transaksi</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Jenis Transaksi</th>
                                <th class="text-center">Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php if (!empty($customers)) { ?>
                            <?php foreach ($customers as $no => $row) : ?>
                            <tr>
                                <td class="text-center"><?= ++$no ?></td>
                                <td class="text-center"><?= $row["tggl_transaksi"] ?></td>
                                <td class="text-center"><?= $row["nama_cust"] ?></td>
                                <td class="text-center"><?= $row["jenis_transaksi"] ?></td>
                                <td class="text-center"><?= $row["total_transaksi"] ?></td>
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
