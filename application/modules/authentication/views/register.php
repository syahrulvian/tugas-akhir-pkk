<?php $this->template->title->set('Registration'); ?>
<div class="login-wrapper">

    <div class="login-side-image">
        <div class="login-overlay"></div>
        <div class="position-relative text-white z-2">
            <h1 class="fw-bold display-4">Mulai Karir Suksesmu.</h1>
            <p class="lead opacity-75">Satu akun untuk terhubung dengan ratusan perusahaan bonafit dan alumni lainnya.</p>
            <div class="mt-4">
                <small class="d-block mb-1 text-warning fw-bold">KEUNTUNGAN MEMBER</small>
                <ul class="list-unstyled small opacity-75">
                    <li class="mb-1"><i class="fas fa-check me-2"></i>Notifikasi Lowongan Prioritas</li>
                    <li class="mb-1"><i class="fas fa-check me-2"></i>Akses Job Fair Eksklusif</li>
                    <li class="mb-1"><i class="fas fa-check me-2"></i>Tracking Lamaran Real-time</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="login-content">
        <div class="mb-4">
            <a href="<?= site_url('login') ?>" class="text-decoration-none text-muted fw-bold"><i class="fas fa-arrow-left me-2"></i> Login</a>
        </div>

        <div class="mb-4">
            <h2 class="fw-bold text-dark">Buat Akun Baru</h2>
            <p class="text-muted">Lengkapi data diri Anda untuk validasi alumni.</p>
        </div>

        <?php echo form_open_multipart('', array('id' => 'regis-form')); ?>
        <div class="form-floating mb-3 form-floating-custom">
            <input type="text" class="form-control" id="username" name="user_username" placeholder="Username" autocomplete="off">
            <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3 form-floating-custom">
            <input type="text" class="form-control" id="fullname" name="user_fullname" placeholder="Nama Lengkap" autocomplete="off">
            <label for="user_fullname">Nama Lengkap</label>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <div class="form-floating form-floating-custom">
                    <input type="email" class="form-control" id="email" name="user_email" placeholder="Email" autocomplete="off">
                    <label for="email">Email Aktif</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating form-floating-custom">
                    <input type="text" class="form-control" id="phone" name="user_phone" placeholder="No WhatsApp" autocomplete="off">
                    <label for="phone">No. WhatsApp</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-4 form-floating-custom">
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="user_password" placeholder="Buat Password" autocomplete="off">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">&#128065;</button>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload CV (PDF / DOC / DOCX)</label>
            <input type="file" class="form-control" name="user_cv" id="user_cv" accept=".pdf,.doc,.docx">
        </div>

        <!-- <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label small text-muted" for="terms">
                Saya menyetujui <a href="#" class="text-dark fw-bold text-decoration-none">Kebijakan Privasi</a> BKK.
            </label>
        </div> -->

        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3" id="btn01" style="background-color: #0f172a; border: none;">DAFTAR SEKARANG</button>
        <button type="button" class="btn btn-primary w-100 py-3 fw-bold rounded-3" id="btn02" style="background-color: #0f172a; border: none;">PROSES...</button>
        <?php echo form_close(); ?>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <span class="text-muted small">Sudah punya akun? <a href="<?= site_url('login') ?>" class="text-accent fw-bold text-decoration-none">Masuk</a></span>
        </div>
    </div>
</div>

<script>
    // WhatsApp input
    // $('#noWA').on('input', function() {
    //     if (this.value.startsWith('08')) {
    //         this.value = "628";
    //     }
    //     this.value = this.value.replace(/[^0-9]/g, '');
    // });

    // Show/hide password
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    togglePassword.addEventListener("click", function() {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        this.innerHTML = type === "password" ? "&#128065;" : "&#128683;";
    });

    // Form submit
    jQuery(document).ready(function($) {
        $('#btn02').hide();

        $('#regis-form').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $('#btn01').hide();
            $('#btn02').show();
            $('#regis-form').loading();

            $.ajax({
                    url: '<?php echo site_url('postdata/public_post/auth/do_register') ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                })
                .done(function(data) {
                    updateCSRF(data.csrf_data);
                    swal(data.heading, data.message, data.type).then(function() {
                        if (data.status) {
                            location.href = '<?= site_url('login') ?>';
                        }
                    });
                })
                .always(function() {
                    $('#regis-form').loading('stop');
                    $('#btn01').show();
                    $('#btn02').hide();
                });
        });
    });
</script>