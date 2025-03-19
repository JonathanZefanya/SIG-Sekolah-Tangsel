<section id="peta" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto text-center">
                <h3 class="mb-3" style="text-transform: uppercase; font-family: 'Poppins'; font-weight: 700; letter-spacing: 0.3rem;">
                    Peta Lokasi Sekolah Di Tangsel
                </h3>
                <div class="card position-relative" id="map-container" style="height: 30rem;">
                    <div id="map" style="height: 100%;"></div>

                    <!-- Widget Full-Screen -->
                    <button id="fullScreenMap" class="btn btn-dark widget-btn">
                        <i class="fa-solid fa-expand"></i> Full Screen
                    </button>

                    <!-- Widget Reset -->
                    <button id="resetMap" class="btn btn-danger widget-btn" style="top: 60px;">
                        <i class="fa-solid fa-undo"></i> Reset Peta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Keterangan Icon Map -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 mx-auto text-center">
                <h3 class="mb-3" style="text-transform: uppercase; font-family: 'Poppins'; font-weight: 700; letter-spacing: 0.3rem;">Keterangan Icon Map</h3>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <div class="card p-3 d-flex align-items-center">
                        <img src="<?= base_url('assets/images/icon/sd.png') ?>" alt="SD" class="img-fluid" width="100" height="100">
                        <p class="text-muted text-center mt-2">SD/Sederajat</p>
                    </div>
                    <div class="card p-3 d-flex align-items-center">
                        <img src="<?= base_url('assets/images/icon/smp.png') ?>" alt="SMP" class="img-fluid" width="100" height="100">
                        <p class="text-muted text-center mt-2">SMP/Sederajat</p>
                    </div>
                    <div class="card p-3 d-flex align-items-center">
                        <img src="<?= base_url('assets/images/icon/sma.png') ?>" alt="SMA" class="img-fluid" width="100" height="100">
                        <p class="text-muted text-center mt-2">SMA/Sederajat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

<script>
    const map = L.map('map', { attributionControl: false }).setView([-6.295503, 106.7083125], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert('Geolocation is not supported by this browser.');
    }

    // Widget Full-Screen
    document.getElementById('fullScreenMap').addEventListener('click', function () {
        if (!document.fullscreenElement) {
            document.getElementById('map-container').requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    });

    // Widget Reset
    document.getElementById('resetMap').addEventListener('click', function () {
        map.setView([-6.295503, 106.7083125], 12);
    });

    function showPosition(position) {
        L.marker([position.coords.latitude, position.coords.longitude])
            .bindPopup('Posisi Kamu')
            .addTo(map);
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
            <?php if ($sekolah->sek_jenjang == 'sd') : ?> { icon: sdIcon }
            <?php elseif ($sekolah->sek_jenjang == 'smp') : ?> { icon: smpIcon }
            <?php elseif ($sekolah->sek_jenjang == 'sma') : ?> { icon: smaIcon }
            <?php endif; ?>
        ).bindPopup(`
            <ul class="list-group list-group-flush">
                <li class="list-group-item"></li>
                <li class="list-group-item"><a href='<?= site_url('show/' . $sekolah->sek_npsn) ?>'><?= strtoupper($sekolah->sek_npsn) ?></a></li>
                <li class="list-group-item text-muted"><?= strtoupper($sekolah->sek_nama) ?></li>
                <li class="list-group-item text-muted"><span class="fw-bold">Alamat : </span><?= ucwords($sekolah->sek_alamat) ?></li>
                <li class="list-group-item fw-bold"><a href='<?= site_url('show/' . $sekolah->sek_npsn) ?>'>Lihat Detail <i class="fa-solid fa-circle-info"></i></a></li>
            </ul>
        `).addTo(map);
    <?php endforeach ?>

    // Fungsi untuk memberi warna tiap kecamatan
    function getColor(kecamatan) {
        const colors = {
            "SETU": "#FF5733", // Oranye Merah
            "SERPONG": "#33FF57", // Hijau Muda
            "PAMULANG": "#337BFF", // Biru
            "CIPUTAT": "#FFD700", // Kuning Emas
            "CIPUTAT TIMUR": "#8E44AD", // Ungu
            "PONDOK AREN": "#FF69B4", // Pink
            "SERPONG UTARA": "#FF8C00" // Oranye Tua
        };
        return colors[kecamatan] || "#D3D3D3"; // Default Abu-Abu
    }

    // Menampilkan batas masing-masing kecamatan
    const kecamatanFiles = [
        "id3674010_setu.geojson",
        "id3674020_serpong.geojson",
        "id3674030_pamulang.geojson",
        "id3674040_ciputat.geojson",
        "id3674050_ciputat_timur.geojson",
        "id3674060_pondok_aren.geojson",
        "id3674070_serpong_utara.geojson"
    ];

    kecamatanFiles.forEach(file => {
        fetch(`<?= base_url('json/') ?>${file}`)
            .then(response => response.json())
            .then(geojsonData => {
                L.geoJSON(geojsonData, {
                    style: function (feature) {
                        return {
                            fillColor: getColor(feature.properties.name),
                            weight: 1,
                            opacity: 1,
                            color: "#000000",
                            fillOpacity: 0.6
                        };
                    },
                    onEachFeature: function (feature, layer) {
                        const originalColor = getColor(feature.properties.name);

                        layer.on({
                            mouseover: function (e) {
                                e.target.setStyle({ fillColor: "#FF69B4" });
                            },
                            mouseout: function (e) {
                                e.target.setStyle({ fillColor: originalColor });
                            },
                            click: function (e) {
                                e.target.setStyle({ fillColor: "#FF69B4" });
                            }
                        });

                        layer.bindPopup(`<b>${feature.properties.name}</b>`);
                    }
                }).addTo(map);
            })
            .catch(error => console.error(`Error loading ${file}:`, error));
    });
</script>
