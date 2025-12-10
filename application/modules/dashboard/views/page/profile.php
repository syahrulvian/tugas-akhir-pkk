<?php
// Pastikan script diakses melalui CodeIgniter
defined('BASEPATH') or exit('No direct script access allowed');

/* ======================================================
    CEK LOGIN
====================================================== */
if (!$this->session->userdata('user_id')) {
    redirect('authentication/login');
}

/* ======================================================
    META PAGE
====================================================== */
// $this->template->title->set('Profil Saya | Dashboard');
$this->template->description->set('Tinjauan cepat profil anggota.');
$this->template->keywords->set('profil anggota, dashboard');

/* ======================================================
    AMBIL DATA USER LOGIN
====================================================== */
$user_id = $this->session->userdata('user_id');

$this->db->where('id', $user_id);
$this->db->where('user_status', 'member');
$member = $this->db->get('tb_users')->row();

/* JIKA DATA TIDAK ADA */
if (!$member) {
    echo '<div class="container py-5"><div class="alert alert-danger text-center shadow-sm">
            <i class="fas fa-exclamation-triangle me-2"></i> Data user tidak ditemukan.
          </div></div>';
    return;
}

// Ambil huruf pertama dari nama lengkap untuk inisial
$initial = strtoupper(substr($member->user_fullname, 0, 1));
?>

<section class="container py-5">

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bolder text-dark">
                <i class="fas fa-grip-vertical text-primary me-2"></i> Dashboard Profil
            </h2>
            <p class="text-secondary">
                Selamat datang kembali, informasi ringkas akun Anda.
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">

            <div class="card border-0 shadow-lg horizontal-profile-card">

                <div class="card-avatar-side text-center p-4 bg-primary text-white d-flex flex-column justify-content-center align-items-center">

                    <div class="initial-avatar mb-3">
                        <span class="initial-text"><?= $initial ?></span>
                    </div>

                    <h5 class="fw-bold mb-1 text-shadow">Member Aktif</h5>
                    <p class="small mb-0 text-white-50">
                        Bergabung Sejak <?= date('d M Y', $member->created_on) ?>
                    </p>
                </div>

                <div class="card-body p-4 d-flex flex-column justify-content-center">

                    <h3 class="fw-bolder mb-0 text-dark">
                        <?= $member->user_fullname ?>
                    </h3>

                    <div class="row g-3 mt-3">

                        <div class="col-md-6">
                            <h6 class="text-uppercase text-secondary fw-bold small mb-1">
                                <i class="fas fa-user-tag me-1 text-info"></i> Username
                            </h6>
                            <p class="mb-0 fw-bold text-dark">@<?= $member->username ?></p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-uppercase text-secondary fw-bold small mb-1">
                                <i class="fas fa-key me-1 text-danger"></i> Hash Sandi
                            </h6>
                            <p class="mb-0 fw-medium text-monospace small text-break" title="Ini adalah nilai hash, bukan sandi asli.">
                                <?= $member->user_passtext ?>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-uppercase text-secondary fw-bold small mb-1">
                                <i class="fas fa-envelope me-1 text-info"></i> Email
                            </h6>
                            <p class="mb-0 fw-medium text-dark"><?= $member->email ?></p>
                        </div>

                        <div class="col-md-6">
                            <?php if (!empty($member->user_phone)) : ?>
                                <h6 class="text-uppercase text-secondary fw-bold small mb-1">
                                    <i class="fas fa-phone-alt me-1 text-success"></i> Telepon
                                </h6>
                                <p class="mb-0 fw-medium text-dark"><?= $member->user_phone ?></p>
                            <?php else : ?>
                                <h6 class="text-uppercase text-secondary fw-bold small mb-1">
                                    <i class="fas fa-phone-alt me-1 text-warning"></i> Telepon
                                </h6>
                                <p class="mb-0 fst-italic text-muted">Belum Ditambahkan</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-secondary fw-bold small mb-1">
                                <i class="fas fa-file-alt me-1 text-primary"></i> Curriculum Vitae (CV)
                            </h6>

                            <?php if (!empty($member->user_cv)) : ?>
                                <a href="<?= base_url('assets/cv/' . $member->user_cv) ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye me-1"></i> Lihat CV
                                </a>

                                <a href="<?= base_url('download-pdf/' . $member->user_code) ?>"
                                    class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-download"></i> Download CV
                                </a>

                            <?php else : ?>
                                <p class="fst-italic text-muted mb-0">Belum Upload CV</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-start align-items-center flex-wrap">
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-4 me-2 mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditProfile">
                            <i class="fas fa-user-edit me-1"></i> Edit Detail Profil
                        </button>

                        <button class="btn btn-outline-danger btn-sm rounded-pill px-4 me-2 mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalChangePassword">
                            <i class="fas fa-lock me-1"></i> Ubah Sandi
                        </button>


                    </div>

                </div>

            </div>

        </div>
    </div>

