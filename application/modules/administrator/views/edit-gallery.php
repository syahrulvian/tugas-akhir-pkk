<?php
$this->template->title->set('Edit Galeri');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Perbarui Data Galeri');

$code = $this->input->get('code') ?? '';
$this->db->where('gallery_code', $code);
$getdata = $this->db->get('tb_gallery')->row();

if (!$getdata) {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert"><i class="fas fa-exclamation-triangle me-2"></i> Data galeri tidak ditemukan.</div>';
    echo '<a href="' . site_url('admin/gallery') . '" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Galeri</a>';
    return;
}

$old_images = json_decode($getdata->gallery_image, true) ?? [];
?>

<div class="card shadow-sm border-warning mb-4">
    <div class="card-header bg-warning text-dark d-flex align-items-center fw-bold fs-5">
        <i class="fas fa-edit me-2"></i> Edit Data Galeri
    </div>
    <div class="card-body">
        <?php echo form_open_multipart('', 'id="editGallery"'); ?>

        <input type="hidden" name="gallery_code" value="<?php echo htmlspecialchars($getdata->gallery_code); ?>">

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Galeri <span class="text-danger">*</span></label>
            <input type="text" name="galeri_title" class="form-control"
                value="<?php echo htmlspecialchars($getdata->gallery_title); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi Galeri <span class="text-danger">*</span></label>
            <textarea name="galeri_description" class="form-control" rows="4"
                required><?php echo htmlspecialchars($getdata->gallery_description); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold"><i class="fas fa-images me-1"></i> Gambar Saat Ini</label>
            <p class="text-muted small mb-2">Klik ikon ❌ untuk menghapus gambar lama.</p>
            <div class="d-flex flex-wrap gap-3 p-3 border rounded bg-light" id="existingImagesContainer">
                <?php if (!empty($old_images)): ?>
                    <?php foreach ($old_images as $img): ?>
                        <div class="position-relative d-inline-block image-item"
                            data-filename="<?php echo htmlspecialchars($img); ?>">
                            <img src="<?php echo base_url('assets/gallery/' . $img); ?>" class="img-thumbnail shadow-sm"
                                style="width: 120px; height: 120px; object-fit: cover;"
                                title="<?php echo htmlspecialchars($img); ?>">
                            <!-- Tombol hapus -->
                            <button type="button"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle delete-image-btn"
                                title="Hapus Gambar" data-filename="<?php echo htmlspecialchars($img); ?>"> <i
                                    class="fas fa-times"></i> </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted fst-italic">Belum ada gambar di galeri ini.</p>
                <?php endif; ?>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label fw-semibold"><i class="fas fa-cloud-upload-alt me-1"></i> Tambah Gambar
                Baru</label>
            <div class="border border-dashed p-3 rounded bg-light text-center" id="dropArea">
                <p class="mb-2 text-muted">Tarik & letakkan file di sini atau klik untuk memilih.</p>
                <input name="galeri_images[]" type="file" multiple class="form-control d-none" id="imgGallery"
                    accept="image/jpeg, image/png">
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnSelectImages">
                    <i class="fas fa-file-image me-1"></i> Pilih File
                </button>
                <p class="small text-muted mt-2" id="fileCountText">Belum ada file dipilih</p>
            </div>

            <div class="mt-3">
                <p class="fw-semibold mb-2">Pratinjau Gambar Baru:</p>
                <div id="previewContainer" class="d-flex flex-wrap gap-3 p-2 border rounded bg-light">
                    <span class="text-muted fst-italic">Gambar baru akan muncul di sini.</span>
                </div>
            </div>
        </div>

        <input type="hidden" name="deleted_images" id="deletedImages" value="[]">

        <script>
            const fileInput = document.getElementById('imgGallery');
            const previewContainer = document.getElementById('previewContainer');
            const fileCountText = document.getElementById('fileCountText');
            const dropArea = document.getElementById('dropArea');
            const btnSelect = document.getElementById('btnSelectImages');
            const deletedInput = document.getElementById('deletedImages');
            let deletedImages = [];

            // --- Drag & Drop ---
            dropArea.addEventListener('click', () => fileInput.click());
            dropArea.addEventListener('dragover', e => {
                e.preventDefault();
                dropArea.classList.add('border-primary', 'bg-white');
            });
            dropArea.addEventListener('dragleave', () => {
                dropArea.classList.remove('border-primary', 'bg-white');
            });
            dropArea.addEventListener('drop', e => {
                e.preventDefault();
                dropArea.classList.remove('border-primary', 'bg-white');
                fileInput.files = e.dataTransfer.files;
                previewGallery(fileInput);
            });

            // --- Preview gambar baru ---
            fileInput.addEventListener('change', () => previewGallery(fileInput));

            function previewGallery(input) {
                previewContainer.innerHTML = '';
                const files = Array.from(input.files);

                if (files.length > 0) {
                    fileCountText.textContent = `${files.length} file dipilih`;
                    files.forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'position-relative d-inline-block';
                            wrapper.style.width = '120px';
                            wrapper.style.height = '120px';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail shadow-sm';
                            img.style.width = '120px';
                            img.style.height = '120px';
                            img.style.objectFit = 'cover';

                            const delBtn = document.createElement('button');
                            delBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle';
                            delBtn.innerHTML = '<i class="fas fa-times"></i>';
                            delBtn.title = 'Hapus Gambar';
                            delBtn.addEventListener('click', () => wrapper.remove());

                            wrapper.appendChild(img);
                            wrapper.appendChild(delBtn);
                            previewContainer.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    fileCountText.textContent = 'Belum ada file dipilih';
                    previewContainer.innerHTML = '<span class="text-muted fst-italic">Gambar baru akan muncul di sini.</span>';
                }
            }

            // --- Hapus gambar lama ---
            $(document).on('click', '.delete-image-btn', function () {
                const filename = $(this).data('filename');
                const code = '<?php echo $getdata->gallery_code; ?>';
                const imageItem = $(this).closest('.image-item');

                Swal.fire({
                    title: 'Hapus Gambar Ini?',
                    text: filename,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '<?= site_url('postdata/admin_post/Gallery/deletegalleryimage') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                gallery_code: code,
                                filename: filename,
                                '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
                            },
                            success: function (data) {
                                if (typeof updateCSRF === 'function') updateCSRF(data.csrf_data);
                                if (data.status) {
                                    imageItem.fadeOut(300, () => imageItem.remove());
                                    deletedImages.push(filename);
                                    deletedInput.value = JSON.stringify(deletedImages);
                                }
                                Swal.fire(data.heading, data.message, data.type);
                                location.reload();
                            },
                            error: (xhr, status, error) => {
                                Swal.fire('Error', 'Terjadi kesalahan: ' + error, 'error');
                            }
                        });
                    }
                });
            });
        </script>


        <div class="d-flex justify-content-end mt-4">
            <button type="button" onclick="history.back()" class="btn btn-secondary me-2 fw-bold">
                <i class="fas fa-arrow-left"></i> Batal / Kembali
            </button>
            <button type="submit" id="btns1" class="btn btn-warning fw-bold text-dark">
                <i class="fas fa-sync-alt"></i> PERBARUI GALERI
            </button>
            <button type="button" id="btns2" disabled class="btn btn-danger fw-bold" style="display:none;">
                <i class="fas fa-spinner fa-spin"></i> PROSES PEMBARUAN...
            </button>
        </div>

        <?php echo form_close(); ?>

        <script>
            jQuery(document).ready(function ($) {
                $('#btns2').hide();

                $('#editGallery').submit(function (event) {
                    event.preventDefault();
                    $('#btns1').hide();
                    $('#btns2').show();

                    $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/Gallery/updategalery') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                    })
                        .done(function (data) {
                            if (typeof updateCSRF === 'function') {
                                updateCSRF(data.csrf_data);
                            }
                            Swal.fire(data.heading, data.message, data.type).then(function () {
                                if (data.status) {
                                    location.href = "<?php echo site_url('admin/gallery') ?>";
                                }
                            });
                            $('#btns1').show();
                            $('#btns2').hide();
                        })
                        .fail(function () {
                            $('#btns1').show();
                            $('#btns2').hide();
                            Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                        });
                });
            });
        </script>
    </div>
</div>