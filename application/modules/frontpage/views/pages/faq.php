<style>
    /* =================================================================
           FAQ FULL PAGE STYLING
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
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    html,
    body {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: var(--light);
        color: var(--dark);
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Outfit", sans-serif;
    }

    /* FAQ HERO SECTION */
    .faq-hero-section {
        padding: 120px 0 80px;
        background: var(--dark);
        position: relative;
        color: white;
        overflow: hidden;
    }

    .faq-hero-bg {
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

    .faq-floating-shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.3;
    }

    .faq-shape-1 {
        width: 300px;
        height: 300px;
        background: var(--primary);
        top: -50px;
        left: -100px;
    }

    .faq-shape-2 {
        width: 200px;
        height: 200px;
        background: var(--secondary);
        bottom: 5%;
        right: -50px;
    }

    .faq-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .faq-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 25px;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 2rem;
    }

    .faq-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        background: linear-gradient(to right, #ffffff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .faq-subtitle {
        font-size: 1.1rem;
        color: #cbd5e1;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* FAQ CONTENT SECTION */
    .faq-full-page-section {
        padding: 6rem 0;
        background: #f8fafc;
        min-height: calc(100vh - 60px);
    }

    .faq-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* ACCORDION STYLING */
    .accordion {
        border: none;
        gap: 1rem;
    }

    .accordion-item {
        background: white;
        border: none;
        border-radius: 16px;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-card);
        overflow: hidden;
        transition: var(--transition-smooth);
    }

    .accordion-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .accordion-header {
        padding: 0;
        border: none;
    }

    .accordion-button {
        padding: 1.5rem 2rem;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--dark);
        background: white;
        border: none;
        position: relative;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .accordion-button::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: var(--secondary);
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(0, 153, 255, 0.05) 100%);
        color: var(--primary);
        box-shadow: none;
    }

    .accordion-button:not(.collapsed)::before {
        transform: scaleY(1);
    }

    .accordion-button:focus {
        box-shadow: none;
        outline: none;
    }

    .accordion-button::after {
        content: "";
        position: absolute;
        right: 1.5rem;
        width: 24px;
        height: 24px;
        background: var(--primary);
        mask-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"%3E%3Cpolyline points="6 9 12 15 18 9"%3E%3C/polyline%3E%3C/svg%3E');
        mask-size: contain;
        mask-repeat: no-repeat;
        mask-position: center;
        transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
        transform: rotate(180deg);
    }

    .accordion-collapse {
        background: white;
    }

    .accordion-body {
        padding: 0 2rem 1.5rem 2rem;
        color: var(--gray);
        font-size: 1rem;
        line-height: 1.8;
        border-top: 1px solid #f1f5f9;
    }

    /* EMPTY STATE */
    .faq-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow-card);
    }

    .faq-empty-state i {
        font-size: 4rem;
        color: var(--gray);
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .faq-empty-state h4 {
        color: var(--dark);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .faq-empty-state p {
        color: var(--gray);
        margin: 0;
    }

    /* CTA SECTION */
    .faq-cta-section {
        background: var(--gradient-blue);
        border-radius: 30px;
        padding: 4rem 3rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        margin-top: 4rem;
        box-shadow: 0 20px 60px rgba(13, 110, 253, 0.2);
    }

    .faq-cta-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.15) 2px, transparent 2px);
        background-size: 20px 20px;
        z-index: 0;
    }

    .faq-cta-content {
        position: relative;
        z-index: 2;
    }

    .faq-cta-content h3 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .faq-cta-content p {
        font-size: 1.05rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .faq-cta-btn {
        background: white;
        color: var(--primary);
        padding: 14px 45px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
    }

    .faq-cta-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* ANIMATIONS */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .accordion-item {
        animation: slideInUp 0.6s ease forwards;
    }

    .accordion-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .accordion-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .accordion-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .accordion-item:nth-child(4) {
        animation-delay: 0.4s;
    }

    .accordion-item:nth-child(5) {
        animation-delay: 0.5s;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .faq-hero-section {
            padding: 80px 0 60px;
        }

        .faq-title {
            font-size: 2.2rem;
        }

        .faq-subtitle {
            font-size: 1rem;
        }

        .accordion-button {
            padding: 1.2rem 1.5rem;
            font-size: 1rem;
        }

        .accordion-button::after {
            right: 1rem;
        }

        .accordion-body {
            padding: 0 1.5rem 1.2rem 1.5rem;
            font-size: 0.95rem;
        }

        .faq-cta-section {
            padding: 2.5rem 1.5rem;
        }

        .faq-cta-content h3 {
            font-size: 1.5rem;
        }

        .faq-cta-content p {
            font-size: 0.95rem;
        }

        .faq-shape-1 {
            width: 200px;
            height: 200px;
            left: -80px;
        }

        .faq-shape-2 {
            width: 150px;
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .faq-hero-section {
            padding: 60px 0 40px;
        }

        .faq-title {
            font-size: 1.8rem;
        }

        .faq-badge {
            font-size: 0.8rem;
            padding: 8px 16px;
        }

        .accordion-item {
            margin-bottom: 1rem;
        }

        .accordion-button {
            padding: 1rem 1rem;
            font-size: 0.95rem;
            gap: 10px;
        }

        .accordion-body {
            padding: 0 1rem 1rem 1rem;
        }

        .faq-cta-section {
            padding: 2rem 1rem;
            border-radius: 20px;
        }

        .faq-cta-content h3 {
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
        }

        .faq-cta-content p {
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .faq-cta-btn {
            padding: 12px 30px;
            font-size: 0.9rem;
        }
    }
</style>

<!-- FAQ HERO SECTION -->
<section class="faq-hero-section">
    <div class="faq-hero-bg"></div>
    <div class="faq-floating-shape faq-shape-1"></div>
    <div class="faq-floating-shape faq-shape-2"></div>

    <div class="container faq-hero-content">
        <div class="faq-badge">
            <i class="fas fa-lightbulb"></i> PERTANYAAN UMUM
        </div>
        <h1 class="faq-title">Jawaban untuk Pertanyaan Anda</h1>
        <p class="faq-subtitle">
            Temukan informasi lengkap tentang layanan, program, dan kerjasama dengan BKK SMKN 1 Purwosari.
        </p>
    </div>
</section>

<!-- FAQ CONTENT SECTION -->
<section class="faq-full-page-section">
    <div class="container faq-container">
        <div class="accordion" id="accordionFaqFullPage">
            <?php
            // Inisialisasi counter untuk animasi
            $i = 1;
            // Ambil data FAQ dari database, diurutkan berdasarkan ID terbaru
            $this->db->order_by('faq_id', 'desc');
            $getFAQ = $this->db->get('tb_faq');

            // Cek apakah ada data yang ditemukan
            if ($getFAQ->num_rows() > 0) {
                foreach ($getFAQ->result() as $faq):
                    // Item pertama akan terbuka secara default
                    $is_collapsed = ($i > 1) ? 'collapsed' : '';
                    $is_show = ($i == 1) ? 'show' : '';
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?= $faq->faq_id ?>">
                            <button class="accordion-button <?= $is_collapsed ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse<?= $faq->faq_id ?>"
                                aria-expanded="<?= ($i == 1) ? 'true' : 'false' ?>"
                                aria-controls="flush-collapse<?= $faq->faq_id ?>">
                                <i class="fas fa-question-circle" style="color: var(--secondary); font-size: 1.3rem;"></i>
                                <?= $faq->faq_quest ?>
                            </button>
                        </h2>
                        <div id="flush-collapse<?= $faq->faq_id ?>" class="accordion-collapse collapse <?= $is_show ?>"
                            aria-labelledby="flush-heading<?= $faq->faq_id ?>" data-bs-parent="#accordionFaqFullPage">
                            <div class="accordion-body">
                                <?= $faq->faq_answ ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++; // Tingkatkan counter
                endforeach;
            } else {
                // Tampilkan pesan jika tidak ada data FAQ
                ?>
                <div class="faq-empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>Data FAQ Belum Tersedia</h4>
                    <p>Maaf, belum ada Pertanyaan Umum (FAQ) yang tersedia saat ini. Silakan hubungi kami untuk informasi
                        lebih lanjut.</p>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- CTA SECTION -->
        <div class="faq-cta-section">
            <div class="faq-cta-pattern"></div>
            <div class="faq-cta-content">
                <h3>Pertanyaan Lain?</h3>
                <p>Tim kami siap membantu Anda. Hubungi kami untuk mendapatkan informasi lebih detail tentang program
                    dan kerjasama.</p>
                <button class="faq-cta-btn" onclick="window.location.href='<?= site_url('kontak') ?>'">
                    <i  class="fas fa-paper-plane"></i> Hubungi Kami
                </button>
            </div>
        </div>
    </div>
</section>