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

                <form action="<?php base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" type="text"
                            name="name" placeholder="Product name" />
                        <div class="invalid-feedback">
                            <?php echo form_error('name') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price">Price*</label>
                        <input class="form-control <?php echo form_error('price') ? 'is-invalid' : '' ?>" type="number"
                            name="price" min="0" placeholder="Product price" />
                        <div class="invalid-feedback">
                            <?php echo form_error('price') ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="name">Photo</label>
                        <input class="form-control-file <?php echo form_error('price') ? 'is-invalid' : '' ?>"
                            type="file" name="image" />
                        <div class="invalid-feedback">
                            <?php echo form_error('image') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Description*</label>
                        <textarea class="form-control <?php echo form_error('description') ? 'is-invalid' : '' ?>"
                            name="description" placeholder="Product description..."></textarea>
                        <div class="invalid-feedback">
                            <?php echo form_error('description') ?>
                        </div>
                    </div>

                    <input class="btn btn-success" type="submit" name="btn" value="Save" />
                </form>

            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
</section>