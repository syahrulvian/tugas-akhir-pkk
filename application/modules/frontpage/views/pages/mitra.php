<?php
// --- 1. AMBIL DATA MITRA (Sama seperti sebelumnya) ---
$this->db->select('tb_mitra.*, tb_kategori_mitra.kategori_mitra_nama, tb_kategori_mitra.kategori_mitra_id');
$this->db->from('tb_mitra');
$this->db->join('tb_kategori_mitra', 'tb_kategori_mitra.kategori_mitra_id = tb_mitra.kategori_mitra_id', 'left');
$this->db->order_by('tb_mitra.created_at', 'DESC');
$mitra_data = $this->db->get()->result();

// --- 2. AMBIL DATA KATEGORI (Baru) ---
$this->db->order_by('kategori_mitra_nama', 'ASC');
$kategori_data = $this->db->get('tb_kategori_mitra')->result();
?>

<style>
    /* ... Style CSS tetap sama, tidak saya ubah ... */
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

    /* 1. BACKGROUND (KEMBALI KE VERSI SEBELUMNYA YANG BAGUS) */
    .mitra-section-fix {
        background: #f8fafc;
        /* biarkan background-image dll tetap ada */
        position: relative;
        overflow: hidden;

        /* --- TAMBAHKAN INI AGAR TIDAK TERPOTONG --- */
        min-height: 85vh;
        /* Memaksa tinggi minimal 85% layar */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* 2. NAVIGASI DESKTOP (DOCK HITAM SMOOTH) */
    /* Styling Tombol Individu (Mati) - Putih */
    .nav-pills .nav-link.custom-dock-item {
        background-color: #ffffff !important;
        color: #64748b !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 50px !important;
        padding: 10px 25px;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    /* =========================================
   COPY SEMUA CODE DI BAWAH INI
   GANTIKAN CSS LAMA BAGIAN NAVIGASI
   ========================================= */

    /* 1. HILANGKAN BACKGROUND HITAM (KAPSUL) */
    /* Kita paksa background wrapper jadi transparan */
    .nav-dock-fix {
        background: transparent !important;
        padding: 10px 0 !important;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
        display: block !important;
        /* Biar tidak inline-flex yang bikin sempit */
    }

    /* 2. STYLE TOMBOL AWAL (BELUM DIKLIK) */
    .nav-pills .nav-link.custom-dock-item {
        background-color: #ffffff !important;
        /* Warna Putih */
        color: #64748b !important;
        /* Teks Abu-abu */
        border: 1px solid #e2e8f0 !important;
        /* Garis tipis pinggir */
        border-radius: 50px !important;
        /* Bulat Penuh */
        padding: 12px 30px;
        /* Ukuran tombol */
        font-weight: 600;
        font-size: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
        /* Bayangan halus */
        transition: all 0.3s ease;
        margin: 0 6px;
        /* Jarak antar tombol */
        position: relative;
        /* WAJIB ADA: Agar garis oranye bisa menempel */
    }

    /* Hilangkan garis oranye saat tombol BELUM aktif */
    .nav-pills .nav-link.custom-dock-item::after {
        content: none;
        display: none;
    }

    /* 3. STYLE TOMBOL SAAT DIKLIK (AKTIF) */
    .nav-pills .nav-link.active.custom-dock-item {
        background-color: #3b82f6 !important;
        /* Warna BIRU Utama */
        color: #ffffff !important;
        /* Teks Putih */
        border-color: #3b82f6 !important;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        /* Glow Biru */
        transform: translateY(-2px);
        /* Sedikit naik */
    }

    /* 4. MUNCULKAN GARIS ORANYE (HANYA SAAT AKTIF) */
    .nav-pills .nav-link.active.custom-dock-item::after {
        content: '';
        display: block;
        position: absolute;

        /* Mengatur posisi garis di bawah tombol */
        bottom: -10px;
        /* Jarak garis dari tombol */
        left: 50%;
        transform: translateX(-50%);
        /* Pas di tengah */

        /* Ukuran Garis */
        width: 80%;
        height: 4px;

        /* Warna Garis */
        background-color: #F59E0B;
        /* Warna ORANYE */
        border-radius: 4px;

        /* Animasi muncul */
        animation: popLine 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* Animasi untuk garisnya */
    @keyframes popLine {
        0% {
            transform: translateX(-50%) scaleX(0);
            opacity: 0;
        }

        100% {
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }
    }

    /* Hover Effect */
    .nav-pills .nav-link.custom-dock-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
        background-color: #f8fafc !important;
    }

    /* Styling Tombol AKTIF (Saat dipencet) - Biru Terang */
    .nav-pills .nav-link.active.custom-dock-item {
        background-color: #3b82f6 !important;
        /* Warna Biru Utama */
        color: #ffffff !important;
        /* Teks Putih */
        border-color: #3b82f6 !important;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        /* Glow Biru */
        transform: scale(1.05);
    }

    /* HAPUS/RESET style wrapper lama jika masih nempel */
    .nav-dock-fix {
        background: none !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }

    /* 3. MOBILE MENU (PREMIUM GLASS - VERSI TERBARU) */
    .btn-mobile-fix {
        width: 100%;
        background: #0f172a;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 18px 24px;
        border-radius: 20px;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .custom-menu-fix {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 15px;
        margin-top: 15px;
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.15);
        border: none;
        width: 100%;
        animation: menuIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .menu-item-fix {
        padding: 14px 20px;
        border-radius: 14px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .menu-item-fix:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .menu-item-fix.active {
        background: #eff6ff;
        color: #2563eb;
    }

    /* 4. DESIGN KARTU (KEMBALI KE VERSI MASTERPIECE TAPI TANPA PANAH) */
    .mitra-card-fix {
        background: #ffffff;
        border-radius: 20px;
        height: 230px;
        /* Tinggi proporsional */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0;
        transform: translateY(30px);
    }

    /* Area Atas: Logo */
    .fix-card-top {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    /* Area Bawah: Info (TANPA PANAH, TEXT CENTER) */
    .fix-card-bottom {
        background: #f8fafc;
        padding: 15px 10px;
        border-top: 1px solid #f1f5f9;

        /* --- UBAH BAGIAN FLEX INI AGAR CENTER --- */
        display: flex;
        flex-direction: column;
        /* Susun ke bawah */
        justify-content: center;
        align-items: center;
        text-align: center;
        /* Teks rata tengah */

        position: relative;
        z-index: 2;
        transition: 0.3s;
        min-height: 80px;
    }

    .logo-fix {
        max-width: 85%;
        max-height: 80px;
        object-fit: contain;
        filter: none !important;
        opacity: 1 !important;
        transition: transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .name-fix {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 15px;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }

    .cat-fix {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 600;
        margin-top: 4px;
        display: block;
    }

    /* Hover Effects */
    .mitra-card-fix:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.15);
        border-color: #3b82f6;
    }

    .mitra-card-fix:hover .logo-fix {
        transform: scale(1.15);
    }

    .mitra-card-fix:hover .fix-card-bottom {
        background: #0f172a;
        /* Footer jadi Hitam Premium */
        border-top-color: #0f172a;
    }

    .mitra-card-fix:hover .name-fix {
        color: #fff;
    }

    .mitra-card-fix:hover .cat-fix {
        color: #94a3b8;
    }

    /* Badge Verified */
    .verified-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #3b82f6;
        opacity: 0;
        transform: scale(0);
        transition: 0.3s;
        z-index: 5;
    }

    .mitra-card-fix:hover .verified-icon {
        opacity: 1;
        transform: scale(1);
    }

    /* === [MULAI] HIGH PERFORMANCE ANIMATION (ANTI-LAG) === */

    /* 1. Animasi Container Dock */
    .nav-dock-fix {
        /* Gunakan Hardware Acceleration */
        will-change: transform, opacity;
        animation: dockSnap 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
    }

    /* 2. Kartu Mitra (OPTIMIZED) */
    .mitra-card-fix {
        opacity: 0;
        /* Default posisi sedikit di bawah */
        transform: translateY(30px);
        /* Transisi hover tetap smooth */
        transition: transform 0.7s ease, box-shadow 0.9s ease, border-color 0.3s ease;
        /* PENTING: Beritahu browser bahwa elemen ini akan berubah */
        will-change: transform, opacity;
        /* Hilangkan flickering */
        backface-visibility: hidden;
    }

    /* Kelas pemicu animasi */
    .mitra-card-fix.show-animate {
        animation: cardUpFast 0.5s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    }

    /* === KEYFRAMES RINGAN (TANPA BLUR) === */

    @keyframes dockSnap {
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes cardUpFast {
        0% {
            opacity: 0;
            transform: translateY(30px);
            /* Jarak geser jangan kejauhan biar enteng */
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* === STAGGER DELAY (URUTAN MUNCUL) === */
    /* Delay dipercepat sedikit biar kerasa responsif */
    .tab-pane .col-6:nth-child(1) .mitra-card-fix {
        animation-delay: 0.0s;
    }

    .tab-pane .col-6:nth-child(2) .mitra-card-fix {
        animation-delay: 0.05s;
    }

    .tab-pane .col-6:nth-child(3) .mitra-card-fix {
        animation-delay: 0.1s;
    }

    .tab-pane .col-6:nth-child(4) .mitra-card-fix {
        animation-delay: 0.15s;
    }

    .tab-pane .col-6:nth-child(5) .mitra-card-fix {
        animation-delay: 0.2s;
    }

    .tab-pane .col-6:nth-child(6) .mitra-card-fix {
        animation-delay: 0.25s;
    }

    .tab-pane .col-6:nth-child(7) .mitra-card-fix {
        animation-delay: 0.3s;
    }

    .tab-pane .col-6:nth-child(8) .mitra-card-fix {
        animation-delay: 0.35s;
    }

    /* ======================================= */
    /* === [BARU] CSS UNTUK MARQUEE LEBIH SMOOTH (TETAP BERGERAK SAAT HOVER) === */
    /* ======================================= */

    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        width: 100%;
        mask-image: linear-gradient(to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 10%,
                rgba(255, 255, 255, 1) 90%,
                rgba(255, 255, 255, 0) 100%);
    }

    .marquee-content {
        display: inline-flex;
        animation: scrollMarquee 25s linear infinite;
        padding-right: 20px;
        will-change: transform;
    }

    /* CATATAN: Blok CSS :hover DIHAPUS agar animasi tetap berjalan */

    .marquee-item {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 80px;
        padding: 0 40px;
        box-sizing: border-box;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .marquee-item:hover {
        opacity: 1;
        /* Efek opacity saat hover tetap berfungsi */
    }

    /* Keyframes untuk pergerakan marquee */
    @keyframes scrollMarquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Penyesuaian gambar logo di dalam marquee */
    .marquee-item img {
        max-height: 45px !important;
        width: auto;
        filter: grayscale(100%);
        transition: filter 0.3s ease;
    }

    .marquee-item:hover img {
        filter: grayscale(0%);
        /* Warna penuh saat di-hover */
    }

    /* --- ANIMASI PEMBUKA PROFESIONAL --- */

    /* State awal elemen (sebelum animasi mulai) */
    .pro-entrance {
        opacity: 0;
        /* Tersembunyi */
        /* Posisi turun sedikit, scale kecil, dan blur */
        transform: translateY(40px) scale(0.96);
        filter: blur(10px);
        /* Panggil animasi */
        animation: cinematicFocus 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        /* Delay sedikit agar elemen lain muncul duluan (opsional) */
        animation-delay: 0.3s;

        /* Pastikan overflow hidden agar rapi saat animasi jalan */
        overflow: hidden;
        will-change: transform, opacity, filter;
    }

    /* Keyframes: Gerakan dari Blur+Bawah ke Tajam+Posisi Asli */
    @keyframes cinematicFocus {
        0% {
            opacity: 0;
            transform: translateY(40px) scale(0.96);
            filter: blur(12px);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    }

    /* --- CSS MARQUEE ASLI (JAGA-JAGA JIKA BELUM ADA) --- */
    /* Pastikan CSS ini ada agar marquee-nya jalan */
    .marquee-container {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }

    /* Bonus: Saat mouse diarahkan, logo jadi berwarna & animasi stop */
    .marquee-container:hover .marquee-content {
        animation-play-state: paused;
    }

    .marquee-item img:hover {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.1);
    }

    @keyframes scroll-left {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }
    }
</style>

<header class="pt-5 pb-5 mt-5 bg-white text-center border-bottom">
    <div class="container pt-5 mb-5">
        <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill mb-3" data-aos="fade-down">
            <i class="fas fa-handshake me-2"></i>PARTNER EKOSISTEM
        </span>
        <h1 class="display-4 fw-bold text-dark mb-3" data-aos="fade-up">
            Mitra Strategis Kami
        </h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px" data-aos="fade-up" data-aos-delay="100">
            Kami bekerjasama dengan perusahaan terkemuka untuk memastikan lulusan terserap di industri yang relevan dan bonafit.
        </p>
    </div>

    <div class="py-4 bg-light border-top border-bottom pro-entrance">
        <div class="marquee-container">
            <div class="marquee-content">
                <?php if (!empty($mitra_data)) : ?>
                    <?php foreach ($mitra_data as $row) :
                        $logo_url = !empty($row->mitra_logo) ? base_url('assets/mitra/' . $row->mitra_logo) : base_url('assets/mitra/default.png');
                    ?>
                        <span class="marquee-item">
                            <img src="<?= $logo_url ?>" alt="<?= htmlspecialchars($row->mitra_nama) ?>" />
                        </span>
                    <?php endforeach; ?>

                    <?php foreach ($mitra_data as $row) :
                        $logo_url = !empty($row->mitra_logo) ? base_url('assets/mitra/' . $row->mitra_logo) : base_url('assets/mitra/default.png');
                    ?>
                        <span class="marquee-item">
                            <img src="<?= $logo_url ?>" alt="<?= htmlspecialchars($row->mitra_nama) ?>" />
                        </span>
                    <?php endforeach; ?>
                <?php else : ?>
                    <span class="marquee-item">Belum ada mitra</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<section class="mitra-section-fix py-5">
    <div class="container py-4">

        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-dark mb-2">Mitra Industri</h2>
            <div style="height: 5px; width: 80px; background: linear-gradient(90deg, #3b82f6, #06b6d4); margin: 0 auto; border-radius: 10px;"></div>
        </div>

        <div class="row justify-content-center mb-5 d-none d-md-flex">
            <div class="col-12 text-center">
                <ul class="nav nav-pills gap-3 justify-content-center" id="pills-tab-desktop" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active custom-dock-item" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" onclick="filterSelection('all')">
                            Semua
                        </button>
                    </li>
                    <?php if (!empty($kategori_data)) : ?>
                        <?php foreach ($kategori_data as $kat) : ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-dock-item"
                                    id="pills-cat-<?= $kat->kategori_mitra_id ?>-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-cat-<?= $kat->kategori_mitra_id ?>"
                                    type="button"
                                    onclick="filterSelection('cat-<?= $kat->kategori_mitra_id ?>')">
                                    <?= htmlspecialchars($kat->kategori_mitra_nama) ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="row justify-content-center mb-4 d-md-none">
            <div class="col-12 px-3">
                <div class="dropdown">
                    <button class="btn-mobile-fix" type="button" id="mobileFilterBtn" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="mobileFilterText"><i class="fas fa-layer-group me-2 text-info"></i> Kategori: Semua</span>
                        <i class="fas fa-chevron-circle-down text-white-50"></i>
                    </button>

                    <ul class="dropdown-menu custom-menu-fix" aria-labelledby="mobileFilterBtn">
                        <li onclick="triggerFilter(this, 'pills-all', 'Semua')">
                            <div class="menu-item-fix active"><span>Semua Mitra</span></div>
                        </li>
                        <?php if (!empty($kategori_data)) : ?>
                            <?php foreach ($kategori_data as $kat) : ?>
                                <li onclick="triggerFilter(this, 'pills-cat-<?= $kat->kategori_mitra_id ?>', '<?= htmlspecialchars($kat->kategori_mitra_nama) ?>')">
                                    <div class="menu-item-fix"><span><?= htmlspecialchars($kat->kategori_mitra_nama) ?></span></div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContentFix">

            <div class="tab-pane fade show active" id="pills-all">
                <div class="row g-4 justify-content-center">
                    <?php if (!empty($mitra_data)) : ?>
                        <?php foreach ($mitra_data as $row) :
                            $logo_url = !empty($row->mitra_logo) ? base_url('assets/mitra/' . $row->mitra_logo) : base_url('assets/mitra/default.png');
                        ?>
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="mitra-card-fix">
                                    <i class="fas fa-certificate verified-icon"></i>

                                    <div class="fix-card-top">
                                        <img src="<?= $logo_url ?>" class="logo-fix" alt="<?= htmlspecialchars($row->mitra_nama) ?>" />
                                    </div>

                                    <div class="fix-card-bottom">
                                        <h6 class="name-fix"><?= htmlspecialchars($row->mitra_nama) ?></h6>
                                        <span class="cat-fix"><?= htmlspecialchars($row->kategori_mitra_nama) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5 text-muted">Belum ada data mitra.</div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($kategori_data)) : ?>
                <?php foreach ($kategori_data as $kat) : ?>
                    <div class="tab-pane fade" id="pills-cat-<?= $kat->kategori_mitra_id ?>">
                        <div class="row g-4 justify-content-center">
                            <?php
                            $found = false;
                            foreach ($mitra_data as $row) :
                                if ($row->kategori_mitra_id == $kat->kategori_mitra_id) {
                                    $found = true;
                                    $logo_url = !empty($row->mitra_logo) ? base_url('assets/mitra/' . $row->mitra_logo) : base_url('assets/mitra/default.png');
                            ?>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="mitra-card-fix">
                                            <i class="fas fa-certificate verified-icon"></i>
                                            <div class="fix-card-top">
                                                <img src="<?= $logo_url ?>" class="logo-fix" alt="<?= htmlspecialchars($row->mitra_nama) ?>" />
                                            </div>
                                            <div class="fix-card-bottom">
                                                <h6 class="name-fix"><?= htmlspecialchars($row->mitra_nama) ?></h6>
                                                <span class="cat-fix"><?= htmlspecialchars($row->kategori_mitra_nama) ?></span>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            endforeach;
                            if (!$found) {
                                echo '<div class="col-12 text-center py-5 text-muted">Belum ada mitra</div>';
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <h3 class="fw-bold text-center mb-5" data-aos="fade-up">
            Kata Mereka Tentang Alumni Kami
        </h3>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right">
                <div class="quote-card h-100">
                    <i class="fas fa-quote-left quote-icon"></i>
                    <p class="mb-4 fst-italic position-relative z-1 text-muted">
                        "Lulusan SMKN 1 Purwosari memiliki etos kerja yang luar biasa. Skill teknis mereka sangat relevan dengan kebutuhan lini produksi kami saat ini."
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px">HR</div>
                        <div>
                            <h6 class="fw-bold mb-0">Bpk. Agus Santoso</h6>
                            <small class="text-muted">HRD Manager - PT. Honda Precision Parts</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="quote-card h-100">
                    <i class="fas fa-quote-left quote-icon"></i>
                    <p class="mb-4 fst-italic position-relative z-1 text-muted">
                        "Kerjasama BKK sangat profesional. Proses rekrutmen massal berjalan lancar dan kami mendapatkan kandidat terbaik untuk posisi IT Support."
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px">HR</div>
                        <div>
                            <h6 class="fw-bold mb-0">Ibu Sarah Wijaya</h6>
                            <small class="text-muted">Recruitment Lead - Telkom Akses</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="cta-gradient-box text-center" data-aos="zoom-in">
            <div class="cta-content">
                <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm">
                    <i class="fas fa-star text-warning me-2"></i>KESEMPATAN EMAS
                </span>
                <h2 class="fw-bold mb-3 display-5">
                    Bergabung dengan Ekosistem Kami
                </h2>
                <p class="text-light opacity-75 mb-5 mx-auto fs-5" style="max-width: 650px">
                    Akses langsung ke database ribuan talenta muda siap kerja. Tingkatkan efisiensi rekrutmen perusahaan Anda bersama BKK SMKN 1 Purwosari.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?= site_url('kontak') ?>" class="btn btn-cta-glow fw-bold px-5 py-3 rounded-pill">
                        <i class="fas fa-handshake me-2"></i> Ajukan MoU Kemitraan
                    </a>
                    <a href="<?= site_url('kontak') ?>" class="btn btn-outline-light fw-bold px-5 py-3 rounded-pill border-2">
                        Hubungi Tim Humas
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // 1. Fungsi untuk Mereset & Menjalankan Animasi
        function replayAnimations(containerId) {
            const container = document.querySelector(containerId);
            if (!container) return;

            // Ambil semua kartu di dalam tab yang aktif
            const cards = container.querySelectorAll('.mitra-card-fix');

            cards.forEach((card) => {
                // Hapus kelas animasi
                card.classList.remove('show-animate');

                // Trigger Reflow (Trik agar browser merestart animasi)
                void card.offsetWidth;

                // Tambahkan kelas animasi lagi
                card.classList.add('show-animate');
            });
        }

        // 2. Jalankan animasi pertama kali saat halaman dimuat (untuk tab 'Semua')
        // Beri sedikit delay agar loading selesai
        setTimeout(() => {
            replayAnimations('#pills-all');
        }, 300);

        // 3. Event Listener saat Tab Kategori diklik
        const tabButtons = document.querySelectorAll('button[data-bs-toggle="pill"]');
        tabButtons.forEach(btn => {
            btn.addEventListener('shown.bs.tab', function(event) {
                // Ambil ID target tab (misal: #pills-elektronik)
                const targetId = event.target.getAttribute('data-bs-target');
                replayAnimations(targetId);
            });
        });

        // 4. Logic untuk Mobile Dropdown (Agar tombol filter berubah teksnya)
        window.triggerFilter = function(elementLi, targetId, labelName) {
            document.getElementById('mobileFilterText').innerHTML = '<i class="fas fa-layer-group me-2 text-info"></i> Kategori: ' + labelName;

            document.querySelectorAll('.menu-item-fix').forEach(el => el.classList.remove('active'));
            elementLi.querySelector('.menu-item-fix').classList.add('active');

            var desktopTabBtn = document.querySelector(`button[data-bs-target="#${targetId}"]`);
            if (desktopTabBtn) {
                var tabInstance = new bootstrap.Tab(desktopTabBtn);
                tabInstance.show();
            }
        };

        window.syncMobileFilter = function(name, id) {
            document.getElementById('mobileFilterText').innerHTML = '<i class="fas fa-layer-group me-2 text-info"></i> Kategori: ' + name;
        };
    });
</script>