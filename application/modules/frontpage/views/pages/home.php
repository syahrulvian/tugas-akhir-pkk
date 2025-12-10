<style>
    /* =================================================================
           1. CORE VARIABLES & ADVANCED RESET
           ================================================================= */
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

    /* PERBAIKAN RESPONSIVE: Mencegah layar geser ke kanan/putih */
    html,
    body {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        /* Memotong elemen yang bablas ke samping */
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: var(--light);
        color: var(--dark);
        position: relative;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Outfit", sans-serif;
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

    /* =================================================================
           2. HERO SECTION (PARALLAX & PARTICLES)
           ================================================================= */
    .hero-masterpiece {
        padding: 140px 0 100px;
        background: var(--dark);
        position: relative;
        color: white;
        overflow: hidden;
    }

    /* Animated Mesh Gradient Background */
    .hero-bg-mesh {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(at 0% 0%,
                rgba(13, 110, 253, 0.15) 0px,
                transparent 50%),
            radial-gradient(at 100% 100%,
                rgba(255, 193, 7, 0.1) 0px,
                transparent 50%);
        z-index: 0;
        animation: breatheBg 10s ease-in-out infinite alternate;
    }

    @keyframes breatheBg {
        0% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }

    /* Floating Shapes */
    .shape-float {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        animation: floatShape 20s infinite linear;
    }

    .sf-1 {
        width: 300px;
        height: 300px;
        background: var(--primary);
        top: -50px;
        left: -50px;
    }

    .sf-2 {
        width: 200px;
        height: 200px;
        background: var(--secondary);
        bottom: 10%;
        right: -50px;
        animation-direction: reverse;
    }

    @keyframes floatShape {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }

        50% {
            transform: translate(50px, 50px) rotate(180deg);
        }

        100% {
            transform: translate(0, 0) rotate(360deg);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .badge-hero-animated {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 1.5rem;
        animation: slideDown 1s ease forwards;
    }

    .hero-title-main {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(to right, #ffffff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Typing Effect Cursor */
    .typing-cursor::after {
        content: "|";
        animation: blink 1s infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }
    }

    .btn-master-primary {
        background: var(--primary);
        color: white;
        padding: 16px 40px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        box-shadow: 0 0 20px rgba(13, 110, 253, 0.4);
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-master-primary:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 40px rgba(13, 110, 253, 0.6);
        background: white;
        color: var(--primary);
    }

    /* =================================================================
           3. STATS COUNTER BAR (FLOATING GLASS)
           ================================================================= */
    .stats-wrapper {
        margin-top: -80px;
        position: relative;
        z-index: 10;
        padding: 0 20px;
    }

    .stats-card-glass {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.5);
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .stat-item {
        text-align: center;
        position: relative;
    }

    .stat-item:not(:last-child)::after {
        content: "";
        position: absolute;
        right: 0;
        top: 10%;
        height: 80%;
        width: 1px;
        background: #e2e8f0;
    }

    .stat-num {
        font-size: 3rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1;
        display: block;
    }

    .stat-label {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* =================================================================
           4. DUAL MARQUEE SLIDER (KIRI & KANAN)
           ================================================================= */
    .marquee-section-pro {
        padding: 6rem 0;
        background: white;
        overflow: hidden;
    }

    .marquee-track-pro {
        display: flex;
        gap: 4rem;
        width: max-content;
        margin-bottom: 2rem;
    }

    .marquee-left {
        animation: scrollLeft 40s linear infinite;
    }

    .marquee-right {
        animation: scrollRight 40s linear infinite;
    }

    .logo-box-pro {
        font-size: 1.5rem;
        font-weight: 800;
        color: #cbd5e1;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        transition: 0.3s;
    }

    .logo-box-pro:hover {
        color: var(--dark);
        border-color: var(--dark);
        background: #f8fafc;
        transform: scale(1.05);
    }

    .logo-box-pro i {
        font-size: 2rem;
    }

    @keyframes scrollLeft {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    @keyframes scrollRight {
        0% {
            transform: translateX(-50%);
        }

        100% {
            transform: translateX(0);
        }
    }

    /* =================================================================
           5. PARTNERS GRID WITH FILTERS
           ================================================================= */
    .partners-grid-section {
        padding: 6rem 0;
        background: #f8fafc;
    }

    /* Filter Tabs */
    .filter-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 3rem;
        flex-wrap: wrap;
    }

    .btn-filter-pro {
        background: white;
        border: 1px solid #e2e8f0;
        color: var(--gray);
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-filter-pro:hover,
    .btn-filter-pro.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    /* Card Design - Menggunakan Style dari mitra.php */
    .partner-card-pro {
        background: #ffffff;
        border-radius: 20px;
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    /* Area Atas: Logo/Icon */
    .partner-card-pro .card-top {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    /* Area Bawah: Info */
    .partner-card-pro .card-bottom {
        background: #f8fafc;
        padding: 15px 10px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        z-index: 2;
        transition: 0.3s;
        min-height: 100px;
    }

    .p-icon {
        max-width: 100px;
        max-height: 100px;
        object-fit: contain;
        filter: none !important;
        opacity: 1 !important;
        transition: transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .partner-card-pro h5 {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 15px;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }

    .partner-card-pro small {
        font-size: 11px !important;
        text-transform: uppercase;
        letter-spacing: 0.5px !important;
        color: #64748b !important;
        font-weight: 600 !important;
        margin-top: 4px !important;
        display: block !important;
    }

    /* Hover Effects */
    .partner-card-pro:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.15);
        border-color: #3b82f6;
    }

    .partner-card-pro:hover .p-icon {
        transform: scale(1.15);
    }

    .partner-card-pro:hover .card-bottom {
        background: #0f172a;
        border-top-color: #0f172a;
    }

    .partner-card-pro:hover h5 {
        color: #fff;
    }

    .partner-card-pro:hover small {
        color: #94a3b8 !important;
    }

    /* =================================================================
           6. WORKFLOW TIMELINE (DIAGRAM ALUR)
           ================================================================= */
    .workflow-section {
        padding: 6rem 0;
        background: white;
    }

    .timeline-box {
        position: relative;
        margin-top: 3rem;
    }

    /* Garis Tengah */
    .timeline-line {
        position: absolute;
        top: 50px;
        left: 0;
        width: 100%;
        height: 4px;
        background: #e2e8f0;
        z-index: 0;
    }

    .timeline-step {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 0 15px;
    }

    .step-circle {
        width: 100px;
        height: 100px;
        background: white;
        border: 4px solid #f1f5f9;
        border-radius: 50%;
        margin: 0 auto 1.5rem auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary);
        transition: 0.4s;
        box-shadow: var(--shadow-sm);
    }

    .timeline-step:hover .step-circle {
        background: var(--primary);
        color: white;
        border-color: var(--secondary);
        transform: scale(1.1) rotate(10deg);
        box-shadow: var(--shadow-lg);
    }

    /* =================================================================
           7. KEUNTUNGAN (FEATURE GRID)
           ================================================================= */
    .benefit-section {
        padding: 6rem 0;
        background: #f1f5f9;
    }

    .benefit-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        display: flex;
        gap: 20px;
        align-items: start;
        transition: 0.3s;
        border-left: 5px solid var(--secondary);
    }

    .benefit-card:hover {
        transform: translateX(10px);
        box-shadow: var(--shadow-md);
    }

    .b-icon {
        font-size: 2.5rem;
        color: var(--secondary);
    }

    /* =================================================================
           8. FAQ & CTA
           ================================================================= */
    .faq-section {
        padding: 6rem 0;
        background: white;
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(13, 110, 253, 0.05);
        color: var(--primary);
        font-weight: 700;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.1);
    }

    .cta-ultimate {
        background: var(--gradient-blue);
        border-radius: 30px;
        padding: 5rem 3rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: -50px;
        z-index: 5;
        box-shadow: var(--shadow-xl);
    }

    .cta-pattern-dots {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.2) 2px,
                transparent 2px);
        background-size: 20px 20px;
    }

    /* RESPONSIVE */
    @media (max-width: 991px) {
        .hero-title-main {
            font-size: 2.8rem;
        }

        .stats-glass-box {
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .timeline-line {
            display: none;
        }

        .timeline-step {
            margin-bottom: 3rem;
        }
    }

    /* PERBAIKAN RESPONSIVE STATISTIK (HP) */
    @media (max-width: 768px) {
        .hero-masterpiece {
            padding-top: 100px;
        }

        /* DISINI PERBAIKANNYA: Menggunakan nama class yang benar (.stats-card-glass) */
        .stats-card-glass {
            grid-template-columns: 1fr;
            /* Memaksa angka berbaris ke bawah (1 kolom) */
            padding: 1.5rem;
            /* Mengurangi padding agar muat di HP */
        }

        /* Menghapus garis pembatas vertikal desktop */
        .stat-item:not(:last-child)::after {
            display: none;
        }

        /* Menambah garis pembatas horizontal antar angka */
        .stat-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Menghapus garis untuk item terakhir */
        .stat-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .mitra-card-fix {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            position: relative;
            border: 1px solid #e5e7eb;
            transition: .3s;
        }

        .mitra-card-fix:hover {
            transform: translateY(-5px);
        }

        .fix-card-top {
            width: 100%;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-fix {
            width: 100%;
            height: 100%;
            max-width: 120px;
            max-height: 120px;
            object-fit: contain;
            display: block;
        }

        .stats-card-glass {
            grid-template-columns: 1fr;
            /* mobile */
        }

        .stat-item:not(:last-child)::after {
            display: none;
            /* hilangkan garis vertikal */
        }

        .stats-card-glass {
            grid-template-columns: 1fr;
        }

        .stat-item {
            display: block;
            /* pastikan terlihat */
        }


    }
</style>
<section class="hero-masterpiece">
    <div class="hero-bg-mesh"></div>
    <div class="shape-float sf-1"></div>
    <div class="shape-float sf-2"></div>

    <div class="container hero-content">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10" data-aos="zoom-in" data-aos-duration="1200">
                <div class="badge-hero-animated">
                    <i class="fas fa-handshake"></i> STRATEGIC PARTNERSHIP
                </div>
                <h1 class="hero-title-main">
                    Membangun Ekosistem<br />
                    <span id="typing-text" class="text-warning typing-cursor"></span>
                </h1>
                <p class="hero-desc">
                    BKK SMKN 1 Purwosari berkolaborasi dengan lebih dari 150
                    perusahaan multinasional untuk menjamin keterserapan lulusan yang
                    kompeten, profesional, dan siap kerja.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="#partner-grid" class="btn-master-primary">
                        Eksplorasi Mitra <i class="fas fa-arrow-down"></i>
                    </a>
                    <button class="btn btn-outline-light rounded-pill px-4 fw-bold" data-bs-toggle="modal"
                        data-bs-target="#videoModal">
                        <i class="fas fa-play-circle me-2"></i> Tonton Profil
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$mitra = $this->db->get('tb_mitra')->num_rows();
$lowongan = $this->db->get('tb_lowongan')->num_rows();
$alumni = $this->db->get('tb_users', ['user_status' => 'member'])->num_rows();
$testimoni = $this->db->get('tb_testimoni')->num_rows();
?>

<div class="container stats-wrapper" data-aos="fade-up">
    <div class="stats-card-glass">
        <div class="stat-item">
            <h2 class="stat-num counter" data-target="<?= $mitra ?>"><?= $mitra ?></h2>
            <span class="stat-label">Mitra Industri</span>
        </div>
        <div class="stat-item">
            <h2 class="stat-num counter" data-target="<?= $lowongan ?>"><?= $lowongan ?></h2>
            <span class="stat-label">Lowongan Pekerjaan</span>
        </div>
        <div class="stat-item">
            <h2 class="stat-num counter" data-target="<?= $alumni ?>"><?= $alumni ?></h2>
            <span class="stat-label">Siswa / Alumni</span>
        </div>
        <div class="stat-item">
            <h2 class="stat-num counter" data-target="<?= $testimoni ?>"><?= $testimoni ?></h2>
            <span class="stat-label">Survey</span>
        </div>
    </div>
</div>


<div class="marquee-section-pro">
    <div class="container-fluid p-0">
        <p class="text-center text-uppercase fw-bold text-muted small letter-spacing-2 mb-4">
            Dipercaya Oleh Industri Global
        </p>

        <div class="marquee-track-pro marquee-left">
            <div class="logo-box-pro"><i class="fab fa-aws"></i> ASTRA GROUP</div>
            <div class="logo-box-pro"><i class="fas fa-car"></i> TOYOTA MFG</div>
            <div class="logo-box-pro">
                <i class="fas fa-motorcycle"></i> HONDA
            </div>
            <div class="logo-box-pro">
                <i class="fas fa-print"></i> EPSON
            </div>
            <div class="logo-box-pro">
                <i class="fab fa-google"></i> GOOGLE
            </div>
            <div class="logo-box-pro">
                <i class="fas fa-utensils"></i> INDOFOOD
            </div>
            <div class="logo-box-pro">
                <i class="fab fa-microsoft"></i> MICROSOFT
            </div>
            <div class="logo-box-pro">
                <i class="fas fa-bolt"></i> PLN PERSERO
            </div>

            <div class="logo-box-pro"><i class="fas fa-car"></i> TOYOTA MFG</div>
            <div class="logo-box-pro">
                <i class="fas fa-motorcycle"></i> HONDA
            </div>
            <div class="logo-box-pro">
                <i class="fas fa-print"></i> EPSON INDO
            </div>
        </div>

        <div class="marquee-track-pro marquee-right mt-4">

            <div class="logo-box-pro">
                <i class="fas fa-gas-pump"></i> PERTAMINA
            </div>


            <div class="logo-box-pro">
                <i class="fas fa-shipping-fast"></i> JNE EXPRESS
            </div>
            <div class="logo-box-pro">
                <i class="fas fa-mobile-alt"></i> TELKOMSEL
            </div>

            <div class="logo-box-pro">
                <i class="fas fa-gas-pump"></i> PERTAMINA
            </div>
            <div class="logo-box-pro">
                <i class="fas fa-warehouse"></i> GUDANG GARAM
            </div>

        </div>
    </div>
</div>

<?php
// Ambil data mitra dari database
$this->db->select('tb_mitra.*, tb_kategori_mitra.kategori_mitra_nama, tb_kategori_mitra.kategori_mitra_id');
$this->db->from('tb_mitra');
$this->db->join('tb_kategori_mitra', 'tb_kategori_mitra.kategori_mitra_id = tb_mitra.kategori_mitra_id', 'left');
$this->db->order_by('tb_mitra.created_at', 'DESC');
$mitra_data = $this->db->get()->result();

// Ambil data kategori untuk filter
$this->db->order_by('kategori_mitra_nama', 'ASC');
$kategori_data = $this->db->get('tb_kategori_mitra')->result();
?>

<section class="partners-grid-section" id="partner-grid">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-down">
            <span class="text-primary fw-bold text-uppercase">KATEGORI INDUSTRI</span>
            <h2 class="display-5 fw-bold mt-2"> Mitra Perusahaan</h2>
        </div>

        <div class="filter-container" data-aos="fade-up">
            <button class="btn-filter-pro active" onclick="filterSelection('all')">Semua</button>
            <?php if (!empty($kategori_data)): ?>
                <?php foreach ($kategori_data as $kat): ?>
                    <button class="btn-filter-pro" onclick="filterSelection('cat-<?= $kat->kategori_mitra_id ?>')">
                        <?= htmlspecialchars($kat->kategori_mitra_nama) ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="row g-4">
            <?php if (!empty($mitra_data)): ?>
                <?php foreach ($mitra_data as $row):
                    $logo_url = !empty($row->mitra_logo) ? base_url('assets/mitra/' . $row->mitra_logo) : base_url('assets/mitra/default.png');
                    $filter_class = 'cat-' . ($row->kategori_mitra_id ?? '0');
                ?>
                    <div class="col-lg-3 col-md-6 filter-item all <?= $filter_class ?>" data-aos="fade-up">
                        <div class="partner-card-pro">
                            <div class="card-top">
                                <img src="<?= $logo_url ?>" class="p-icon" alt="<?= htmlspecialchars($row->mitra_nama) ?>" />
                            </div>
                            <div class="card-bottom">
                                <h5><?= htmlspecialchars($row->mitra_nama) ?></h5>

                                <span class="badge bg-primary bg-opacity-10 text-primary"
                                    style="margin-top: 8px;"><?= htmlspecialchars($row->kategori_mitra_nama) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5 text-muted">Belum ada data mitra.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="workflow-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-dark">Alur Kerjasama Industri</h2>
            <p class="text-muted">
                Langkah mudah menjadi mitra BKK SMKN 1 Purwosari.
            </p>
        </div>

        <div class="timeline-box">
            <div class="timeline-line"></div>
            <div class="row">
                <div class="col-lg-3 col-6 timeline-step" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-circle">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <h5 class="fw-bold">Pengajuan</h5>
                    <p class="small text-muted">
                        Perusahaan mengajukan surat permohonan kerjasama.
                    </p>
                </div>
                <div class="col-lg-3 col-6 timeline-step" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-circle"><i class="fas fa-search-plus"></i></div>
                    <h5 class="fw-bold">Verifikasi</h5>
                    <p class="small text-muted">
                        Tim BKK melakukan validasi profil industri.
                    </p>
                </div>
                <div class="col-lg-3 col-6 timeline-step" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-circle"><i class="fas fa-handshake"></i></div>
                    <h5 class="fw-bold">MOU</h5>
                    <p class="small text-muted">
                        Penandatanganan Nota Kesepahaman resmi.
                    </p>
                </div>
                <div class="col-lg-3 col-6 timeline-step" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-circle"><i class="fas fa-user-check"></i></div>
                    <h5 class="fw-bold">Rekrutmen</h5>
                    <p class="small text-muted">
                        Pelaksanaan seleksi dan penyaluran tenaga kerja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="benefit-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4" data-aos="fade-right">
                <h2 class="display-6 fw-bold mb-3">Keuntungan Bermitra</h2>
                <p class="text-muted fs-5">
                    Dapatkan akses eksklusif ke ribuan talenta muda kompeten dengan
                    berbagai keunggulan fasilitas.
                </p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-3 d-flex align-items-center gap-3">
                        <i class="fas fa-check-circle text-primary"></i> Database Ribuan
                        Alumni
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-3">
                        <i class="fas fa-check-circle text-primary"></i> Tempat Tes
                        Gratis
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-3">
                        <i class="fas fa-check-circle text-primary"></i> Kurikulum Link
                        & Match
                    </li>
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="benefit-card">
                            <i class="fas fa-users-cog b-icon"></i>
                            <div>
                                <h6 class="fw-bold">SDM Kompeten</h6>
                                <p class="small text-muted mb-0">
                                    Lulusan siap kerja dengan skill teruji.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="benefit-card">
                            <i class="fas fa-clock b-icon"></i>
                            <div>
                                <h6 class="fw-bold">Efisiensi Waktu</h6>
                                <p class="small text-muted mb-0">
                                    Proses seleksi terpusat dan cepat.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="benefit-card">
                            <i class="fas fa-chalkboard-teacher b-icon"></i>
                            <div>
                                <h6 class="fw-bold">Guru Tamu</h6>
                                <p class="small text-muted mb-0">
                                    Kesempatan berbagi ilmu industri.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="benefit-card">
                            <i class="fas fa-award b-icon"></i>
                            <div>
                                <h6 class="fw-bold">Branding</h6>
                                <p class="small text-muted mb-0">
                                    Tingkatkan citra positif perusahaan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Pertanyaan Umum (FAQ)</h2>
                    <p class="text-muted">Seputar kerjasama industri.</p>
                </div>

                <div class="accordion" id="accordionFAQ">
                    <?php
                    // Inisialisasi counter untuk animasi/logika
                    $i = 1;
                    // Ambil data FAQ dari database
                    $this->db->order_by('faq_id', 'desc');
                    $getFAQ = $this->db->get('tb_faq');

                    // Cek apakah ada data yang ditemukan
                    if ($getFAQ->num_rows() > 0) {
                        foreach ($getFAQ->result() as $faq):
                            // Logika untuk item pertama terbuka default
                            $is_collapsed = ($i > 1) ? 'collapsed' : '';
                            $is_show = ($i == 1) ? 'show' : '';
                    ?>

                            <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                                <h2 class="accordion-header" id="heading<?= $faq->faq_id ?>">
                                    <button class="accordion-button <?= $is_collapsed ?> fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse<?= $faq->faq_id ?>"
                                        aria-expanded="<?= ($i == 1) ? 'true' : 'false' ?>"
                                        aria-controls="collapse<?= $faq->faq_id ?>">
                                        <?= $faq->faq_quest ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $faq->faq_id ?>" class="accordion-collapse collapse <?= $is_show ?>"
                                    aria-labelledby="heading<?= $faq->faq_id ?>" data-bs-parent="#accordionFAQ">
                                    <div class="accordion-body text-muted">
                                        <?= $faq->faq_answ ?>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $i++; // Tingkatkan counter
                        endforeach;
                    } else {
                        // Tampilkan pesan jika tidak ada data FAQ (Dari kode ke-1)
                        ?>
                        <div class="faq-empty-state text-center py-5">
                            <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                            <h4 class="text-muted">Data FAQ Belum Tersedia</h4>
                            <p class="text-muted">Maaf, belum ada Pertanyaan Umum (FAQ) yang tersedia saat ini.</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container pb-5" data-aos="fade-up">
    <div class="cta-ultimate">
        <div class="cta-pattern-dots"></div>
        <div class="position-relative z-2">
            <h2 class="fw-bold mb-3 display-6">Siap Berkolaborasi?</h2>
            <p class="fs-5 mb-4 opacity-75 col-lg-8 mx-auto">
                Bergabunglah dengan ekosistem vokasi terbaik di Jawa Timur.
            </p>
            <a href="<?= site_url('kontak') ?>" class="btn btn-warning rounded-pill px-5 py-3 fw-bold shadow-lg">
                Hubungi Kami <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
<br /><br />