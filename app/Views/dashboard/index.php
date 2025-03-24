<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <?php if (session()->get('user_akses') != 'sekolah') : ?>
                                <p class="text-sm mb-2 text-uppercase font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder"><?= count($sd) ?></h5>
                                <p class="mb-0 text-sm font-weight-bold">SD / Sederajat</p>
                            <?php else : ?>
                                <p class="text-sm mb-2 text-uppercase font-weight-bold">Total</p>
                                <?php if ($sekolah != null) : ?>
                                    <h5 class="font-weight-bolder"><?= ($sekolah->det_guru) ?></h5>
                                <?php endif; ?>
                                <p class="mb-0 text-sm font-weight-bold">Guru Pengajar</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="fa-solid fa-building text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <?php if (session()->get('user_akses') != 'sekolah') : ?>
                                <p class="text-sm mb-2 text-uppercase font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder"><?= count($smp) ?></h5>
                                <p class="mb-0 text-sm font-weight-bold">SMP / Sederajat</p>
                            <?php else : ?>
                                <p class="text-sm mb-2 text-uppercase font-weight-bold">Total</p>
                                <?php if ($sekolah != null) : ?>
                                    <h5 class="font-weight-bolder"><?= ($sekolah->det_siswa_l) ?></h5>
                                <?php endif; ?>
                                <p class="mb-0 text-sm font-weight-bold">Siswa Laki-laki</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="fa-solid fa-school-flag text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <?php if (session()->get('user_akses') != 'sekolah') : ?>
                                <p class="text-sm mb-2 text-uppercase font-weight-bold">Total</p>
                                <h5 class="font-weight-bolder"><?= count($sma) ?></h5>
                                <p class="mb-0 text-sm font-weight-bold">SMA / Sederajat</p>
                            <?php else : ?>
                                <p class="text-sm mb-2 text-uppercase font-weight-bold">Total</p>
                                <?php if ($sekolah != null) : ?>
                                    <h5 class="font-weight-bolder"><?= ($sekolah->det_siswa_p) ?></h5>
                                <?php endif; ?>
                                <p class="mb-0 text-sm font-weight-bold">Siswa Perempuan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="fa-solid fa-city text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->get('user_akses') != 'sekolah') : ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Peta Sebaran Sekolah Kota Tangsel</h6>
                </div>
                <div class="card-body p-3">
                    <div class="card" id="map" style="height: 30rem;"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>

<?php if (session()->get('user_akses') != 'sekolah') : ?>
    <?= $this->section('script') ?>
    <script>
        const map = L.map('map', {
            attributionControl: false,
        }).setView([-6.295503, 106.7083125], 12);
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

        <?php foreach ($sekolahs as $sekolah) : ?>
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
                <li class="list-group-item"><a href='<?= site_url() ?>sekolah/show/<?= $sekolah->sek_npsn ?>'><?= strtoupper($sekolah->sek_npsn) ?></a></li>
                <li class="list-group-item text-muted"><?= strtoupper($sekolah->sek_nama) ?></li>
                <li class="list-group-item text-muted"><span class="fw-bold">Alamat : </span><?= ucwords($sekolah->sek_alamat) ?></li>
                <li class="list-group-item fw-bold"><a href='<?= site_url('sekolah/show/' . $sekolah->sek_npsn) ?>'>Lihat Detail <i class="fa-solid fa-circle-info"></i></a></li>
            </ul>
            `).
            addTo(map);
        <?php endforeach ?>

        // Fungsi untuk memberi warna khusus pada Kota Tangerang Selatan
        function getTangselColor() {
            return "#FF69B4"; // Warna pink untuk Tangsel
        }

        // Memuat batas wilayah Kota Tangerang Selatan dari GeoJSON
        fetch("<?= base_url('json/id3674_kota_tangerang_selatan.geojson') ?>")
            .then(response => response.json())
            .then(geojsonData => {
                L.geoJSON(geojsonData, {
                    style: function() {
                        return {
                            fillColor: getTangselColor(),
                            weight: 2,
                            opacity: 1,
                            color: "#000000", // Warna garis batas
                            fillOpacity: 0.4
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        // Ambil nama district dan village jika tersedia
                        const districtName = feature.properties.district || "Tidak diketahui";
                        const villageName = feature.properties.village || "Tidak ada data";

                        layer.on({
                            mouseover: function(e) {
                                e.target.setStyle({
                                    fillColor: "#FF1493" // Warna lebih gelap saat hover
                                });
                            },
                            mouseout: function(e) {
                                e.target.setStyle({
                                    fillColor: getTangselColor()
                                });
                            }
                        });

                        // Menampilkan informasi tambahan di popup
                        layer.bindPopup(`
                    <b>Kota:</b> Tangerang Selatan <br>
                    <b>Kecamatan:</b> ${districtName} <br>
                    <b>Kelurahan:</b> ${villageName}
                `);
                    }
                }).addTo(map);
            })
            .catch(error => console.error("Error loading Tangsel GeoJSON:", error));

    </script>
    <?= $this->endSection() ?>
<?php endif; ?>