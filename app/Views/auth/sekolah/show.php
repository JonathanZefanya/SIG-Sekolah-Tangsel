<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Sekolah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex flex-md-row flex-column justify-content-between align-items-center pb-0">
                <h6>Detail Data Sekolah</h6>
            </div>
            <div class="card-body">
                <div class="card box-shadow-xl overflow-hidden">
                    <div class="row">
                        <div class="col-lg-5 position-relative" loading="lazy">
                            <div class="z-index-2 text-center d-flex h-100 w-100 d-flex m-auto justify-content-center">
                                <div class="mask bg-gradient-primary opacity-8"></div>
                                <div class="p-5 ps-sm-8 position-relative text-start my-auto z-index-2">
                                    <h5 class="text-white">(<?= $sekolah->sek_npsn ?>) <br /> <?= strtoupper($sekolah->sek_nama) ?></h5>
                                    <p class="text-white opacity-8 mb-4 font-weight-bold text-sm">
                                        <?= strtoupper($sekolah->sek_jenjang) ?> / Sederajat <?= ucwords($sekolah->sek_status) ?>
                                        <br />
                                        Akreditasi : <?= strtoupper($sekolah->det_akreditasi) ?> | Kurikulum : <?= strtoupper($sekolah->det_kurikulum) ?>
                                        <br />
                                        Pengelola : <?php if ($sekolah->user_id != null) : ?><?= ucwords($sekolah->user_name) ?><?php else : ?>-<?php endif ?>
                                    </p>
                                    <div class="d-flex p-2 text-white">
                                        <div class="ps-3 border-container">
                                            <!-- Gambar dengan event onclick -->
                                            <img src="<?= base_url('uploads/sekolah/' . $sekolah->gambar) ?>" 
                                                alt="<?= $sekolah->gambar ?>" 
                                                class="img-fluid bordered-image" 
                                                style="cursor: pointer;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imagePreviewModal">
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8  font-weight-bold"><?= ucwords($sekolah->sek_alamat) ?>, Kel. <?= ucwords($sekolah->kel_name) ?>, Kec. <?= ucwords($sekolah->kec_name) ?></span>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fa fa-user text-xs" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8 font-weight-bold"><?= ucwords($sekolah->det_guru) ?> Guru</span>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8 font-weight-bold"><?= ucwords($sekolah->det_siswa_l) ?> Siswa Laki-laki</span>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-female" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8 font-weight-bold"><?= ucwords($sekolah->det_siswa_p) ?> Siswa Perempuan</span>
                                        </div>
                                    </div>
                                    <!-- <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-globe" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8 font-weight-bold"><?= $sekolah->det_website ?></span>
                                        </div>
                                    </div> -->
                                    <?php if ($sekolah->det_website != '-') : ?>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-globe" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <a href="<?= $sekolah->det_website ?>"><span class="text-sm opacity-8 font-weight-bold"><?= $sekolah->det_website ?></span></a>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-globe" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span class="text-sm opacity-8 font-weight-bold">Tidak ada website</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 px-0">
                            <div id="map" style="height: 50rem;"></div>
                        </div>
                    </div> <!-- /row -->
                </div> <!-- /card -->
                <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagePreviewModalLabel">Preview Sekolah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="previewImage" src="" class="img-fluid" style="max-height: 400px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div> <!-- /modal -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    const map = L.map('map', {
        attributionControl: false,
        zoomControl: false,
        minZoom: 18,
        maxZoom: 18
    }).setView([<?= $sekolah->sek_lokasi ?>], 20);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', ).addTo(map);

    var sdIcon = L.icon({
        iconUrl: '<?= base_url() ?>assets/images/icon/sd.png',
        iconAnchor: [16, 0],
        iconSize: [30, 30],
    });
    var smpIcon = L.icon({
        iconUrl: '<?= base_url() ?>assets/images/icon/smp.png',
        iconAnchor: [16, 0],
        iconSize: [30, 30],
    });
    var smaIcon = L.icon({
        iconUrl: '<?= base_url() ?>assets/images/icon/sma.png',
        iconAnchor: [16, 0],
        iconSize: [30, 30],
    });
    L.marker([<?= $sekolah->sek_lokasi ?>],
        <?php if ($sekolah->sek_jenjang == 'sd') : ?> {
                icon: sdIcon
            }
        <?php elseif ($sekolah->sek_jenjang == 'smp') : ?> {
                icon: smpIcon
            }
        <?php elseif ($sekolah->sek_jenjang == 'sma') : ?> {
                icon: smaIcon
            }
        <?php endif; ?>
    ).bindPopup(`
            <ul class="list-group list-group-flush">
                <li class="list-group-item"></li>
                <li class="list-group-item text-primary font-weight-bold"><?= strtoupper($sekolah->sek_npsn) ?></li>
                <li class="list-group-item text-muted"><?= strtoupper($sekolah->sek_nama) ?></li>
                <li class="list-group-item text-muted"><span class="fw-bold">Alamat : </span><?= ucwords($sekolah->sek_alamat) ?></li>
            </ul>
            `).addTo(map).openPopup();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const image = document.querySelector("img[data-bs-toggle='modal']");
        const modalImage = document.getElementById("previewImage");

        image.addEventListener("click", function () {
            modalImage.src = this.src;
        });
    });
</script>
<?= $this->endSection() ?>
