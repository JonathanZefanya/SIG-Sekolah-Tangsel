<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Login<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Tambah Data <i>User Login</i></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= site_url('user/save') ?>">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control <?= (validation_show_error('user_name')) ? 'is-invalid' : ''; ?>" placeholder="example username" id="user_name" required name="user_name" autofocus value="<?= old('user_name'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('user_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control <?= (validation_show_error('user_email')) ? 'is-invalid' : ''; ?>" placeholder="name@example.com" id="user_email" required name="user_email" autofocus value="<?= old('user_email'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('user_email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control <?= (validation_show_error('user_password')) ? 'is-invalid' : ''; ?>" placeholder="password" id="user_password" required name="user_password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('user_password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Akses</label>
                        <select class="form-select <?= (validation_show_error('user_akses')) ? 'is-invalid' : ''; ?>" id="user_akses" required name="user_akses">
                            <option value="">Pilih salah satu</option>
                            <option value="sekolah">Pihak Sekolah</option>
                            <option value="dinas">Pihak Dinas</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('user_akses'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-3 mb-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
