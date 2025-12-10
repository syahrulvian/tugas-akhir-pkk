<?php
$this->template->title->set('Edit Lowongan');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Edit Lowongan');
?>

<?php echo form_open_multipart('', 'id="editlowongan"') ?>
<input type="hidden" name="lowongan_code" value="<?= htmlspecialchars($lowongan->lowongan_code) ?>">
<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white border-bottom">
        <h5 class="card-title mb-0 d-flex align-items-center">
            <i class="fas fa-briefcase me-2"></i>
            Formulir Edit Lowongan
        </h5>
    </div>

    <div class="card-body">

        <!-- ================= JUDUL & KEAHLIAN ================= -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Judul Lowongan</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <input type="text"
                        name="lowongan_judul"
                        class="form-control"
                        required
                        value="<?= html_escape($lowongan->lowongan_judul) ?>">
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Jurusan / Keahlian</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Keahlian --</option>
                        <?php foreach ($jurusan_list as $j): ?>
                            <option value="<?= $j->id_kategori ?>"
                                <?= ($lowongan->kategori_id == $j->id_kategori) ? 'selected' : '' ?>>
                                <?= html_escape($j->nama_kategori) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- ================= TIPE KERJA ================= -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tipe Kerja</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <select name="kategori_tipe" class="form-control" required>
                        <option value="">-- Pilih Tipe Kerja --</option>
                        <?php foreach ($tipe_kerja_list as $t): ?>
                            <option value="<?= $t->id_kategori ?>"
                                <?= ($lowongan->kategori_tipe == $t->id_kategori) ? 'selected' : '' ?>>
                                <?= html_escape($t->nama_kategori) ?>
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
                        placeholder="Contoh: 081xxxxxxx"
                        value="<?= html_escape($lowongan->lowongan_nomor) ?>">
                </div>
            </div>
        </div>

        <!-- ================= PERUSAHAAN & ALAMAT ================= -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Perusahaan</label>
                <input type="text"
                    name="lowongan_perusahaan"
                    class="form-control"
                    value="<?= html_escape($lowongan->lowongan_perusahaan) ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Alamat Perusahaan</label>
                <input type="text"
                    name="lowongan_alamat"
                    class="form-control"
                    value="<?= html_escape($lowongan->lowongan_alamat) ?>">
            </div>
        </div>

        <!-- ================= DURASI ================= -->
        <div class="mb-3">
            <label class="form-label fw-bold">Durasi Lowongan</label>
            <div class="row g-2">
                <div class="col">
                    <input type="date"
                        name="lowongan_start"
                        class="form-control"
                        value="<?= date('Y-m-d', strtotime($lowongan->lowongan_start)) ?>">
                </div>
                <div class="col">
                    <input type="date"
                        name="lowongan_end"
                        class="form-control"
                        value="<?= date('Y-m-d', strtotime($lowongan->lowongan_end)) ?>">
                </div>
            </div>
        </div>

        <!-- ================= DESKRIPSI ================= -->
        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi Lowongan</label>
            <textarea name="lowongan_desc"
                class="form-control"
                rows="5"><?= html_escape($lowongan->lowongan_desc) ?></textarea>
        </div>

        <!-- ================= GAMBAR ================= -->
        <div class="mb-3">
            <label class="form-label fw-bold">Gambar Lowongan</label>
            <input type="file"
                name="lowongan_img"
                class="form-control"
                onchange="previewImg(this)">
            <?php if (!empty($lowongan->lowongan_img)): ?>
                <img id="preview"
                    src="<?= base_url('assets/lowongan/' . $lowongan->lowongan_img) ?>"
                    class="mt-2 rounded"
                    style="max-width:150px">
            <?php else: ?>
                <img id="preview" class="mt-2" style="max-width:150px">
            <?php endif; ?>
        </div>

    </div>

    <div class="card-footer text-end">
        <a href="<?= site_url('staff/lowongan') ?>" class="btn btn-secondary">
            Kembali
        </a>
        <button type="submit" id="btns1" class="btn btn-primary">
            Simpan Perubahan
        </button>
        <button type="button" id="btns2" class="btn btn-primary" disabled style="display:none;">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Menyimpan...
        </button>
    </div>
</div>

<?= form_close(); ?>



<script>
    jQuery(document).ready(function($) {
        $('#btns2').hide();
        $('#editlowongan').submit(function(event) {
            event.preventDefault();
            $('#btns1').hide();
            $('#btns2').show();

            $.ajax({
                    url: '<?php echo site_url('postdata/staff_post/lowongan/updatelowongan') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function(data) {
                    updateCSRF(data.csrf_data);
                    Swal.fire(data.heading, data.message, data.type)
                        .then(function() {
                            if (data.status) {
                                location.href = "<?php echo site_url('staff/lowongan') ?>";
                            }
                        });
                    $('#btns1').show();
                    $('#btns2').hide();
                })
                .fail(function() {
                    $('#btns1').show();
                    $('#btns2').hide();
                    Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                });
        });

    });

    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>