<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Sekolah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex flex-md-row flex-column justify-content-between align-items-center pb-0">
                <h6>Data Sekolah</h6>
                <?php if (session()->get('user_akses') != 'sekolah') : ?>
                    <a href="<?= site_url('sekolah/create') ?>" class="btn btn-sm btn-primary">Tambah Data</a>
                <?php endif ?>
                <?php if (session()->get('user_akses') == 'sekolah') : ?>
                    <?php if ($sekolah == null) : ?>
                        <a href="<?= site_url('sekolah/create') ?>" class="btn btn-sm btn-primary">Tambah Data</a>
                    <?php endif; ?>
                <?php endif ?>
            </div>
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('message'))) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white text-sm font-weight-bold"><?= session()->getFlashdata('message'); ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="data_sekolah">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NPSN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kecamatan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelurahan</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (session()->get('user_akses') != 'sekolah') : ?>
                                <?php foreach ($sekolahs as $sekolah) : ?>
                                    <tr>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= ucwords($sekolah->sek_npsn) ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->sek_nama) ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->kec_name) ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->kel_name) ?></td>
                                        <td class="align-middle">
                                            <a href="<?= site_url('sekolah/show/' . $sekolah->sek_npsn) ?>" class="text-white font-weight-bold text-xs bg-info border-0 px-2 py-1 rounded"><i class="fas fa-info-circle"></i></a>
                                            <a href="<?= site_url('sekolah/edit/' . $sekolah->sek_npsn) ?>" class="text-white font-weight-bold text-xs bg-warning border-0 px-2 py-1 rounded"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="<?= site_url('sekolah/delete/' . $sekolah->sek_npsn) ?>" class="text-white font-weight-bold text-xs bg-danger border-0 px-2 py-1 rounded" onclick="return confirm('Hapus data ?')"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php if ($sekolah != null) : ?>
                                    <tr>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= ucwords($sekolah->sek_npsn) ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->sek_nama) ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->kec_name) ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->kel_name) ?></td>
                                        <td class="align-middle">
                                            <a href="<?= site_url('sekolah/show/' . $sekolah->sek_npsn) ?>" class="text-white font-weight-bold text-xs bg-info border-0 px-2 py-1 rounded"><i class="fas fa-info-circle"></i></a>
                                            <a href="<?= site_url('sekolah/edit/' . $sekolah->sek_npsn) ?>" class="text-white font-weight-bold text-xs bg-warning border-0 px-2 py-1 rounded"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#data_sekolah').DataTable({
            order: [
                [1, 'asc']
            ],
        });
    });
</script>
<?= $this->endSection() ?>
