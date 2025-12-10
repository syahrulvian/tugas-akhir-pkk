<?php $this->template->title->set('LOGIN'); ?>
<div class="login-wrapper">
    <div class="login-side-image">
        <div class="login-overlay"></div>
        <div class="position-relative text-white z-2">
            <h1 class="fw-bold display-4">Selamat Datang Kembali.</h1>
            <p class="lead opacity-75">Akses ribuan peluang karir eksklusif hanya untuk Alumni SMKN 1 Purwosari.</p>
            <div class="mt-4">
                <small class="d-block mb-1 text-warning fw-bold">POWERED BY</small>
                <div class="d-flex align-items-center gap-2">
                    <img src="<?php echo base_url('assets/logosmkn.png') ?>" style="width: 40px;" alt="Logo">
                    <span class="fw-bold">BKK SMKN 1 PURWOSARI SYSTEM</span>
                </div>
            </div>
        </div>
    </div>

    <div class="login-content">
        <div class="mb-5">
            <a href="<?= site_url('home') ?>" class="text-decoration-none text-muted fw-bold"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
        </div>

        <div class="mb-4">
            <h2 class="fw-bold text-dark">Login</h2>
            <p class="text-muted">Silahkan pilih jenis akun Anda untuk masuk.</p>
        </div>

        <!-- <ul class="nav nav-pills nav-pills-custom mb-4" id="pills-tab" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link active py-3" id="pills-alumni-tab" data-bs-toggle="pill" data-bs-target="#pills-alumni" type="button">
                    <i class="fas fa-user-graduate me-2"></i> Alumni / Siswa
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link py-3" id="pills-mitra-tab" data-bs-toggle="pill" data-bs-target="#pills-mitra" type="button">
                    <i class="fas fa-briefcase me-2"></i> Perusahaan
                </button>
            </li>
        </ul> -->

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-alumni">
                <?php echo form_open('', array('id' => 'login-form')); ?>
                <div class="form-floating mb-3 form-floating-custom">
                    <input type="text" class="form-control" id="nisn" name="authentication_id" placeholder="NISN" autocomplete="off">
                    <label for="nisn">Username</label>
                </div>
                <div class="form-floating mb-4 form-floating-custom">
                    <input type="password" class="form-control" id="password" name="authentication_password" placeholder="Password" autocomplete="off">
                    <label for="password">Password</label>
                </div>


                <script>
                    const passwordInput = document.getElementById("password");
                    const togglePassword = document.getElementById("togglePassword");
                    togglePassword.addEventListener("click", function() {
                        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                        passwordInput.setAttribute("type", type);
                        this.innerHTML = type === "password" ? "&#128065;" : "&#128683;";
                    });
                </script>
                <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                    </div>
                </div> -->
                <button class="btn btn-primary w-100 py-3 fw-bold rounded-3" id="btn01" style="background-color: #0f172a; border:none;">MASUK SEKARANG</button>
            </div>

            <!-- <div class="tab-pane fade" id="pills-mitra">
                <div class="alert alert-warning border-0 small mb-3">
                    <i class="fas fa-info-circle me-1"></i> Area khusus HRD & Perwakilan Perusahaan.
                </div>
                <div class="form-floating mb-3 form-floating-custom">
                    <input type="email" class="form-control" id="emailCorp" placeholder="Email Perusahaan">
                    <label for="emailCorp">Email Perusahaan</label>
                </div>
                <div class="form-floating mb-4 form-floating-custom">
                    <input type="password" class="form-control" id="codeAccess" placeholder="Kode Akses">
                    <label for="codeAccess">Kode Akses / Password</label>
                </div> -->
            <button class="btn btn-warning text-white w-100 py-3 fw-bold rounded-3" id="btn02" style="background-color: #f59e0b; border:none;">LOGIN MITRA</button>
            <?php echo form_close(); ?>
            <!-- </div> -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span class="text-muted small">Belum punya akun? <a href="<?= site_url('signup') ?>" class="text-accent fw-bold text-decoration-none">Daftar</a></span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        localStorage.removeItem('password');
        localStorage.removeItem('username');

        $('#btn02').hide();
        $('#login-form').submit(function(event) {
            event.preventDefault();
            $('#btn01').hide();
            $('#btn02').show();

            $('#login-form').loading();

            $.ajax({
                    url: '<?php echo site_url('postdata/public_post/auth/do_login') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('#login-form').serialize(),
                })
                .done(function(data) {
                    updateCSRF(data.csrf_data);
                    if (data.status) {

                        if (data.user_status == 'admin' || data.user_status == 'staff') {
                            location.href = "<?php echo site_url('dashboard'); ?>";
                        } else {
                            location.href = "<?php echo site_url('/'); ?>";
                        }

                    } else {
                        swal(
                            data.heading,
                            data.message,
                            data.type
                        )
                    }
                })
                .always(function() {
                    $('#login-form').loading('stop');
                    $('#btn01').show();
                    $('#btn02').hide();
                });
        });
    });
</script>