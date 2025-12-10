<?php
// PHP Configuration
$this->template->title->set('New Testimoni');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('New Testimoni');
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    /* --- ENTERPRISE STUDIO DESIGN SYSTEM --- */
    :root {
        --color-brand: #2563eb;
        /* Modern Royal Blue */
        --color-brand-dark: #1e40af;
        --color-dark: #0f172a;
        /* Slate 900 */
        --color-surface: #ffffff;
        --color-bg: #f8fafc;
        /* Slate 50 */
        --color-border: #e2e8f0;
        --color-text-main: #334155;
        --color-text-light: #64748b;

        --shadow-elevation: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        --radius-outer: 24px;
        --radius-inner: 12px;
    }

    body {
        font-family: 'Inter', sans-serif;
        /* Font sangat clean untuk UI */
        background-color: #f1f5f9;
        color: var(--color-text-main);
    }

    /* 1. LAYOUT CONTAINER (Split Screen) */
    .studio-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .studio-card {
        background: var(--color-surface);
        width: 100%;
        max-width: 1100px;
        display: flex;
        border-radius: var(--radius-outer);
        box-shadow: var(--shadow-elevation);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    /* 2. LEFT PANEL (Dark Side - Visual Preview) */
    .studio-sidebar {
        width: 38%;
        background: var(--color-dark);
        padding: 3.5rem 2.5rem;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Circle/Glow di background gelap */
    .studio-sidebar::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.4) 0%, rgba(37, 99, 235, 0) 70%);
        border-radius: 50%;
    }

    .sidebar-header h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .sidebar-desc {
        color: #94a3b8;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Kartu Preview Live */
    .preview-card-mockup {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        text-align: center;
    }

    .preview-avatar-box {
        width: 90px;
        height: 90px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        border: 3px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        background: #1e293b;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-avatar-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
        /* JS will toggle this */
    }

    .preview-placeholder-icon {
        font-size: 2rem;
        color: #475569;
    }

    /* 3. RIGHT PANEL (Form Area) */
    .studio-form-area {
        width: 62%;
        padding: 3.5rem;
        background: var(--color-surface);
        overflow-y: auto;
        /* Jika layar pendek */
    }

    .form-section-title {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: var(--color-brand);
        margin-bottom: 1.5rem;
        display: block;
    }

    /* Modern Input Styling */
    .input-group-studio {
        margin-bottom: 1.75rem;
        position: relative;
    }

    .label-studio {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-text-main);
        margin-bottom: 0.5rem;
    }

    .field-studio {
        width: 100%;
        background: #f8fafc;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-inner);
        padding: 0.9rem 1rem;
        font-size: 1rem;
        color: var(--color-text-main);
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }

    .field-studio:focus {
        background: #fff;
        border-color: var(--color-brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    textarea.field-studio {
        min-height: 120px;
        resize: vertical;
    }

    /* Custom File Input that looks like a button */
    .file-upload-wrapper {
        border: 2px dashed var(--color-border);
        border-radius: var(--radius-inner);
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: 0.2s;
        position: relative;
    }

    .file-upload-wrapper:hover {
        background: #f0f9ff;
        border-color: var(--color-brand);
    }

    .file-upload-text {
        font-size: 0.9rem;
        color: var(--color-text-light);
    }

    .file-upload-input-hidden {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Button "High-End" */
    .btn-studio-primary {
        background: var(--color-brand);
        color: white;
        border: none;
        width: 100%;
        padding: 1rem;
        border-radius: var(--radius-inner);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.1s, box-shadow 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-studio-primary:hover {
        background: var(--color-brand-dark);
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
        transform: translateY(-2px);
    }

    .btn-studio-primary:active {
        transform: translateY(0);
    }

    /* Responsive Tablet/Mobile */
    @media (max-width: 991px) {
        .studio-card {
            flex-direction: column;
            max-width: 600px;
        }

        .studio-sidebar {
            width: 100%;
            padding: 2.5rem;
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }

        .studio-sidebar::before {
            display: none;
        }

        .preview-card-mockup {
            display: none;
        }

        /* Hide preview card on mobile to save space */
        .studio-form-area {
            width: 100%;
            padding: 2rem;
        }

        .sidebar-desc {
            display: none;
        }

        /* Simplify header on mobile */
    }
</style>
<?php $user = $this->ion_auth->user()->row(); ?>


<br><br>
<div class="studio-wrapper">
    <div class="studio-card">

        <div class="studio-sidebar">
            <div class="sidebar-header position-relative z-1">
                <h3>Tambah<br>Kisah Sukses.</h3>
                <p class="sidebar-desc mt-3">
                    Testimoni alumni adalah aset berharga. Gunakan form ini untuk menambahkan cerita inspiratif baru ke beranda website.
                </p>
            </div>

            <div class="preview-card-mockup">
                <div class="preview-avatar-box">
                    <img id="gambarcover" src="" alt="Preview">
                    <i id="icon-placeholder" class="fas fa-camera preview-placeholder-icon"></i>
                </div>
                <div style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Preview Foto Alumni</div>
                <div id="filename-display" style="color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-top: 5px;">Belum ada foto dipilih</div>
            </div>
        </div>

        <div class="studio-form-area">
            <?php echo form_open_multipart('', 'id="nwtestimoni"') ?>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" id="csrf_token_nw" />

            <span class="form-section-title">Informasi Utama</span>

            <div class="row">
                <div class="col-md-12">
                    <div class="input-group-studio">
                        <label for="testimoni_name" class="label-studio">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="field-studio" name="testimoni_name" value="<?= htmlspecialchars($user->user_fullname) ?>" id="testimoni_name" placeholder="Nama Alumni" required>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="input-group-studio">
                        <label for="testimoni_profesi" class="label-studio">Posisi Saat Ini <span class="text-danger">*</span></label>
                        <input type="text" class="field-studio" name="testimoni_profesi" id="testimoni_profesi" placeholder="Cth: HR Manager di BUMN" required>
                    </div>
                </div> -->
            </div>

            <div class="input-group-studio">
                <label for="testimoni_judul" class="label-studio">Headline Singkat <span class="text-danger">*</span></label>
                <input type="text" class="field-studio" name="testimoni_judul" id="testimoni_judul" placeholder="Cth: BKK Membuka Jalan Karirku" required>
            </div>

            <div class="input-group-studio">
                <label for="testimoni_desc" class="label-studio">Cerita Lengkap <span class="text-danger">*</span></label>
                <textarea class="field-studio" name="testimoni_desc" id="testimoni_desc" placeholder="Tuliskan pengalaman alumni secara detail..." required></textarea>
            </div>

            <span class="form-section-title mt-4">Media</span>

            <div class="input-group-studio">
                <label class="label-studio">Upload Foto Profil</label>
                <div class="file-upload-wrapper">
                    <input name="testimoni_img" type="file" class="file-upload-input-hidden" id="imgcover" onchange="getimggg(this)" accept="image/*">
                    <div class="file-upload-content">
                        <i class="fas fa-cloud-upload-alt text-primary fa-2x mb-2"></i>
                        <p class="file-upload-text mb-0"><strong>Klik disini</strong> atau drag foto alumni ke kotak ini.</p>
                        <p class="small text-muted mb-0">JPG/PNG, Rasio 1:1, Maks 2MB</p>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: #f1f5f9;">

            <button type="submit" id="btns1" class="btn-studio-primary">
                <span id="btnText">Publish Testimoni</span>
                <span id="btnSpinner" style="display:none;">
                    <i class="fas fa-circle-notch fa-spin"></i> Processing...
                </span>
            </button>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    // JS 1: Visual Image Preview Logic
    // Berfungsi menghubungkan Input di Kanan dengan Preview di Kiri
    function getimggg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Tampilkan gambar pada elemen IMG di sidebar kiri
                $('#gambarcover').attr('src', e.target.result).show();
                // Sembunyikan ikon kamera placeholder
                $('#icon-placeholder').hide();
                // Update teks nama file di sidebar kiri
                $('#filename-display').text(input.files[0].name).css('color', '#4ade80'); // Warna hijau muda

                // Update visual border di upload box (opsional visual feedback)
                $('.file-upload-wrapper').css('border-color', '#2563eb').css('background', '#eff6ff');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            // Reset jika cancel
            $('#gambarcover').hide().attr('src', '');
            $('#icon-placeholder').show();
            $('#filename-display').text('Belum ada foto dipilih').css('color', 'rgba(255,255,255,0.5)');
            $('.file-upload-wrapper').css('border-color', '').css('background', '');
        }
    }

    // JS 2: Button State
    document.getElementById('nwtestimoni').addEventListener('submit', function(e) {
        document.getElementById('btnText').style.display = 'none';
        document.getElementById('btnSpinner').style.display = 'inline-block';
    });
</script>

<script>
    // --- FUNGSI GLOBAL & AJAX HANDLER (TIDAK BERUBAH) ---

    // 1. Rating Handler (Hidden visual, but logic kept for compatibility)
    function setupRating() {
        const $ratingContainer = $('#ratingInput');
        const $ratingValueInput = $('#testimoni_rating_value');
        for (let i = 1; i <= 5; i++) {
            $ratingContainer.append(`<i class="fas fa-star" data-value="${i}" style="margin-right: 5px;"></i>`);
        }

        function updateStars(rating, hover = false) {
            $ratingContainer.find('i').each(function() {
                const starValue = parseInt($(this).data('value'));
                if (starValue <= rating) {
                    $(this).removeClass('far').addClass('fas');
                } else {
                    $(this).removeClass('fas').addClass('far');
                }
            });
        }
        $ratingContainer.on('click', 'i', function() {
            const value = parseInt($(this).data('value'));
            $ratingValueInput.val(value);
            updateStars(value);
        });
        $ratingContainer.on('mouseenter', 'i', function() {
            const value = parseInt($(this).data('value'));
            updateStars(value, true);
        }).on('mouseleave', function() {
            updateStars(parseInt($ratingValueInput.val()));
        });
        updateStars(parseInt($ratingValueInput.val()));
    }

    jQuery(document).ready(function($) {
        setupRating();
        $('#btnSpinner').hide();

        function updateCSRF(csrf_data) {
            if (csrf_data) {
                $('[name="' + csrf_data.name + '"]').val(csrf_data.hash);
                $('#csrf_token_nw').val(csrf_data.hash);
            }
        }

        $('#nwtestimoni').submit(function(event) {
            event.preventDefault();

            // Validation Highlight
            const requiredFields = ['testimoni_name', 'testimoni_profesi', 'testimoni_judul', 'testimoni_desc'];
            let isValid = true;

            for (const fieldName of requiredFields) {
                const $field = $(`[name="${fieldName}"]`);
                if (!$field.val().trim()) {
                    $field.css('border-color', '#ef4444'); // Merah terang
                    isValid = false;
                } else {
                    $field.css('border-color', '#e2e8f0'); // Kembali normal
                }
            }

            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Mohon isi semua kolom yang bertanda bintang (*).',
                    confirmButtonColor: '#2563eb'
                });
                $('#btnText').show();
                $('#btnSpinner').hide();
                return;
            }

            $('#btnText').hide();
            $('#btnSpinner').show();
            $('#btns1').prop('disabled', true);

            $.ajax({
                    url: '<?php echo site_url('postdata/admin_post/testimoni/savenewtestimoni') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function(data) {
                    updateCSRF(data.csrf_data);

                    Swal.fire({
                        icon: data.type || 'success',
                        title: data.heading || 'Berhasil',
                        text: data.message || 'Data testimoni tersimpan.',
                        confirmButtonColor: '#2563eb'
                    }).then(function() {
                        if (data.status) {
                            window.location.href = "<?php echo site_url('testimoni') ?>";
                        }
                    });

                    $('#btnText').show();
                    $('#btnSpinner').hide();
                    $('#btns1').prop('disabled', false);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal menghubungi server.',
                    });

                    $.get('<?php echo site_url("auth/get_csrf") ?>', function(csrf_data) {
                        updateCSRF(csrf_data);
                    }, 'json');

                    $('#btnText').show();
                    $('#btnSpinner').hide();
                    $('#btns1').prop('disabled', false);
                });
        });
    });
</script>