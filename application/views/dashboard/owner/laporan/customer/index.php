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
                            <i class="far fa-file-pdf mr-1"></i> Unduh Laporan PDF
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Total Transaksi</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php if (!empty($customers)) { ?>
                            <?php foreach ($customers as $no => $row) : ?>
                            <tr>
                                <td class="text-center"><?= ++$no ?></td>
                                <td class="text-center"><?= $row["nama_cust"] ?></td>
                                <td class="text-center">Rp <?= number_format($row["total_transaksi"]) ?></td>
                                <td>
                                    <a href="<?= base_url('owner/detail_laporan_cust/' . $row['nama_cust']) ?>"
                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
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
