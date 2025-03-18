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
                    </div>
                </div> <!-- /row -->
            </div> <!-- /card -->
        </div> <!-- /container -->
    </section> <!-- /pt-5 mt-5 -->

    <!-- Footer -->
    <?= $this->include('home/_footer') ?>

    <?= $this->include('home/_script') ?>

    <script>
        const map = L.map('map', {
            attributionControl: false,
        }).setView([<?= $sekolah->sek_lokasi ?>], 13);
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        
        // Menambahkan elemen jarak di kanan atas
        const distanceContainer = L.control({ position: 'topright' });

        distanceContainer.onAdd = function () {
            const div = L.DomUtil.create('div', 'distance-container');
            div.innerHTML = "Menghitung jarak...";
            return div;
        };

        distanceContainer.addTo(map);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert('Geolocation is not supported by this browser.');
        }

        function showPosition(position) {
            const userLatLng = [position.coords.latitude, position.coords.longitude];
            const destinationLatLng = [<?= $sekolah->sek_lokasi ?>];

            // Menambahkan marker untuk lokasi pengguna dan tujuan
            L.marker(userLatLng).addTo(map).bindPopup("Lokasi Kamu").openPopup();
            // L.marker(destinationLatLng).addTo(map).bindPopup("Sekolah Tujuan").openPopup();

            // Mengatur URL Google Maps untuk navigasi
            const gmapsRouteURL = `https://www.google.com/maps/dir/${userLatLng[0]},${userLatLng[1]}/${destinationLatLng[0]},${destinationLatLng[1]}`;

            // Menambahkan marker untuk sekolah tujuan dengan tombol navigasi
            L.marker(destinationLatLng).addTo(map).bindPopup(`
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-primary font-weight-bold"><?= strtoupper($sekolah->sek_nama) ?></li>
                    <li class="list-group-item fw-bold"><a href="${gmapsRouteURL}" target="_blank">Rute Google Maps<i class="ms-1 fa-solid fa-person-walking-arrow-right"></i></a></li>
                </ul>
            `).openPopup();

            // Menampilkan garis lurus antara titik awal dan tujuan
            L.polyline([userLatLng, destinationLatLng], { color: 'blue', weight: 3 }).addTo(map);

            // Menghitung jarak menggunakan rumus Haversine
            const distance = getDistance(userLatLng[0], userLatLng[1], destinationLatLng[0], destinationLatLng[1]);

            // Menampilkan jarak di kanan atas peta
            document.querySelector('.distance-container').innerHTML = `Jarak: ${distance.toFixed(2)} km`;

            // Mengatur tombol Route Gmaps agar membuka rute di Google Maps
            document.getElementById('gmaps-link').href = `https://www.google.com/maps/dir/${userLatLng[0]},${userLatLng[1]}/${destinationLatLng[0]},${destinationLatLng[1]}`;
        }

        function showError(error) {
            console.error("Error getting location:", error);
            alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan izin lokasi diberikan.");
        }

        // Fungsi untuk menghitung jarak menggunakan rumus Haversine
        function getDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Jarak dalam km
        }
    </script>
</body>

</html>
