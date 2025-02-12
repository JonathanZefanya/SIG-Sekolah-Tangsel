<section id="sekolah" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <h3 class="mb-3" style="text-transform: uppercase; font-family: 'Poppins'; font-weight: 700; letter-spacing: 0.3rem;">Data Sekolah</h3>
                <div class="card p-4">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="data_sekolah">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Sekolah</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenjang</th>
                                    <th class="text-secondary opacity-7"></th>
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
                                            <!-- <a href="" class="text-white badge bg-gradient-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="" class="text-white badge bg-gradient-danger"><i class="fa-solid fa-trash"></i></a> -->
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
        $('#data_sekolah').DataTable();
    });
</script>
