<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Kecamatan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Tambah Data Kecamatan</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= site_url('kec/save') ?>">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Nama Kecamatan</label>
                        <input type="text" class="form-control <?= (validation_show_error('kec_name')) ? 'is-invalid' : ''; ?>" placeholder="example name kecamatan" id="kec_name" required name="kec_name" autofocus value="<?= old('kec_name'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kec_name'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-3 mb-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
