<style>
    /* --- CSS KHUSUS DIGITAL CAREER DASHBOARD (PREMIUM & RAME) --- */

    body {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: #f0f4f8;
        overflow-x: hidden;
    }

    /* 1. LATAR BELAKANG PREMIUM (CIRCUIT PATTERN) */
    .stats-premium-section {
        padding: 7rem 0;
        background-color: #f0f4f8;
        position: relative;
        overflow: hidden;
    }

    /* Pola Sirkuit Data */
    .stats-premium-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle at 20% 30%,
                rgba(13, 110, 253, 0.03) 0%,
                transparent 50%),
            radial-gradient(circle at 80% 70%,
                rgba(13, 202, 240, 0.03) 0%,
                transparent 50%);
        background-color: #f8fafc;
        /* Pattern halus */
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zM22.344 0L13.858 8.485 15.272 9.9l7.9-7.9h-.828zm5.656 0L19.515 8.485 18.1 9.9l-7.9-7.9h2.83zm11.313 0L30.83 8.485 29.413 9.9l-7.9-7.9h2.83zm5.657 0L36.485 8.485 35.07 9.9l-7.9-7.9h2.83zm11.313 0L42.142 8.485 40.728 9.9l-7.9-7.9h2.83zM54.627 60l.83-.828-1.415-1.415L51.8 60h2.827zM5.373 60l-.83-.828L5.96 57.757 8.2 60H5.374zM48.97 60l3.657-3.657-1.414-1.414L46.143 60h2.828zM11.03 60L7.372 56.343 8.787 54.93 13.857 60H11.03zm32.284 0L49.8 53.515 48.384 52.1l-7.9 7.9h2.83zM16.686 60L10.2 53.515 11.616 52.1l7.9 7.9h-2.83zM22.344 60L13.858 51.515 15.272 50.1l7.9 7.9h-.828zm5.656 0L19.515 51.515 18.1 50.1l-7.9 7.9h2.83zm11.313 0L30.83 51.515 29.413 50.1l-7.9 7.9h2.83zm5.657 0L36.485 51.515 35.07 50.1l-7.9 7.9h2.83zm11.313 0L42.142 51.515 40.728 50.1l-7.9 7.9h2.83zM39 29v2h-2v-2h2zm2-2v6h-6v-6h6zm-2 2v2h-2v-2h2zm2-2v6h-6v-6h6zm-2 2v2h-2v-2h2zm2-2v6h-6v-6h6zM21 29v2h-2v-2h2zm2-2v6h-6v-6h6zm-2 2v2h-2v-2h2zm2-2v6h-6v-6h6zm-2 2v2h-2v-2h2zm2-2v6h-6v-6h6z' fill='%230d6efd' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        z-index: 0;
    }

    .container.z-1 {
        position: relative;
        z-index: 1;
    }

    /* Typography */
    .section-label-top {
        font-family: "Outfit", sans-serif;
        color: #0d6efd;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        background: rgba(13, 110, 253, 0.1);
        padding: 8px 16px;
        border-radius: 30px;
        display: inline-block;
    }

    .section-title-main {
        font-family: "Outfit", sans-serif;
        color: #0f172a;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    /* Gradient Text */
    .text-grad-primary {
        background: linear-gradient(135deg, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* 2. KARTU STATISTIK (GLOWING EFFECT) */
    .stat-card-ultra {
        background: #ffffff;
        border-radius: 24px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0, 0, 0, 0.03);
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05);
        height: 100%;
        z-index: 1;
    }

    /* Hover Effect: Lift & Glow */
    .stat-card-ultra:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.1);
    }

    /* Background Gradient Samar saat Hover */
    .stat-card-ultra::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.8) 100%);
        opacity: 0;
        transition: 0.4s;
        z-index: -1;
    }

    .stat-card-ultra:hover::after {
        opacity: 1;
    }

    /* -- WARNA TEMA & GRADASI ANGKA -- */

    /* 1. Theme Success (Hijau Mewah) */
    .theme-ultra-success {
        border-bottom: 6px solid #10b981;
    }

    .theme-ultra-success .num-gradient {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .theme-ultra-success .icon-float-bg {
        color: #d1fae5;
    }

    .theme-ultra-success:hover {
        box-shadow: 0 20px 50px -10px rgba(16, 185, 129, 0.2);
    }

    /* 2. Theme Primary (Biru Royal) */
    .theme-ultra-primary {
        border-bottom: 6px solid #4f46e5;
    }

    .theme-ultra-primary .num-gradient {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .theme-ultra-primary .icon-float-bg {
        color: #e0e7ff;
    }

    .theme-ultra-primary:hover {
        box-shadow: 0 20px 50px -10px rgba(79, 70, 229, 0.2);
    }

    /* 3. Theme Warning (Emas/Oranye) */
    .theme-ultra-warning {
        border-bottom: 6px solid #f59e0b;
    }

    .theme-ultra-warning .num-gradient {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .theme-ultra-warning .icon-float-bg {
        color: #fef3c7;
    }

    .theme-ultra-warning:hover {
        box-shadow: 0 20px 50px -10px rgba(245, 158, 11, 0.2);
    }

    /* -- ELEMEN DALAM KARTU -- */

    /* Angka Besar */
    .stat-val-ultra {
        font-family: "Outfit", sans-serif;
        font-size: 4.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 5px;
        letter-spacing: -2px;
        display: block;
    }

    /* Label Judul */
    .stat-label-ultra {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        letter-spacing: 0.5px;
    }

    /* Deskripsi Kecil */
    .stat-desc-ultra {
        font-size: 0.9rem;
        color: #64748b;
        margin-top: 1rem;
        line-height: 1.5;
        font-weight: 500;
    }

    /* Badge Trend */
    .trend-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-top: 1.5rem;
    }

    .trend-badge.positive {
        background: #ecfdf5;
        color: #059669;
    }

    .trend-badge.neutral {
        background: #eff6ff;
        color: #1d4ed8;
    }

    /* -- ANIMASI IKON (GERAK TERUS) -- */
    .icon-float-bg {
        position: absolute;
        top: -10px;
        right: -20px;
        font-size: 8rem;
        opacity: 0.5;
        z-index: -1;
        animation: floatRotate 6s ease-in-out infinite;
        /* Animasi Muter & Naik Turun */
    }

    @keyframes floatRotate {
        0% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-15px) rotate(10deg);
        }

        100% {
            transform: translateY(0) rotate(0deg);
        }
    }

    /* 3. PANEL GRAFIK (DENGAN ANIMASI SHIMMER) */
    .chart-panel-premium {
        background: #ffffff;
        border-radius: 24px;
        padding: 3.5rem;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .chart-header-premium h4 {
        font-family: "Outfit", sans-serif;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        font-size: 1.75rem;
    }

    .progress-item-premium {
        margin-bottom: 2.5rem;
    }

    .progress-title-premium {
        font-weight: 700;
        color: #334155;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .progress-percent-premium {
        font-family: "Outfit", sans-serif;
        font-weight: 800;
        color: #0f172a;
        font-size: 1.25rem;
    }

    .progress-track-premium {
        height: 20px;
        width: 100%;
        background: #e2e8f0;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* ANIMASI SHIMMER (KILAUAN CAHAYA) */
    .progress-fill-shimmer {
        height: 100%;
        border-radius: 50px;
        width: 0%;
        transition: width 2.5s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
        overflow: hidden;
    }

    /* Efek kilauan bergerak */
    .progress-fill-shimmer::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent);
        animation: shimmer 2.5s infinite;
    }

    @keyframes shimmer {
        100% {
            left: 100%;
        }
    }

    .grad-blue-premium {
        background: linear-gradient(90deg, #0d6efd, #60a5fa);
    }

    .grad-purple-premium {
        background: linear-gradient(90deg, #6610f2, #a78bfa);
    }

    .grad-orange-premium {
        background: linear-gradient(90deg, #fd7e14, #fbbf24);
    }

    /* 4. SEKSI TAMBAHAN (KEUNGGULAN - BIAR RAME) */
    .features-grid {
        margin-top: 6rem;
    }

    .feature-card {
        background: white;
        padding: 2.5rem;
        border-radius: 24px;
        text-align: center;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
        border-bottom: 4px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-bottom-color: #0d6efd;
    }

    /* Ikon Beranimasi (Pulsing) */
    .feature-icon-box {
        width: 80px;
        height: 80px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 1.5rem;
        animation: pulse-soft 3s infinite ease-in-out;
    }

    @keyframes pulse-soft {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(13, 110, 253, 0.3);
        }
    }

    .feature-title {
        font-family: "Outfit", sans-serif;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #1e293b;
    }

    .feature-desc {
        color: #64748b;
        line-height: 1.7;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .chart-panel-premium {
            padding: 2rem;
        }

        .counter-wrapper-premium {
            font-size: 3.5rem;
        }

        .features-grid {
            margin-top: 4rem;
        }
    }
</style>

<section class="stats-premium-section" id="stats-section">
    <div class="container z-1">
        <div
            class="row justify-content-center text-center mb-5"
            data-aos="fade-down">
            <div class="col-lg-8">
                <span class="section-label-top mb-3"><i class="fas fa-chart-pie me-2"></i>Digital Career
                    Ecosystem</span>
                <h2 class="display-4 section-title-main mb-3">
                    Dampak Nyata
                    <span class="text-grad-primary">BKK Untuk Alumni</span>
                </h2>
                <p class="text-muted fs-5">
                    Data transparansi keterserapan lulusan di dunia industri, didukung
                    oleh ekosistem karir yang terintegrasi.
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5 justify-content-center">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card-ultra theme-ultra-success">
                    <i class="fas fa-rocket icon-float-bg"></i>

                    <div class="position-relative">
                        <span class="stat-val-ultra num-gradient">
                            <span class="counter-val-live" data-target="85">0</span>%
                        </span>
                        <div class="stat-label-ultra">Langsung Bekerja</div>
                        <p class="stat-desc-ultra">
                            Lulusan terserap di industri bonafide dalam waktu kurang dari 3 bulan.
                        </p>
                        <div class="trend-badge positive">
                            <i class="fas fa-arrow-trend-up"></i> Naik 5% Tahun Ini
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card-ultra theme-ultra-primary">
                    <i class="fas fa-user-graduate icon-float-bg" style="animation-delay: 1s;"></i>

                    <div class="position-relative">
                        <span class="stat-val-ultra num-gradient">
                            <span class="counter-val-live" data-target="10">0</span>%
                        </span>
                        <div class="stat-label-ultra">Melanjutkan Studi</div>
                        <p class="stat-desc-ultra">
                            Melanjutkan pendidikan ke Perguruan Tinggi Negeri & Swasta Unggulan.
                        </p>
                        <div class="trend-badge neutral">
                            <i class="fas fa-minus"></i> Stabil & Konsisten
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card-ultra theme-ultra-warning">
                    <i class="fas fa-gem icon-float-bg" style="animation-delay: 2s;"></i>

                    <div class="position-relative">
                        <span class="stat-val-ultra num-gradient">
                            <span class="counter-val-live" data-target="5">0</span>%
                        </span>
                        <div class="stat-label-ultra">Creativepreneur</div>
                        <p class="stat-desc-ultra">
                            Membangun rintisan bisnis mandiri (Start-up) secara profesional.
                        </p>
                        <div class="trend-badge positive">
                            <i class="fas fa-arrow-trend-up"></i> Peningkatan Pesat
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="400">
            <div class="col-12">
                <div class="chart-panel-premium">
                    <div
                        class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3 border-bottom pb-4 chart-header-premium">
                        <div>
                            <h4>
                                <i class="fas fa-industry me-2 text-primary"></i> Sebaran
                                Sektor Industri
                            </h4>
                            <p class="text-muted mb-0 mt-2">
                                Dominasi penempatan alumni berdasarkan sektor perusahaan
                                mitra.
                            </p>
                        </div>
                        <span
                            class="badge bg-primary bg-opacity-10 text-primary p-3 rounded-pill fs-6"><i class="far fa-calendar-check me-2"></i> Periode:
                            2023/2024</span>
                    </div>

                    <div class="progress-item-premium">
                        <div class="progress-meta">
                            <span class="progress-title-premium"><i class="fas fa-car-side text-primary fa-lg"></i> Otomotif
                                & Manufaktur Alat Berat</span>
                            <span class="progress-percent-premium">45%</span>
                        </div>
                        <div class="progress-track-premium">
                            <div
                                class="progress-fill-shimmer grad-blue-premium"
                                data-width="45%"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="progress-item-premium">
                        <div class="progress-meta">
                            <span class="progress-title-premium"><i class="fas fa-microchip text-primary fa-lg"></i>
                                Elektronika, IoT & Teknologi Informasi</span>
                            <span class="progress-percent-premium">30%</span>
                        </div>
                        <div class="progress-track-premium">
                            <div
                                class="progress-fill-shimmer grad-purple-premium"
                                data-width="30%"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="progress-item-premium mb-0">
                        <div class="progress-meta">
                            <span class="progress-title-premium"><i class="fas fa-shopping-cart text-primary fa-lg"></i>
                                Retail Modern & Jasa Profesional</span>
                            <span class="progress-percent-premium">25%</span>
                        </div>
                        <div class="progress-track-premium">
                            <div
                                class="progress-fill-shimmer grad-orange-premium"
                                data-width="25%"
                                style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row features-grid g-4">
            <div class="col-12 text-center mb-4" data-aos="fade-down">
                <h3 class="fw-bold font-outfit">
                    Mengapa Tingkat Keterserapan Tinggi?
                </h3>
                <p class="text-muted">
                    Didukung oleh program unggulan BKK yang menjembatani sekolah
                    dengan industri.
                </p>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-handshake-simple"></i>
                    </div>
                    <h4 class="feature-title">Link & Match Industri</h4>
                    <p class="feature-desc mb-0">
                        Kurikulum yang diselaraskan dengan kebutuhan 50+ perusahaan
                        mitra skala nasional dan multinasional.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div
                        class="feature-icon-box"
                        style="background: rgba(16, 185, 129, 0.1); color: #10b981">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4 class="feature-title">Sertifikasi Kompetensi</h4>
                    <p class="feature-desc mb-0">
                        Lulusan dibekali sertifikat keahlian berstandar
                        BNSP/Internasional sebagai nilai tambah rekrutmen.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div
                        class="feature-icon-box"
                        style="background: rgba(245, 158, 11, 0.1); color: #f59e0b">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="feature-title">Fast-Track Rekrutmen</h4>
                    <p class="feature-desc mb-0">
                        Fasilitas rekrutmen khusus (Job Fair & Campus Hiring) yang
                        diadakan langsung di lingkungan sekolah.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>