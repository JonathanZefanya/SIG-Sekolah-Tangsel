<!--
=========================================================
* Material Kit 2 - v3.0.4
=========================================================
* Product Page:  https://www.creative-tim.com/product/material-kit
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com
 =========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('home/_head') ?>

    <style>
    .distance-container {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        padding: 10px 15px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }
    #map {
        position: relative;
    }
    #radarCanvas {
        width: 100%;
        height: 100%;
    }

</style>
</head>

<body class="index-page bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?= base_url('/') ?>">
                            <i class="fas fa-map-marker-alt me-1" style="color: #344767;"></i> Geografis Sekolah Tangsel
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item ms-lg-auto me-2">
                                    <a id="gmaps-link" href="#" target="_blank" class="btn btn-sm bg-gradient-secondary mb-0 me-1 mt-2 mt-md-0">Route Gmaps</a>
                                </li>
                                <li class="nav-item ms-lg-auto me-2">
                                    <a href="<?= site_url('/') ?>" class="btn btn-sm bg-gradient-primary mb-0 me-1 mt-2 mt-md-0">Kembali</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav> <!-- /nav -->
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->


    <section class="pt-5 mt-5">
        <div class="container">
            <div class="card box-shadow-xl overflow-hidden mb-5">
                <div class="row">
                    <div class="col-12 px-0">
                        <div id="map" style="height: 50rem;"></div>
                        <canvas id="radarCanvas" style="position:absolute; top:0; left:0; z-index:999; pointer-events:none;"></canvas>
                    </div>
                </div> <!-- /row -->
            </div> <!-- /card -->
        </div> <!-- /container -->
    </section> <!-- /pt-5 mt-5 -->

    <!-- Footer -->
    <?= $this->include('home/_footer') ?>

    <?= $this->include('home/_script') ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const map = L.map('map', {
            attributionControl: false,
        }).setView([<?= $sekolah->sek_lokasi ?>], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        const distanceContainer = L.control({ position: 'topright' });

        distanceContainer.onAdd = function () {
            const div = L.DomUtil.create('div', 'distance-container');
            div.innerHTML = "Menghitung jarak...";
            return div;
        };

        distanceContainer.addTo(map);

        const destinationLatLng = [<?= $sekolah->sek_lokasi ?>];
        let userMarker = null;
        let polyline = null;

       const schoolMarker = L.marker(destinationLatLng)
        .addTo(map)
        .bindPopup(`
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-primary font-weight-bold"><?= strtoupper($sekolah->sek_nama) ?></li>
                <li class="list-group-item fw-bold">
                    <a href="#" class="popup-gmaps-link" target="_blank" style="text-decoration: none;">
                        Buka Google Maps <i class="ms-1 fa-solid fa-person-walking-arrow-right"></i>
                    </a>
                </li>
            </ul>
        `)
        .on("popupopen", () => {
            const popupLink = document.querySelector(".popup-gmaps-link");
            popupLink.addEventListener("click", function (e) {
                e.preventDefault();
                const gmapsRouteURL = `https://www.google.com/maps/dir/${userMarker.getLatLng().lat},${userMarker.getLatLng().lng}/${destinationLatLng[0]},${destinationLatLng[1]}`;
                confirmNavigation(gmapsRouteURL);
            });
        });

        {/* function updateRoute(userLatLng) {
            if (polyline) {
                map.removeLayer(polyline);
            }

            polyline = L.polyline([userLatLng, destinationLatLng], { color: 'blue', weight: 3 }).addTo(map);

            const distance = getDistance(userLatLng[0], userLatLng[1], destinationLatLng[0], destinationLatLng[1]);
            document.querySelector('.distance-container').innerHTML = `Jarak: ${distance.toFixed(2)} km`;

            const gmapsRouteURL = `https://www.google.com/maps/dir/${userLatLng[0]},${userLatLng[1]}/${destinationLatLng[0]},${destinationLatLng[1]}`;
            document.getElementById('gmaps-link').onclick = function () {
                confirmNavigation(gmapsRouteURL);
                return false;
            };
            document.getElementById('schoolRouteLink').onclick = function () {
                confirmNavigation(gmapsRouteURL);
                return false;
            };
        } */}

        // Inisialisasi lokasi pengguna
        function initUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const latlng = [position.coords.latitude, position.coords.longitude];
                    addUserMarker(latlng);
                }, (error) => {
                    console.error("Geolocation error:", error);
                    const defaultLatLng = [-6.3, 106.7]; // fallback manual
                    addUserMarker(defaultLatLng);
                });
            } else {
                alert('Geolocation tidak didukung browser ini.');
                const defaultLatLng = [-6.3, 106.7];
                addUserMarker(defaultLatLng);
            }
        }

        function addUserMarker(latlng) {
            if (userMarker) {
                map.removeLayer(userMarker);
            }

            userMarker = L.marker(latlng, { draggable: true }).addTo(map).bindPopup("Lokasi Kamu").openPopup();

            updateRoute(latlng);

            userMarker.on('dragend', function (e) {
                const newPos = [e.target.getLatLng().lat, e.target.getLatLng().lng];
                updateRoute(newPos);
            });
        }

        // Klik di peta juga bisa ubah lokasi pengguna
        map.on('click', function (e) {
            const latlng = [e.latlng.lat, e.latlng.lng];
            addUserMarker(latlng);
        });

        function confirmNavigation(url) {
            Swal.fire({
                title: "Buka Google Maps?",
                text: "Anda akan diarahkan ke aplikasi/tab baru.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Lanjutkan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(url, "_blank");
                }
            });
        }

        // Haversine function
        function getDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        // Tambahkan lingkaran dengan radius 10 kilometer di sekitar sekolah
        const schoolRadiusKm = 3; // radius dalam kilometer
        const circle = L.circle(destinationLatLng, {
            color: 'green',
            fillColor: '#0f0',
            fillOpacity: 0.2,
            radius: schoolRadiusKm * 1000 // konversi ke meter
        }).addTo(map);
        
        let lastUserLatLng = null;
        function updateRoute(userLatLng) {
            lastUserLatLng = userLatLng;
            if (polyline) {
                map.removeLayer(polyline);
            }

            polyline = L.polyline([userLatLng, destinationLatLng], { color: 'blue', weight: 3 }).addTo(map);

            const distance = getDistance(userLatLng[0], userLatLng[1], destinationLatLng[0], destinationLatLng[1]);
            document.querySelector('.distance-container').innerHTML = `Jarak: ${(distance).toFixed(2)} km`;

            const gmapsRouteURL = `https://www.google.com/maps/dir/${userLatLng[0]},${userLatLng[1]}/${destinationLatLng[0]},${destinationLatLng[1]}`;
            document.getElementById('gmaps-link').onclick = function () {
                confirmNavigation(gmapsRouteURL);
                return false;
            };
            document.getElementById('schoolRouteLink').onclick = function () {
                confirmNavigation(gmapsRouteURL);
                return false;
            };

            // Peringatan jika lebih dari 3 km
            if (distance > 3) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Di Luar Jangkauan!',
                    text: 'Calon siswa berada lebih dari 3 km dari sekolah. Kemungkinan besar akan tersisihkan.',
                    confirmButtonText: 'Oke',
                });
            }
        }

        function startRadar(centerLatLng, radiusInKm) {
            const canvas = document.getElementById("radarCanvas");
            const ctx = canvas.getContext("2d");

            function resizeCanvas() {
                canvas.width = map.getSize().x;
                canvas.height = map.getSize().y;
            }

            map.on('resize zoom move', resizeCanvas);
            resizeCanvas();

            let angle = 0;

            function drawRadar() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                const center = map.latLngToContainerPoint(centerLatLng);
                const radius = radiusInKm * 1000 / map.distance(centerLatLng, map.containerPointToLatLng([center.x + 100, center.y])) * 100;

                ctx.save();
                ctx.translate(center.x, center.y);

                // Radar sweep area
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.arc(0, 0, radius, angle, angle + Math.PI / 12);
                ctx.closePath();

                const gradient = ctx.createRadialGradient(0, 0, 0, 0, 0, radius);
                gradient.addColorStop(0, 'rgba(0,255,0,0.1)');
                gradient.addColorStop(1, 'rgba(0,255,0,0.5)');

                ctx.fillStyle = gradient;
                ctx.fill();

                ctx.restore();

                angle += 0.03; // kecepatan rotasi
                requestAnimationFrame(drawRadar);
            }

            drawRadar();
        }

        startRadar(destinationLatLng, 3); // mulai radar dengan radius 3 km

        initUserLocation();
    </script>
</body>

</html>