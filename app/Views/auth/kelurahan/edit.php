<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Kelurahan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Ubah Data Kelurahan</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= site_url('kel/update/' . $kel->kel_id) ?>">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Nama Kelurahan</label>
                        <input type="text" class="form-control <?= (validation_show_error('kel_name')) ? 'is-invalid' : ''; ?>" placeholder="example name kelurahan" id="kel_name" required name="kel_name" autofocus value="<?= old('kel_name') ? old('kel_name') : $kel->kel_name; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kel_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-select <?= (validation_show_error('kec_id')) ? 'is-invalid' : ''; ?>" id="kec_id" required name="kec_id">
                            <option value="">Pilih salah satu</option>
                            <?php foreach ($kecamatan as $kec) : ?>
                                <option value="<?= $kec->kec_id ?>" <?= ($kel->kec_id == $kec->kec_id) ? 'selected' : '' ?>><?= ucwords($kec->kec_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kec_id'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-3 mb-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
