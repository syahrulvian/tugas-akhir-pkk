<?php
// ==========================================================
// 1. BLOK PHP LOGIKA (TIDAK BERUBAH DARI ASLINYA)
// ==========================================================
$limit = 9;
$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
$no = $offset + 1;

$this->db->order_by('gallery_created_at', 'DESC');
$get_gallery = $this->db->get('tb_gallery', $limit, $offset);
$gettotals = $this->db->get('tb_gallery')->num_rows();

// Metadata disesuaikan sedikit agar relevan dengan tampilan BKK, 
// tapi variabel tetap menggunakan method template Anda.
$this->template->title->set('Galeri Kegiatan | BKK SMKN 1 Purwosari');
$this->template->description->set('Dokumentasi kegiatan, kunjungan industri, dan portofolio siswa BKK SMKN 1 Purwosari.');
$this->template->keywords->set('Galeri, BKK, SMKN 1 Purwosari, Dokumentasi, Foto');
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    /* CORE VARIABLES */
    :root {
        --primary: #0d6efd;
        --primary-dark: #0056b3;
        --secondary: #ffc107;
        --dark: #0f172a;
        --light: #f8fafc;
        --gray: #64748b;
        --gradient-blue: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        --shadow-card: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 20px 40px -5px rgba(13, 110, 253, 0.15);
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    html, body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: var(--light);
        color: var(--dark);
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: "Outfit", sans-serif;
    }

    /* HERO SECTION (Sama dengan Home) */
    .hero-masterpiece {
        padding: 140px 0 80px;
        background: var(--dark);
        position: relative;
        color: white;
        overflow: hidden;
    }

    .hero-bg-mesh {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(at 0% 0%, rgba(13, 110, 253, 0.15) 0px, transparent 50%), 
                          radial-gradient(at 100% 100%, rgba(255, 193, 7, 0.1) 0px, transparent 50%);
        z-index: 0;
        animation: breatheBg 10s ease-in-out infinite alternate;
    }

    @keyframes breatheBg {
        0% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    .shape-float {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        animation: floatShape 20s infinite linear;
    }

    .sf-1 { width: 300px; height: 300px; background: var(--primary); top: -50px; left: -50px; }
    .sf-2 { width: 200px; height: 200px; background: var(--secondary); bottom: 10%; right: -50px; animation-direction: reverse; }

    @keyframes floatShape {
        0% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(50px, 50px) rotate(180deg); }
        100% { transform: translate(0, 0) rotate(360deg); }
    }

    .hero-content { position: relative; z-index: 2; text-align: center; }

    .badge-hero-animated {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 8px 20px; border-radius: 50px;
        backdrop-filter: blur(10px);
        font-size: 0.85rem; font-weight: 700; color: var(--secondary);
        margin-bottom: 1.5rem;
    }

    .hero-title-main {
        font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem;
        background: linear-gradient(to right, #ffffff, #94a3b8);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    
    .hero-desc { color: #cbd5e1; max-width: 700px; margin: 0 auto; font-size: 1.1rem; }

    /* GALLERY CARD PRO (Adaptasi Style Baru) */
    .gallery-section { padding: 80px 0; background: var(--light); position: relative; }

    .gallery-card-pro {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        overflow: hidden;
        height: 100%;
        transition: var(--transition-smooth);
        box-shadow: var(--shadow-card);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .gallery-card-pro:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .gc-img-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 16/10;
        background: #e2e8f0;
    }

    .gc-img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.6s ease;
    }

    .gallery-card-pro:hover .gc-img { transform: scale(1.08); }

    .gc-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.6), transparent);
        opacity: 0.6;
    }

    .gc-date-badge {
        position: absolute; top: 15px; left: 15px;
        background: rgba(255, 255, 255, 0.95);
        padding: 6px 14px; border-radius: 30px;
        font-size: 0.75rem; font-weight: 700; color: var(--dark);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        z-index: 2;
    }

    .gc-content { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }

    .gc-title {
        font-size: 1.25rem; font-weight: 700; margin-bottom: 10px;
        color: var(--dark); line-height: 1.4;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }

    .gc-desc {
        color: var(--gray); font-size: 0.95rem; margin-bottom: 20px; flex-grow: 1;
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }

    .btn-gallery-link {
        color: var(--primary); font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 8px;
        transition: 0.3s; margin-top: auto;
    }

    .btn-gallery-link:hover { gap: 12px; color: var(--primary-dark); }

    /* PAGINATION STYLING */
    .pagination-wrapper ul {
        display: flex; justify-content: center; gap: 8px; padding: 0; list-style: none;
    }
    
    .pagination-wrapper ul li a, .pagination-wrapper ul li span {
        width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
        border-radius: 50%; background: white; color: var(--dark);
        border: 1px solid #e2e8f0; font-weight: 600; text-decoration: none;
        transition: 0.3s;
    }

    .pagination-wrapper ul li.active a, .pagination-wrapper ul li.active span {
        background: var(--primary); color: white; border-color: var(--primary);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
    
    .pagination-wrapper ul li a:hover:not(.active) {
        background: #f1f5f9; border-color: #cbd5e1;
    }

    /* BREADCRUMB CUSTOM */
    .custom-breadcrumb {
        background: white; border-bottom: 1px solid #e2e8f0; padding: 15px 0;
    }
    .breadcrumb-item a { color: var(--gray); text-decoration: none; font-size: 0.9rem; font-weight: 500; }
    .breadcrumb-item.active { color: var(--primary); font-weight: 700; font-size: 0.9rem; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; color: #cbd5e1; }

    @media(max-width:768px) {
        .hero-title-main { font-size: 2.2rem; }
        .hero-masterpiece { padding-top: 100px; }
    }
</style>

<section class="hero-masterpiece">
    <div class="hero-bg-mesh"></div>
    <div class="shape-float sf-1"></div>
    <div class="shape-float sf-2"></div>
    
    <div class="container hero-content">
        <div data-aos="fade-up">
            <div class="badge-hero-animated">
                <i class="bi bi-images"></i> DOKUMENTASI KEGIATAN
            </div>
            <h1 class="hero-title-main">Galeri & Aktivitas BKK</h1>
            <p class="hero-desc">
                Kumpulan dokumentasi kegiatan rekrutmen, pelatihan, kunjungan industri, 
                dan momen berharga siswa bersama mitra industri.
            </p>
        </div>
    </div>
</section>



<div class="gallery-section">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--dark);">Koleksi Terbaru</h2>
                <div style="width: 50px; height: 4px; background: var(--secondary); border-radius: 2px;"></div>
            </div>
            <div class="text-muted fst-italic d-none d-md-block">
                Menampilkan hal <?= $offset+1 ?> - <?= min($offset+$limit, $gettotals) ?> dari <?= $gettotals ?> kegiatan
            </div>
        </div>

        <div class="row g-4">
            <?php
            if ($get_gallery->num_rows() > 0) {
                foreach ($get_gallery->result() as $row) {
                    // Logika Ambil Gambar (Sama seperti kode asli)
                    $arr_img = json_decode($row->gallery_image, true) ?? [];
                    $first_img = is_array($arr_img) && count($arr_img) > 0 ? $arr_img[0] : 'default.png';
                    
                    // Bersihkan deskripsi
                    $description_snippet = substr(strip_tags($row->gallery_description), 0, 100) . '...';
                    $gallery_date = date('d M Y', strtotime($row->gallery_created_at));
            ?>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <article class="gallery-card-pro">
                    <div class="gc-img-wrapper">
                        <span class="gc-date-badge">
                            <i class="bi bi-calendar3 me-1"></i> <?= $gallery_date ?>
                        </span>
                        <img src="<?= base_url('assets/gallery/' . $first_img) ?>" 
                             alt="<?= htmlspecialchars($row->gallery_title) ?>" 
                             class="gc-img">
                        <div class="gc-overlay"></div>
                    </div>
                    
                    <div class="gc-content">
                        <h3 class="gc-title">
                            <a href="<?= site_url('galeri-detail?code=' . $row->gallery_code) ?>" class="text-decoration-none text-reset">
                                <?= htmlspecialchars($row->gallery_title) ?>
                            </a>
                        </h3>
                        <p class="gc-desc"><?= $description_snippet ?></p>
                        
                        <a href="<?= site_url('galeri-detail?code=' . $row->gallery_code) ?>" class="btn-gallery-link">
                            Lihat Album Lengkap <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>

            <?php
                }
            } else {
                // Tampilan JIKA KOSONG (Empty State Modern)
            ?>
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm border">
                        <i class="bi bi-camera-reels text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h3 class="mt-3 fw-bold text-muted">Belum ada galeri</h3>
                        <p class="text-muted">Dokumentasi kegiatan belum diunggah.</p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="pagination-wrapper">
                    <?php echo $this->paginationmodel->paginate('gallery', $gettotals, $limit) ?>
                </div>
            </div>
        </div>
    </div>
</div>