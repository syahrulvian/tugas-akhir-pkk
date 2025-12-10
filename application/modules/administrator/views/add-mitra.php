<?php
$this->template->title->set('Tambah Mitra');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Tambah Data Mitra');
?>

<div class="card">
    <div class="card-header">
        <div class="card-title font-weight-bold d-flex justify-content-between align-items-center">
            Tambah Mitra
            <a href="<?= site_url('admin/mitra') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?php echo form_open_multipart('', ['id' => 'add-mitra', 'autocomplete' => 'off']); ?>

    <div class="card-body">

        <!-- NAMA MITRA -->
        <div class="mb-3">
            <label class="form-label">Nama Mitra <span class="text-danger">*</span></label>
            <input type="text" name="mitra_nama" class="form-control" required placeholder="Masukkan nama mitra...">
        </div>

        <!-- KATEGORI MITRA -->
        <div class="mb-3">
            <label class="form-label">Kategori Mitra <span class="text-danger">*</span></label>
            <select name="kategori_mitra_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php
                $kategori = $this->db->get('tb_kategori_mitra')->result();
                foreach ($kategori as $row) {
                    echo '<option value="' . $row->kategori_mitra_id . '">' . $row->kategori_mitra_nama . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- LOGO MITRA -->
        <div class="mb-3">
            <label class="form-label">Logo Mitra <span class="text-danger">*</span></label>
            <input type="file" name="mitra_logo" class="form-control" accept="image/*" required>
        </div>

        <!-- DESKRIPSI -->
        <div class="mb-3">
            <label class="form-label">Deskripsi Mitra</label>
            <textarea name="mitra_deskripsi" class="form-control" rows="4" placeholder="Deskripsi mitra (optional)..."></textarea>
        </div>

        <!-- STATUS -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="mitra_status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Data
        </button>
    </div>

    <?php echo form_close(); ?>
</div>


<script>
    $("#add-mitra").on("submit", function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "<?= site_url('postdata/admin_post/Mitra/add_mitra') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function() {
                Swal.fire({
                    title: "Memproses...",
                    text: "Harap tunggu sebentar",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(data) {

                Swal.fire(data.heading, data.message, data.type).then(function() {
                    if (data.status) {
                        window.location.href = "<?= site_url('admin/mitra') ?>";
                    }
                });
            },
            error: function() {
                Swal.fire("Error", "Terjadi kesalahan pada server.", "error");
            }
        });
    });
</script>