</section>

<style>
    /* ------------------------------------ */
    /* HORIZONTAL CARD STYLING      */
    /* ------------------------------------ */

    .horizontal-profile-card {
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        min-height: 280px;
    }

    .horizontal-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12), 0 0 0 6px rgba(0, 123, 255, 0.08);
    }

    /* Bagian Kiri (Avatar Side) */
    .card-avatar-side {
        flex: 0 0 250px;
        background-image: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        position: relative;
    }

    /* Responsif */
    @media (max-width: 992px) {
        .horizontal-profile-card {
            flex-direction: column;
            min-height: auto;
        }

        .card-avatar-side {
            flex: 0 0 auto;
            border-radius: 20px 20px 0 0 !important;
        }
    }

    /* ------------------------------------ */
    /* AVATAR INSIAL            */
    /* ------------------------------------ */

    .initial-avatar {
        width: 100px;
        height: 100px;
        background-color: #ffffff;
        color: #007bff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 3.5rem;
        font-weight: 800;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border: 4px solid rgba(255, 255, 255, 0.7);
        transition: all 0.3s ease-out;
    }

    .horizontal-profile-card:hover .initial-avatar {
        transform: scale(1.08);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }

    .text-shadow {
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    /* Gaya tambahan untuk hash sandi */
    .text-monospace {
        font-family: 'Consolas', 'Courier New', monospace;
        overflow-wrap: break-word;
        /* Memastikan teks panjang tidak merusak tata letak */
        max-height: 2.5em;
        /* Membatasi tinggi agar tidak terlalu panjang */
        overflow: hidden;
        text-overflow: ellipsis;
        /* Menambahkan ellipsis jika terlalu panjang */
    }
</style>



<!-- MODAL EDIT PROFIL -->
<div class="modal fade" id="modalEditProfile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- HEADER MODAL -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-user-edit me-2"></i> Edit Profil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- FORM EDIT PROFIL -->
            <?php echo form_open('dashboard/profile', ['id' => 'formEditProfile']); ?>
            <!-- CSRF Token -->
            <input type="hidden"
                name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="modal-body p-4">
                <div class="row g-3">

                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="user_fullname"
                            class="form-control"
                            value="<?= htmlspecialchars($member->user_fullname) ?>"
                            required>
                    </div>

                    <!-- Username (readonly) -->
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control bg-light"
                            value="<?= htmlspecialchars($member->username) ?>" readonly>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($member->email) ?>"
                            required>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="user_phone"
                            class="form-control"
                            value="<?= htmlspecialchars($member->user_phone) ?>">
                    </div>



                </div>
            </div>

            <!-- FOOTER MODAL -->
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>




<script>
    $('#formEditProfile').submit(function(e) {
        e.preventDefault();

        $.ajax({
                url: '<?php echo site_url('postdata/user_post/user/updateprofile') ?>',
                type: 'post',
                dataType: 'json',
                data: $('#formEditProfile').serialize()
            })
            .done(function(data) {
                if (data.csrf_data) {
                    updateCSRF(data.csrf_data);
                }
                Swal.fire(
                    data.heading,
                    data.message,
                    data.type
                ).then(function() {
                    // if (data.status === 'success') {
                    location.reload();
                    // }
                });
            })
            .fail(function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
            });
    });
</script>


<!-- MODAL GANTI SANDI -->
<div class="modal fade" id="modalChangePassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- HEADER -->
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-lock me-2"></i> Ubah Kata Sandi
                </h5>
                <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>


            <?php echo form_open('', 'id="formChangePassword"'); ?>

            <div class="modal-body p-4">
                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label fw-semibold">Sandi Lama</label>
                        <input type="password"
                            name="old_password"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Sandi Baru</label>
                        <input type="password"
                            name="new_password"
                            class="form-control"
                            minlength="6"
                            required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Konfirmasi Sandi</label>
                        <input type="password"
                            name="confirm_password"
                            class="form-control"
                            required>
                    </div>

                </div>
            </div>

            <div class="modal-footer border-0">
                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit"
                    class="btn btn-danger px-4">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $('#btn020').hide();
    $('#formChangePassword').submit(function(event) {
        event.preventDefault();
        $('#btn010').hide();
        $('#btn020').show();
        $.ajax({
            url: '<?php echo site_url('postdata/user_post/user/updatepassword') ?>',
            type: 'POST',
            dataType: 'json',
            data: $('#formChangePassword').serialize(),
        }).done(function(data) {
            updateCSRF(data.csrf_data);
            Swal.fire(
                data.heading,
                data.message,
                data.type
            ).then(function() {
                if (data.status) {
                    location.reload();
                }
            });
            $('#btn010').show();
            $('#btn020').hide();
        })
    });
</script>