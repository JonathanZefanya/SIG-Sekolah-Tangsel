<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Sekolah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Ubah Data Sekolah</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sekolah/update/' . $sekolah->sek_npsn) ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" class="form-control" name="det_id" value="<?= $det_sekolah->det_id ?>">
                    <div class="form-group">
                        <label>Nomor Pokok Sekolah Nasional (NPSN)</label>
                        <input type="number" class="form-control <?= (validation_show_error('sek_npsn')) ? 'is-invalid' : ''; ?>" placeholder="10293847" id="sek_npsn" required name="sek_npsn" autofocus value="<?= old('sek_npsn') ? old('sek_npsn') : $sekolah->sek_npsn; ?>" readonly>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_npsn'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Sekolah</label>
                        <?php if (session()->get('user_akses') != 'sekolah') : ?>
                            <select class="form-select <?= (validation_show_error('user_id')) ? 'is-invalid' : ''; ?>" id="user_id" name="user_id">
                                <option value="">Pilih salah satu</option>
                                <option value="NULL" <?= ($sekolah->user_id == NULL) ? 'selected' : '' ?>>Tidak Ada User</option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?= $user->user_id ?>" <?= ($sekolah->user_id == $user->user_id) ? 'selected' : '' ?>><?= ucwords($user->user_name) . ' - ' . ucwords($user->user_email) ?></option>
                                <?php } ?>
                            </select>
                            <small class="text-xs fw-bold text-danger">* Pilih Tidak Ada User jika user untuk sekolah belum terseia.</small>
                        <?php else : ?>
                            <input type="text" class="form-control <?= (validation_show_error('user')) ? 'is-invalid' : ''; ?>" placeholder="10293847" id="user" required name="user" readonly autofocus value="<?= ucwords(session()->get('user_name')) . ' - ' . ucwords(session()->get('user_email')) ?>">
                            <input type="hidden" name="user_id" value="<?= ucwords(session()->get('user_id')) ?>">
                        <?php endif; ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('user_id'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" class="form-control <?= (validation_show_error('sek_nama')) ? 'is-invalid' : ''; ?>" placeholder="sd/smp/sma nama sekolah" id="sek_nama" required name="sek_nama" autofocus value="<?= old('sek_nama') ? old('sek_nama') : $sekolah->sek_nama; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Sekolah</label>
                        <select class="form-select <?= (validation_show_error('sek_status')) ? 'is-invalid' : ''; ?>" id="sek_status" required name="sek_status">
                            <option value="">Pilih salah satu</option>
                            <option value="negeri" <?= ($sekolah->sek_status == 'negeri') ? 'selected' : '' ?>>Negeri</option>
                            <option value="swasta" <?= ($sekolah->sek_status == 'swasta') ? 'selected' : '' ?>>Swasta</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_status'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenjang Sekolah</label>
                        <select class="form-select <?= (validation_show_error('sek_jenjang')) ? 'is-invalid' : ''; ?>" id="sek_jenjang" required name="sek_jenjang">
                            <option value="">Pilih salah satu</option>
                            <option value="sd" <?= ($sekolah->sek_jenjang == 'sd') ? 'selected' : '' ?>>SD/Sederajat</option>
                            <option value="smp" <?= ($sekolah->sek_jenjang == 'smp') ? 'selected' : '' ?>>SMP/Sederajat</option>
                            <option value="sma" <?= ($sekolah->sek_jenjang == 'sma') ? 'selected' : '' ?>>SMA/Sederajat</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_jenjang'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Sekolah</label>
                        <textarea class="form-control <?= (validation_show_error('sek_alamat')) ? 'is-invalid' : ''; ?>" placeholder="jl. maju jaya 2" id="sek_alamat" required name="sek_alamat" autofocus rows="3"><?= old('sek_alamat') ? old('sek_alamat') : $sekolah->sek_alamat; ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_alamat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-select <?= (validation_show_error('kec_id')) ? 'is-invalid' : ''; ?>" id="kec_id" required name="kec_id">
                            <option value="">Pilih salah satu</option>
                            <?php foreach ($kecamatan as $kec) : ?>
                                <option value="<?= $kec->kec_id ?>" <?= ($sekolah->kec_id == $kec->kec_id) ? 'selected' : '' ?>><?= ucwords($kec->kec_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kec_id'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kelurahan</label>
                        <select class="form-select <?= (validation_show_error('kel_id')) ? 'is-invalid' : ''; ?>" id="kel_id" required name="kel_id">
                            <option value="">Pilih salah satu</option>
                            <?php foreach ($kelurahan as $kel) : ?>
                                <option value="<?= $kel->kel_id ?>" <?= ($sekolah->kel_id == $kel->kel_id) ? 'selected' : '' ?>><?= ucwords($kel->kel_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kel_id'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lokasi Sekolah</label>
                        <input type="text" class="form-control <?= (validation_show_error('sek_lokasi')) ? 'is-invalid' : ''; ?>" id="sek_lokasi" required placeholder="0.1103241,117.4823823" name="sek_lokasi" autofocus value="<?= old('sek_lokasi') ? old('sek_lokasi') : $sekolah->sek_lokasi; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_lokasi'); ?>
                        </div>
                        <div id="map" class="border rounded mt-2" style="height: 400px"></div>
                        <small class="mb-3 text-secondary font-weight-bold">* Silahkan klik lokasi yang ada dimap.</small>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Guru</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_guru')) ? 'is-invalid' : ''; ?>" id="det_guru" required placeholder="100" name="det_guru" autofocus value="<?= old('det_guru') ? old('det_guru') : $det_sekolah->det_guru; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_guru'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Siswa Perempuan</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_siswa_p')) ? 'is-invalid' : ''; ?>" id="det_siswa_p" required placeholder="100" name="det_siswa_p" autofocus value="<?= old('det_siswa_p') ? old('det_siswa_p') : $det_sekolah->det_siswa_p; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_siswa_p'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Siswa Laki-Laki</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_siswa_l')) ? 'is-invalid' : ''; ?>" id="det_siswa_l" required placeholder="100" name="det_siswa_l" autofocus value="<?= old('det_siswa_l') ? old('det_siswa_l') : $det_sekolah->det_siswa_l; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_siswa_l'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Akreditasi Sekolah</label>
                        <select class="form-select <?= (validation_show_error('det_akreditasi')) ? 'is-invalid' : ''; ?>" id="det_akreditasi" required name="det_akreditasi">
                            <option value="">Pilih salah satu</option>
                            <option value="a" <?= ($det_sekolah->det_akreditasi == 'a') ? 'selected' : '' ?>>A</option>
                            <option value="b" <?= ($det_sekolah->det_akreditasi == 'b') ? 'selected' : '' ?>>B</option>
                            <option value="c" <?= ($det_sekolah->det_akreditasi == 'c') ? 'selected' : '' ?>>C</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_akreditasi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kurikulum</label>
                        <input type="text" class="form-control <?= (validation_show_error('det_kurikulum')) ? 'is-invalid' : ''; ?>" id="det_kurikulum" required placeholder="2023" name="det_kurikulum" autofocus value="<?= old('det_kurikulum') ? old('det_kurikulum') : $det_sekolah->det_kurikulum; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_kurikulum'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Website Sekolah</label>
                        <input type="text" class="form-control <?= (validation_show_error('det_website')) ? 'is-invalid' : ''; ?>" id="det_website" required placeholder="https://www.sekolah.com" name="det_website" autofocus value="<?= old('det_website') ? old('det_website') : $det_sekolah->det_website; ?>">
                        <small class="text-xs fw-bold text-danger">* Jika Website tidak ada maka gunakan tanda "-".</small>
                        <script>
                            var input = document.getElementById('det_website');
                            input.addEventListener('input', function() {
                                if (input.value.includes('http://') || input.value.includes('https://') || input.value == '-') {
                                    input.setCustomValidity('');
                                } else {
                                    input.setCustomValidity('URL harus diawali dengan http:// atau https:// atau "-" jika tidak ada website');
                                }
                            });
                        </script>
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_website'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-3 mb-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    let map = L.map('map', {
        attributionControl: false,
    }).setView([-6.295326, 106.6259098], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    let popup = L.popup();
    var marker = L.marker([<?= $sekolah->sek_lokasi ?>]).addTo(map);
    var loc = document.querySelector("[name=sek_lokasi]");
    map.on("click", function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
        loc.value = lat + "," + lng;
    });
</script>
<?= $this->endSection() ?>
