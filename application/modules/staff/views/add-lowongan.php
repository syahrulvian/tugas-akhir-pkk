<?php
$jurusan_list = $this->db
    ->where('jenis_kategori', 'keahlian')
    ->get('tb_kategori')
    ->result();
$tipe_kerja_list = $this->db
    ->where('jenis_kategori', 'tipe_kerja')
    ->get('tb_kategori')
    ->result();
?>
<?php echo form_open('', 'id="newlowongan"'); ?>

<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white border-bottom">
        <h5 class="card-title mb-0 d-flex align-items-center">
            <i class="fas fa-briefcase me-2"></i>
            Formulir Tambah Lowongan Baru
        </h5>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="lowonganJudul" class="form-label fw-bold">Judul Lowongan</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <input type="text" class="form-control" id="lowonganJudul" name="lowongan_judul"
                        placeholder="Contoh: Staff IT">
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="lowonganJurusan" class="form-label fw-bold">Jurusan</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-graduation-cap"></i>
                    </span>

                    <select name="lowongan_jurusan" class="form-control">
                        <option value="">-- Pilih Keahlian --</option>
                        <?php foreach ($jurusan_list as $j): ?>
                            <option value="<?= $j->id_kategori ?>">
                                <?= $j->nama_kategori ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lowonganTipeKerja" class="form-label fw-bold">Type</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-graduation-cap"></i>
                    </span>

                    <select name="lowongan_tipe_kerja" class="form-control">
                        <option value="">-- Pilih Tipe Kerja --</option>
                        <?php foreach ($tipe_kerja_list as $t): ?>
                            <option value="<?= $t->id_kategori ?>">
                                <?= $t->nama_kategori ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lowonganJudul" class="form-label fw-bold">No telepon/WA</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control" id="lowonganTelepon" name="lowongan_nomor"
                        placeholder="Contoh: 081xxxxxxx">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="lowongan_perusahaan" class="form-label fw-bold">Perusahaan</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="lowongan_perusahaan" class="form-control" placeholder="Contoh : Pt Mari">
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="lowonganAlamat" class="form-label fw-bold">Alamat Perusahaan</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" class="form-control" id="lowonganAlamat" name="lowongan_alamat"
                        placeholder="Contoh: Jakarta Selatan">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Durasi Lowongan</label>
            <div class="row g-2">
                <div class="col">
                    <label class="form-label small text-muted">Tanggal Mulai</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        <input type="date" class="form-control" name="lowongan_start">
                    </div>
                </div>
                <div class="col">
                    <label class="form-label small text-muted">Tanggal Akhir</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        <input type="date" class="form-control" name="lowongan_end">
                    </div>
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label for="lowonganDesc" class="form-label fw-bold">Deskripsi Lowongan</label>
            <textarea id="lowonganDesc" name="lowongan_desc" class="form-control" rows="6"
                placeholder="Jelaskan tugas dan kualifikasi lowongan ini."></textarea>
        </div>

        <div class="mb-3">
            <label>Upload Gambar</label>
            <div class="custom-file">
                <input name="cover_lowongan" type="file" class="custom-file-input" id="imgcover"
                    onchange="getimggg(this)">
                <label class="custom-file-label" for="imgcover">Pilih Gambar</label>
            </div>
            <small class="text-danger">Pilih Gambar Untuk Melihat Preview</small><br>
            <img id="gambarcover" style="max-width:150px; max-height:150px;margin-top: 10px;border: 1px solid #ddd">
            <script type="text/javascript">
                function getimggg(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#gambarcover')
                                .attr('src', e.target.result);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
        </div>

    </div>

    <div class="card-footer text-end bg-light border-top">
        <a href="<?= site_url('staff/lowongan') ?>" class="btn btn-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button type="submit" id="btns1" class="btn btn-primary fw-bold">
            <i class="fas fa-paper-plane me-1"></i> Simpan Lowongan
        </button>
        <button type="button" id="btns2" class="btn btn-secondary fw-bold">
            <i class="fas fa-paper-plane me-1"></i> Memproses
        </button>
    </div>
</div>
<?php echo form_close() ?>
<script>
    jQuery(document).ready(function($) {

        $('#btns2').hide();
        $('#newlowongan').submit(function(event) {
            event.preventDefault();
            $('#btns1').hide();
            $('#btns2').show();

            $.ajax({
                    url: '<?php echo site_url('postdata/staff_post/lowongan/addlowongan') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function(data) {

                    // CSRF IS MAGIC
                    updateCSRF(data.csrf_data);

                    Swal.fire(
                        data.heading,
                        data.message,
                        data.type
                    ).then(function() {
                        if (data.status) {
                            location.href = "<?php echo site_url('staff/lowongan') ?>";
                        }
                    });
                    $('#btns1').show();
                    $('#btns2').hide();

                })

        });
    });
</script>