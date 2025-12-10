<?php
// Ambil kategori global
$kategori_keahlian = $this->db
    ->order_by('nama_kategori', 'ASC')
    ->get_where('tb_kategori', ['jenis_kategori' => 'keahlian'])
    ->result();

$kategori_tipe = $this->db
    ->order_by('nama_kategori', 'ASC')
    ->get_where('tb_kategori', ['jenis_kategori' => 'tipe_kerja'])
    ->result();

// Ambil data lowongan
$limit  = 15;
$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
$this->db->order_by('lowongan_date', 'DESC');
$getdata  = $this->db->get('tb_lowongan', $limit, $offset);
$Gettotal = $this->db->get('tb_lowongan')->num_rows();
$mitra = $this->db->get('tb_mitra')->num_rows();
?>
<style>
    :root {
        --primary: #0d6efd;
        --primary-dark: #0056b3;
        --secondary: #ffc107;
        --dark: #0f172a;
        --light: #f8fafc;
        --gray: #64748b;
        --gradient-blue: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-card: 0 10px 30px -5px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 20px 40px -5px rgba(13, 110, 253, 0.15);
        --transition-bounce: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--light);
        overflow-x: hidden;
        color: var(--dark);
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Outfit', sans-serif;
    }

    /* Custom Scrollbar for aesthetic */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }

    .hero-title {
        background: -webkit-linear-gradient(45deg, #0f172a, #334155);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -1px;
    }
</style>
<div class="page-bg-gradient pt-5 pb-5 mt-5">
    <div class="container pt-4 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1000">
                <div
                    class="d-inline-block px-3 py-1 mb-3 rounded-pill bg-white border shadow-sm">
                    <small class="fw-bold text-primary text-uppercase ls-1">🔥 Bursa Kerja Resmi</small>
                </div>
                <h1 class="display-4 fw-bold hero-title mb-3">
                    Explore Your Future.
                </h1>
                <p class="lead text-muted mb-0" style="font-weight: 400">
                    Akses 120+ lowongan eksklusif dari jaringan industri premium SMKN
                    1 Purwosari. Karir impian dimulai dengan satu klik.
                </p>
            </div>

            <div
                class="col-lg-5 text-lg-end d-none d-lg-block"
                data-aos="fade-left"
                data-aos-delay="200">
                <div class="d-inline-flex gap-3">
                    <div
                        class="bg-white p-4 rounded-4 shadow-sm text-center border"
                        style="min-width: 140px">
                        <h2 class="fw-bold text-dark mb-0 counter"><?= $Gettotal ?></h2>
                        <small class="text-muted text-uppercase fw-bold">Jobs</small>
                    </div>
                    <div
                        class="bg-primary p-4 rounded-4 shadow-lg text-center text-white"
                        style="min-width: 140px">
                        <h2 class="fw-bold mb-0"><?= $mitra ?></h2>
                        <small class="text-white-50 text-uppercase fw-bold">Partners</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-5">
            <div class="col-lg-3">
                <div
                    class="sidebar-glass sticky-top"
                    style="top: 100px; z-index: 10"
                    data-aos="fade-up">
                    <div
                        class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-filter me-2 text-primary"></i>Smart Filter
                        </h6>
                        <a
                            href="#"
                            class="small text-decoration-none text-danger fw-bold hover-underline">Reset</a>
                    </div>

                    <div class="mb-4 position-relative">
                        <i
                            class="fas fa-search position-absolute text-muted"
                            style="left: 16px; top: 14px"></i>
                        <input
                            type="text"
                            class="search-animated"
                            placeholder="Cari posisi..." />
                    </div>

                    <!-- ========================= -->
                    <!-- KATEGORI KEAHLIAN -->
                    <!-- ========================= -->
                    <div class="mb-4">
                        <small class="text-uppercase text-muted fw-bold ls-1 d-block mb-3">
                            Keahlian
                        </small>

                        <?php if (!empty($kategori_keahlian) && is_array($kategori_keahlian)): ?>
                            <?php foreach ($kategori_keahlian as $row): ?>
                                <?php if (!empty($row->id_kategori) && !empty($row->nama_kategori)): ?>
                                    <label class="check-item d-block mb-1">
                                        <input
                                            type="checkbox"
                                            class="filter-keahlian"
                                            name="keahlian[]"
                                            value="<?= htmlspecialchars($row->id_kategori) ?>"
                                            data-kategori-id="<?= htmlspecialchars($row->id_kategori) ?>" />
                                        <?= htmlspecialchars($row->nama_kategori) ?>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted small mb-0">Tidak ada data keahlian.</p>
                        <?php endif; ?>
                    </div>

                    <!-- ========================= -->
                    <!-- KATEGORI TIPE KERJA -->
                    <!-- ========================= -->
                    <div class="mb-4">
                        <small class="text-uppercase text-muted fw-bold ls-1 d-block mb-3">
                            Tipe Kerja
                        </small>

                        <?php if (!empty($kategori_tipe) && is_array($kategori_tipe)): ?>
                            <?php foreach ($kategori_tipe as $row): ?>
                                <?php if (!empty($row->id_kategori) && !empty($row->nama_kategori)): ?>
                                    <label class="check-item d-block mb-1">
                                        <input
                                            type="checkbox"
                                            class="filter-tipe"
                                            name="tipe[]"
                                            value="<?= htmlspecialchars($row->id_kategori) ?>"
                                            data-tipe-id="<?= htmlspecialchars($row->id_kategori) ?>" />
                                        <?= htmlspecialchars($row->nama_kategori) ?>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted small mb-0">Tidak ada data tipe kerja.</p>
                        <?php endif; ?>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const filterKeahlian = document.querySelectorAll('.filter-keahlian');
                            const filterTipe = document.querySelectorAll('.filter-tipe');
                            const jobCards = document.querySelectorAll('.job-card-premium');

                            function applyFilter() {
                                const selectedKeahlian = Array.from(filterKeahlian)
                                    .filter(cb => cb.checked)
                                    .map(cb => cb.dataset.kategoriId);

                                const selectedTipe = Array.from(filterTipe)
                                    .filter(cb => cb.checked)
                                    .map(cb => cb.dataset.tipeId);

                                jobCards.forEach(card => {
                                    const kategoriId = card.dataset.kategoriId;
                                    const tipeId = card.dataset.tipeId;

                                    let showKeahlian = selectedKeahlian.length === 0 || selectedKeahlian.includes(kategoriId);
                                    let showTipe = selectedTipe.length === 0 || selectedTipe.includes(tipeId);

                                    if (showKeahlian && showTipe) {
                                        card.style.display = '';
                                        card.classList.add('fadeIn');
                                    } else {
                                        card.style.display = 'none';
                                    }
                                });
                            }

                            filterKeahlian.forEach(checkbox => {
                                checkbox.addEventListener('change', applyFilter);
                            });

                            filterTipe.forEach(checkbox => {
                                checkbox.addEventListener('change', applyFilter);
                            });
                        });
                    </script>

                    <style>
                        @keyframes fadeIn {
                            from {
                                opacity: 0;
                            }

                            to {
                                opacity: 1;
                            }
                        }

                        .fadeIn {
                            animation: fadeIn 0.3s ease-in;
                        }
                    </style>


                </div>
            </div>

            <div class="col-lg-9">
                <div
                    class="d-flex justify-content-between align-items-center mb-4 ps-2"
                    data-aos="fade-in">
                    <p class="mb-0 text-muted small">
                        Showing <b class="text-dark"><?= $getdata->num_rows() ?></b> of <b><?= $Gettotal ?></b> jobs
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-muted fw-bold">Bursa Kerja Khusus SMK Negri 1 Purwosari </span>

                    </div>
                </div>

                <div class="d-flex flex-column gap-3">
                    <?php if ($getdata->num_rows() > 0): ?>
                        <?php foreach ($getdata->result() as $job): ?>
                            <div
                                class="job-card-premium"
                                data-aos="fade-up"
                                data-aos-duration="800"
                                data-kategori-id="<?= htmlspecialchars($job->kategori_id) ?>"
                                data-tipe-id="<?= htmlspecialchars($job->kategori_tipe) ?>">
                                <div
                                    class="d-flex gap-4 align-items-start align-items-md-center flex-grow-1">
                                    <div class="position-relative" style="min-width: 80px;">
                                        <?php if (!empty($job->lowongan_img)): ?>
                                            <img
                                                src="<?= base_url('assets/lowongan/' . $job->lowongan_img) ?>"
                                                alt="<?= htmlspecialchars($job->lowongan_judul) ?>"
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                        <?php else: ?>
                                            <div style="width: 80px; height: 80px; background-color: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-briefcase text-muted" style="font-size: 24px;"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1">
                                            <?= htmlspecialchars($job->lowongan_judul) ?>
                                        </h5>
                                        <div
                                            class="d-flex align-items-center gap-3 text-muted small mb-3">
                                            <span><i class="fas fa-building me-1"></i> <?= htmlspecialchars($job->lowongan_perusahaan) ?></span>
                                            <span><i class="fas fa-map-marker-alt me-1"></i>
                                                <?= htmlspecialchars($job->lowongan_alamat) ?></span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <span class="tag-soft bg-dark-soft"><?= date('d M Y', strtotime($job->lowongan_start)) ?></span>
                                            <span class="tag-soft bg-green-soft">View Details</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 mt-md-0 d-flex flex-column align-items-md-end ps-md-4 border-start-md">
                                    <span class="small text-muted fw-bold mb-2"><?= date('d M Y', strtotime($job->lowongan_start)) ?>
                                        &nbsp;–&nbsp;
                                        <?= date('d M Y', strtotime($job->lowongan_end)) ?>
                                    </span>
                                    <a href="<?= site_url('detail-lowongan/' . $job->lowongan_code) ?>" class="btn-morph">View Details</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            <p class="mb-0">Tidak ada lowongan ditemukan.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="text-center mt-5 pt-3" data-aos="fade-up">
                    <button
                        class="btn btn-outline-dark rounded-pill px-5 py-3 fw-bold"
                        style="transition: 0.3s">
                        Show More Jobs
                        <i class="fas fa-spinner fa-spin ms-2 d-none"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>