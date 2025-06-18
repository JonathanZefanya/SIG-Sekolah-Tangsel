<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Pengaturan Chatbot<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Pengaturan Chatbot Gemini</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('chatbot/update') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-check form-switch mb-4">
                        <input type="checkbox" name="is_enabled" class="form-check-input" id="enabled"
                            <?= $config['is_enabled'] ? 'checked' : '' ?>>
                        <label for="enabled" class="form-check-label">Aktifkan Chatbot</label>
                    </div>

                    <div class="form-group mb-4">
                        <label for="gemini_api_key">Gemini API Key</label>
                        <input type="text" class="form-control <?= validation_show_error('gemini_api_key') ? 'is-invalid' : '' ?>" 
                            name="gemini_api_key" id="gemini_api_key" placeholder="Masukkan API Key Gemini"
                            value="<?= esc($config['gemini_api_key']) ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('gemini_api_key') ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>