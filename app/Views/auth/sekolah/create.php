<?= $this->extend('layouts/app') ?>

<?= $this->section('pages') ?>Data Sekolah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Tambah Data Sekolah</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= site_url('sekolah/save') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Nomor Pokok Sekolah Nasional (NPSN)</label>
                        <input type="number" class="form-control <?= (validation_show_error('sek_npsn')) ? 'is-invalid' : ''; ?>" placeholder="10293847" id="sek_npsn" required name="sek_npsn" autofocus value="<?= old('sek_npsn'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_npsn'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Sekolah</label>
                        <?php if (session()->get('user_akses') != 'sekolah') : ?>
                            <select class="form-select <?= (validation_show_error('user_id')) ? 'is-invalid' : ''; ?>" id="user_id" required name="user_id">
                                <option value="">Pilih salah satu</option>
                                <option value="NULL">Tidak Ada User</option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?= $user->user_id ?>"><?= ucwords($user->user_name) . ' - ' . ucwords($user->user_email) ?></option>
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
                        <input type="text" class="form-control <?= (validation_show_error('sek_nama')) ? 'is-invalid' : ''; ?>" placeholder="sd/smp/sma nama sekolah" id="sek_nama" required name="sek_nama" autofocus value="<?= old('sek_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Sekolah</label>
                        <select class="form-select <?= (validation_show_error('sek_status')) ? 'is-invalid' : ''; ?>" id="sek_status" required name="sek_status">
                            <option value="">Pilih salah satu</option>
                            <option value="negeri">Negeri</option>
                            <option value="swasta">Swasta</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_status'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenjang Sekolah</label>
                        <select class="form-select <?= (validation_show_error('sek_jenjang')) ? 'is-invalid' : ''; ?>" id="sek_jenjang" required name="sek_jenjang">
                            <option value="">Pilih salah satu</option>
                            <option value="sd">SD/Sederajat</option>
                            <option value="smp">SMP/Sederajat</option>
                            <option value="sma">SMA/Sederajat</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_jenjang'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Sekolah</label>
                        <textarea class="form-control <?= (validation_show_error('sek_alamat')) ? 'is-invalid' : ''; ?>" placeholder="jl. maju jaya 2" id="sek_alamat" required name="sek_alamat" autofocus rows="3"><?= old('sek_alamat'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_alamat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-select <?= (validation_show_error('kec_id')) ? 'is-invalid' : ''; ?>" id="kec_id" required name="kec_id">
                            <option value="">Pilih salah satu</option>
                            <?php foreach ($kecamatan as $kec) : ?>
                                <option value="<?= $kec->kec_id ?>"><?= ucwords($kec->kec_name) ?></option>
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
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kel_id'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lokasi Sekolah</label>
                        <input type="text" class="form-control <?= (validation_show_error('sek_lokasi')) ? 'is-invalid' : ''; ?>" id="sek_lokasi" required placeholder="0.1103241,117.4823823" name="sek_lokasi" autofocus value="<?= old('sek_lokasi'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sek_lokasi'); ?>
                        </div>
                        <div id="map" class="border rounded mt-2" style="height: 400px"></div>
                        <small class="mb-3 text-secondary font-weight-bold">* Silahkan klik lokasi yang ada dimap.</small>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Guru</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_guru')) ? 'is-invalid' : ''; ?>" id="det_guru" required placeholder="100" name="det_guru" autofocus value="<?= old('det_guru'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_guru'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Siswa Perempuan</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_siswa_p')) ? 'is-invalid' : ''; ?>" id="det_siswa_p" required placeholder="100" name="det_siswa_p" autofocus value="<?= old('det_siswa_p'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_siswa_p'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Siswa Laki-Laki</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_siswa_l')) ? 'is-invalid' : ''; ?>" id="det_siswa_l" required placeholder="100" name="det_siswa_l" autofocus value="<?= old('det_siswa_l'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_siswa_l'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Akreditasi Sekolah</label>
                        <select class="form-select <?= (validation_show_error('det_akreditasi')) ? 'is-invalid' : ''; ?>" id="det_akreditasi" required name="det_akreditasi">
                            <option value="">Pilih salah satu</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_akreditasi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kurikulum</label>
                        <input type="number" class="form-control <?= (validation_show_error('det_kurikulum')) ? 'is-invalid' : ''; ?>" id="det_kurikulum" required placeholder="2023" name="det_kurikulum" autofocus value="<?= old('det_kurikulum'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('det_kurikulum'); ?>
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
    var baseURL = "<?php echo base_url(); ?>";
    $(document).ready(function() {
        $('#kec_id').change(function() {
            var kecamatan = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>sekolah/getkelurahan',
                method: 'post',
                data: {
                    kecamatan: kecamatan
                },
                dataType: 'json',
                success: function(response) {
                    $('#kel_id').find('option').not(':first').remove();
                    $.each(response, function(index, data) {
                        const arr = data['kel_name'].split(" ");
                        for (var i = 0; i < arr.length; i++) {
                            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
                        }
                        const kel_name = arr.join(" ");
                        $('#kel_id').append(`<option value="${data['kel_id']}">${kel_name}</option>`);
                    });
                }
            });
        });
    });

    let map = L.map('map', {
        attributionControl: false,
    }).setView([-6.295326, 106.6259098], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    let popup = L.popup();
    var marker = L.marker([0.1372358, 117.4548496]).addTo(map);
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
