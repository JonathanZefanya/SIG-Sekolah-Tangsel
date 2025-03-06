<section id="peta" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto text-center">
                <h3 class="mb-3" style="text-transform: uppercase; font-family: 'Poppins'; font-weight: 700; letter-spacing: 0.3rem;">Peta Lokasi Sekolah</h3>
                <!-- Buatkan Filter untuk SD, SMP dan SMA -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">Semua</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio2">SD</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio3">SMP</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio4">SMA</label>
                        </div>
                    </div>
                </div>
                <div class="card" id="map" style="height: 30rem;"></div>
            </div>
        </div>
    </div>
</section>

<script>
    const map = L.map('map', {
        attributionControl: false,
    }).setView([-6.295326, 106.6259098], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', ).addTo(map);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert('Geolocation is not supported by this browser.');
    }

    function showPosition(position) {
        L.marker([position.coords.latitude, position.coords.longitude]).bindPopup('Posisi anda!').addTo(map);
    }

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
                <li class="list-group-item"><a href='<?= site_url('show/' . $sekolah->sek_npsn) ?>'><?= strtoupper($sekolah->sek_npsn) ?></a></li>
                <li class="list-group-item text-muted"><?= strtoupper($sekolah->sek_nama) ?></li>
                <li class="list-group-item text-muted"><span class="fw-bold">Alamat : </span><?= ucwords($sekolah->sek_alamat) ?></li>
            </ul>
            `).
        addTo(map);

        // L.Routing.control({
        //     waypoints: [
        //         L.latLng(0.1372358, 117.4548496),
        //         L.latLng(0.1372358, 117.5548496)
        //     ]
        // }).addTo(map);
    <?php endforeach ?>

    // Filter
    
</script>
