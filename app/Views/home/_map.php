<section id="peta" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto text-center">
                <h3 class="mb-3" style="text-transform: uppercase; font-family: 'Poppins'; font-weight: 700; letter-spacing: 0.3rem;">Peta Lokasi Sekolah</h3>
                <div class="card" id="map" style="height: 30rem;"></div>
            </div>
        </div>
    </div>
</section>

<script>
    const map = L.map('map', { attributionControl: false }).setView([-6.295326, 106.6259098], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert('Geolocation is not supported by this browser.');
    }

    function showPosition(position) {
        L.marker([position.coords.latitude, position.coords.longitude])
            .bindPopup('Posisi Anda!')
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
