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

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <div class="row mb-3">
                                <div class="col">
                                    <i class=""></i> Total Transaksi : Rp
                                    <?= number_format($total) ?>
                                    </a>
                                </div>
                            </div>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Transaksi</th>
                                <th class="text-center">Jenis Transaksi</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Harga Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php if (!empty($customers)) { ?>
                            <?php foreach ($customers as $no => $row) : ?>
                            <tr>
                                <td class="text-center"><?= ++$no ?></td>
                                <td class="text-center"><?= $row["tggl_transaksi"] ?></td>
                                <td class="text-center"><?= $row["jenis_transaksi"] ?></td>
                                <td class="text-center"><?= $row["nama_cust"] ?></td>
                                <td class="text-center"><?= $row["nama_produk"] ?></td>
                                <td class="text-center">Rp <?= number_format($row["nominal"]) ?></td>
                                <td class="text-center"><?= $row["qty"] ?> </td>
                                <td class="text-center">Rp <?= number_format($row["sub_total"]) ?></td>
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