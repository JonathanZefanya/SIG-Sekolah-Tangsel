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

                    <!-- Tombol utama untuk filter -->
                    <button id="filterMap" class="btn btn-danger widget-btn" style="top: 60px;">
                        <i class="fa-solid fa-filter"></i> <span id="filterLabel">Filter Tingkat</span>
                    </button>

                    <!-- Dropdown Pilihan Filter -->
                    <div id="filterOptions" class="dropdown-menu filter-box" style="display: none; position: absolute; top: 110px; right: 10px; z-index: 1000;">
                        <button class="dropdown-item filter-option" data-value="all">
                            <i class="fa-solid fa-school"></i> Semua Sekolah
                        </button>
                        <button class="dropdown-item filter-option" data-value="sd">
                            <img src="<?= base_url('assets/images/icon/sd.png') ?>" width="20" height="20"> SD/Sederajat
                        </button>
                        <button class="dropdown-item filter-option" data-value="smp">
                            <img src="<?= base_url('assets/images/icon/smp.png') ?>" width="20" height="20"> SMP/Sederajat
                        </button>
                        <button class="dropdown-item filter-option" data-value="sma">
                            <img src="<?= base_url('assets/images/icon/sma.png') ?>" width="20" height="20"> SMA/Sederajat
                        </button>
                    </div>

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
    const map = L.map('map', {
        attributionControl: false
    }).setView([-6.295503, 106.7083125], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert('Geolocation is not supported by this browser.');
    }

    // Widget Full-Screen
    document.getElementById('fullScreenMap').addEventListener('click', function() {
        if (!document.fullscreenElement) {
            document.getElementById('map-container').requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    });

    function showPosition(position) {
        L.marker([position.coords.latitude, position.coords.longitude])
            .bindPopup('Posisi Kamu')
            .addTo(map);
    }

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
                    style: function(feature) {
                        return {
                            fillColor: getColor(feature.properties.district), // Gunakan district
                            weight: 1,
                            opacity: 1,
                            color: "#000000",
                            fillOpacity: 0.6
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        const originalColor = getColor(feature.properties.district); // Warna default
                        const districtName = feature.properties.district || "Tidak diketahui"; // Nama kecamatan
                        const villageName = feature.properties.village || "Tidak ada data"; // Nama desa/kelurahan

                        layer.on({
                            mouseover: function(e) {
                                e.target.setStyle({
                                    fillColor: "#FF69B4"
                                });
                            },
                            mouseout: function(e) {
                                e.target.setStyle({
                                    fillColor: originalColor
                                });
                            },
                            click: function(e) {
                                layer.bindPopup(`
                                <b>Kecamatan:</b> ${districtName} <br>
                                <b>Kelurahan:</b> ${villageName}
                            `).openPopup();
                            }
                        });
                    }
                }).addTo(map);
            })
            .catch(error => console.error(`Error loading ${file}:`, error));
    });

    document.getElementById('filterMap').addEventListener('click', function() {
        let filterBox = document.getElementById('filterOptions');
        filterBox.style.display = filterBox.style.display === 'block' ? 'none' : 'block';
    });

    document.querySelectorAll('.filter-option').forEach(option => {
        option.addEventListener('click', function() {
            let selected = this.getAttribute('data-value');
            let filterLabel = document.getElementById('filterLabel');
            let filterIcon = document.getElementById('filterMap').querySelector('i');

            const icons = {
                all: '<i class="fa-solid fa-school"></i>',
                sd: '<img src="<?= base_url('assets/images/icon/sd.png') ?>" width="20" height="20">',
                smp: '<img src="<?= base_url('assets/images/icon/smp.png') ?>" width="20" height="20">',
                sma: '<img src="<?= base_url('assets/images/icon/sma.png') ?>" width="20" height="20">'
            };

            filterIcon.innerHTML = icons[selected];
            filterLabel.innerHTML = this.textContent.trim();

            document.getElementById('filterOptions').style.display = 'none';

            // Proses filter marker
            markers.forEach(({
                marker,
                jenjang
            }) => {
                if (selected === 'all' || jenjang === selected) {
                    marker.addTo(map);
                } else {
                    map.removeLayer(marker);
                }
            });
        });
    });

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function(event) {
        let filterBox = document.getElementById('filterOptions');
        let filterButton = document.getElementById('filterMap');

        if (!filterBox.contains(event.target) && !filterButton.contains(event.target)) {
            filterBox.style.display = 'none';
        }
    });

    var icons = {
        sd: L.icon({
            iconUrl: '<?= base_url() ?>assets/images/icon/sd.png',
            iconSize: [30, 30]
        }),
        smp: L.icon({
            iconUrl: '<?= base_url() ?>assets/images/icon/smp.png',
            iconSize: [30, 30]
        }),
        sma: L.icon({
            iconUrl: '<?= base_url() ?>assets/images/icon/sma.png',
            iconSize: [30, 30]
        })
    };

    var markers = [];

    <?php foreach ($sekolahs as $sekolah) : ?>
        var marker = L.marker([<?= $sekolah->sek_lokasi ?>], {
                icon: icons['<?= $sekolah->sek_jenjang ?>']
            })
            .bindPopup(`
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href='<?= site_url('show/' . $sekolah->sek_npsn) ?>'><?= strtoupper($sekolah->sek_npsn) ?></a></li>
                    <li class="list-group-item text-muted"><?= strtoupper($sekolah->sek_nama) ?></li>
                    <li class="list-group-item text-muted"><span class="fw-bold">Alamat : </span><?= ucwords($sekolah->sek_alamat) ?></li>
                    <li class="list-group-item fw-bold"><a href='<?= site_url('show/' . $sekolah->sek_npsn) ?>'>Lihat Detail <i class="fa-solid fa-circle-info"></i></a></li>
                </ul>
            `).addTo(map);

        markers.push({
            marker,
            jenjang: '<?= $sekolah->sek_jenjang ?>'
        });
    <?php endforeach ?>

    // Filter berdasarkan tingkat sekolah
    document.getElementById('filterSelect').addEventListener('change', function() {
        let selected = this.value;

        markers.forEach(({
            marker,
            jenjang
        }) => {
            if (selected === 'all' || jenjang === selected) {
                marker.addTo(map);
            } else {
                map.removeLayer(marker);
            }
        });
    });
</script>