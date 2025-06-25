<section id="sekolah" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <h3 class="mb-3" style="text-transform: uppercase; font-family: 'Poppins'; font-weight: 700; letter-spacing: 0.3rem;">Data Sekolah</h3>
                <!-- Filter berdasarkan Jenjang -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="btn-group d-flex flex-wrap" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" onclick="filterJenjang('')" checked>
                            <label class="btn btn-outline-primary flex-fill" for="btnradio1">All</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" onclick="filterJenjang('SD')">
                            <label class="btn btn-outline-primary flex-fill" for="btnradio2">SD</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" onclick="filterJenjang('SMP')">
                            <label class="btn btn-outline-primary flex-fill" for="btnradio3">SMP</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" onclick="filterJenjang('SMA')">
                            <label class="btn btn-outline-primary flex-fill" for="btnradio4">SMA</label>
                        </div>
                    </div>
                </div>
                <div class="card p-4">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="data_sekolah">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Sekolah</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenjang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($sekolahs as $sekolah) : ?>
                                    <tr>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= $no ?></td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold"><?= ucwords($sekolah->sek_nama) ?></td>
                                        <td class="align-middle text-center text-secondary text-xs font-weight-bold"><?= ucwords($sekolah->sek_alamat) ?>, Kel.<?= ucwords($sekolah->kel_name) ?>, Kec.<?= ucwords($sekolah->kec_name) ?></td>
                                        <td class="align-middle text-center text-secondary text-xs font-weight-bold"><?= strtoupper($sekolah->sek_jenjang) ?> /Sederajat</td>
                                        <td class="align-middle text-center text-secondary font-weight-bold">
                                            <a href="<?= site_url('show/' . $sekolah->sek_npsn) ?>" class="text-white badge bg-gradient-primary"><i class="fa-solid fa-info"></i></a>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        var table = $('#data_sekolah').DataTable();

        window.filterJenjang = function(jenjang) {
            if (jenjang) {
                table.column(3).search('^' + jenjang + ' /Sederajat$', true, false).draw();
            } else {
                table.column(3).search('').draw();
            }
        };
    });
</script>