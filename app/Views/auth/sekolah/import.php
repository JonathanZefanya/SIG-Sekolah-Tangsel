<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Import Data Sekolah dan Detail Sekolah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6>Import Data Sekolah dan Detail Sekolah</h6>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <form action="<?= site_url('sekolah/import') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="file_excel_sekolah" class="form-label">Pilih File Excel Sekolah</label>
                        <input type="file" name="file_excel_sekolah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_excel_detail" class="form-label">Pilih File Excel Detail Sekolah</label>
                        <input type="file" name="file_excel_detail" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Import Data</button>
                    <a href="<?= site_url('sekolah') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
