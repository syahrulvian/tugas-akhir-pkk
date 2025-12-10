<?php
// Gallery Detail Page untuk BKK SMKN 1 Purwosari
$gallery_code = $this->input->get('code', TRUE);
if (!$gallery_code) {
    echo '<div class="alert alert-danger mt-5 text-center">Gallery code not provided.</div>';
    return;
}

$row = $this->db->get_where('tb_gallery', ['gallery_code' => $gallery_code])->row();
if (!$row) {
    echo '<div class="alert alert-danger mt-5 text-center">Gallery not found.</div>';
    return;
}

$this->template->title->set($row->gallery_title . ' | Galeri BKK SMKN 1 Purwosari');
$this->template->description->set(substr(htmlspecialchars($row->gallery_description), 0, 100));
$this->template->keywords->set('BKK, SMKN 1 Purwosari, Galeri, Kegiatan, ' . str_replace(' ', ', ', $row->gallery_title));

$arr_img = json_decode($row->gallery_image, true) ?? [];
$arr_img = array_values(array_filter($arr_img, 'is_string'));
$total_images = count($arr_img);
$js_images = json_encode($arr_img);

function get_image_url($image_name)
{
    return base_url('assets/gallery/' . $image_name);
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<section class="hero-masterpiece">
    <div class="hero-bg-mesh"></div>
    <div class="shape-float sf-1"></div>
    <div class="shape-float sf-2"></div>
    <div class="container hero-content">
        <div class="badge-hero-animated"><i class="bi bi-images"></i> DOKUMENTASI LENGKAP</div>
        <h1 class="hero-title-main"><?= htmlspecialchars($row->gallery_title) ?></h1>
        <p class="hero-desc"><?= substr(htmlspecialchars($row->gallery_description), 0, 150) ?>...</p>
    </div>
</section>

  <section class="thumbnails-section py-5">
            <div class="container">
                <h3 class="section-title mb-4">Lihat Semua Foto</h3>
                <div class="thumbnails-grid">
                    <?php foreach ($arr_img as $index => $img): ?>
                        <div class="thumbnail-item" data-index="<?= $index ?>" role="button"
                            aria-label="Lihat foto <?= $index + 1 ?>" title="Klik untuk melihat">
                            <img src="<?= get_image_url($img) ?>" alt="Thumbnail <?= $index + 1 ?>" class="thumbnail-img"
                                loading="lazy">
                            <div class="thumbnail-overlay">
                                <i class="bi bi-eye"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

<div class="gallery-detail-container">
    <?php if (!empty($arr_img)): ?>
        <section class="slider-showcase">
            <div class="container">
                <div class="gallery-slider-wrapper position-relative text-center">
                    <div class="gallery-main-container position-relative overflow-hidden">
                        <div id="imageLoadingOverlay"
                            class="position-absolute w-100 h-100 bg-white d-flex align-items-center justify-content-center"
                            style="z-index:10;transition:opacity 0.3s;opacity:1;">
                            <div class="spinner-border text-dark" role="status"><span
                                    class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <img id="mainImage" src="<?= get_image_url($arr_img[0]) ?>"
                            alt="<?= htmlspecialchars($row->gallery_title) ?>" class="main-gallery-img" loading="lazy">
                    </div>

                    <button class="gallery-nav gallery-prev" aria-label="Previous"><i
                            class="bi bi-chevron-left"></i></button>
                    <button class="gallery-nav gallery-next" aria-label="Next"><i class="bi bi-chevron-right"></i></button>

                    <div class="gallery-preview gallery-prev-img d-none d-lg-block" role="button">
                        <img id="prevImage" class="preview-img" alt="Previous preview" loading="lazy">
                    </div>
                    <div class="gallery-preview gallery-next-img d-none d-lg-block" role="button">
                        <img id="nextImage" class="preview-img" alt="Next preview" loading="lazy">
                    </div>
                </div>

                <div class="image-counter animate-counter">
                    <span class="counter-label">FOTO</span>
                    <span class="counter-display"><span id="currentIndex">1</span> <span class="text-muted">dari</span>
                        <?= $total_images ?></span>
                </div>
            </div>
        </section>

      
    <?php else: ?>
        <section class="slider-showcase">
            <div class="container">
                <div class="empty-state py-5">
                    <div class="empty-icon">
                        <i class="bi bi-image"></i>
                    </div>
                    <h3>Tidak Ada Foto</h3>
                    <p>Galeri ini tidak memiliki foto yang tersedia saat ini.</p>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="details-section py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="description-box">
                        <div class="description-header">
                            <h1><?= htmlspecialchars($row->gallery_title) ?></h1>
                            <div class="header-underline"></div>
                        </div>

                        <div class="description-content-wrapper">
                            <div class="description-content">
                                <?= nl2br(htmlspecialchars($row->gallery_description ?: 'Dokumentasi kegiatan ini menampilkan momen penting dalam program BKK SMKN 1 Purwosari.')) ?>
                            </div>
                        </div>

                        <div class="description-footer">
                            <p class="footer-text">Tertarik bergabung dengan program BKK kami?</p>
                            <a href="<?= site_url('contact') ?>" class="btn-primary-cta">
                                <i class="bi bi-chat-dots"></i> Hubungi Kami Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="info-header">
                            <i class="bi bi-info-circle"></i>
                            <h4>Informasi Kegiatan</h4>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-calendar-event"></i> Tanggal
                            </span>
                            <span class="info-value"><?= date('d F Y', strtotime($row->gallery_created_at)) ?></span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-images"></i> Total Foto
                            </span>
                            <span class="info-value"><?= $total_images ?> Gambar</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-tag"></i> Kategori
                            </span>
                            <span class="info-value">Dokumentasi BKK</span>
                        </div>

                        <div class="info-divider"></div>

                        <button class="btn-share-gallery">
                            <i class="bi bi-share"></i> Bagikan Galeri
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-premium-section">
        <div class="cta-pattern"></div>
        <div class="container">
            <div class="cta-content">
                <h2>Dapatkan Akses ke Peluang Kerja Eksklusif</h2>
                <p>Daftarkan diri Anda sekarang dan bergabung dengan ribuan lulusan kami yang telah sukses di industri.
                </p>
                <div class="cta-buttons">
                    <a href="<?= site_url('contact') ?>" class="btn-cta-primary">
                        <i class="bi bi-arrow-right"></i> Daftar Sekarang
                    </a>
                    <a href="<?= site_url('galeri') ?>" class="btn-cta-secondary">
                        <i class="bi bi-arrow-left"></i> Lihat Galeri Lain
                    </a>
                </div>
            </div>
        </div>
    </section>

    

<style>
    /* =================================================================
            CORE VARIABLES & RESET (sama dengan home.php)
            ================================================================= */
    :root {
        --primary: #0d6efd;
        --primary-dark: #0056b3;
        --secondary: #ffc107;
        --dark: #0f172a;
        --light: #f8fafc;
        --gray: #64748b;
        --gradient-blue: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
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
            HERO SECTION (BKK)
            ================================================================= */
    .hero-masterpiece {
        padding: 120px 0 60px;
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
        background-image: radial-gradient(at 0% 0%, rgba(13, 110, 253, 0.12) 0px, transparent 50%), radial-gradient(at 100% 100%, rgba(255, 193, 7, 0.08) 0px, transparent 50%);
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

    .shape-float {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.35;
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
        bottom: 8%;
        right: -50px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .badge-hero-animated {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 8px 20px;
        border-radius: 50px;
        color: var(--secondary);
        font-weight: 700;
    }

    .hero-title-main {
        font-size: 3.2rem;
        font-weight: 800;
        line-height: 1.1;
        margin: 1rem 0;
        background: linear-gradient(to right, #fff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-desc {
        color: rgba(255, 255, 255, 0.85);
        max-width: 760px;
        margin: 0 auto;
    }

    /* =================================================================
            GALLERY SLIDER (Responsif & Modern)
            ================================================================= */
    .gallery-slider-wrapper {
        position: relative;
        text-align: center;
        margin-bottom: 4rem;
    }

    .gallery-main-container {
        width: 100%;
        max-width: 900px;
        height: 500px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-card);
        position: relative;
    }

    .main-gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .gallery-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(13, 110, 253, 0.15);
        border: 2px solid var(--primary);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary);
        cursor: pointer;
        z-index: 15;
        transition: var(--transition-smooth);
    }

    .gallery-nav:hover {
        background: var(--primary);
        color: white;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.3);
    }

    .gallery-prev {
        left: 20px;
    }

    .gallery-next {
        right: 20px;
        left: auto;
    }

    .gallery-preview {
        position: absolute;
        top: 50%;
        width: 100px;
        height: 130px;
        transform: translateY(-50%);
        opacity: 0.6;
        cursor: pointer;
        z-index: 1;
        transition: opacity 0.3s;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-card);
    }

    .gallery-preview:hover {
        opacity: 1;
    }

    .gallery-prev-img {
        left: -130px;
    }

    .gallery-next-img {
        right: -130px;
    }

    .preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-counter {
        margin-top: 2rem;
        text-align: center;
        font-weight: 700;
        color: var(--dark);
        background: white;
        padding: 15px 25px;
        border-radius: 12px;
        display: inline-flex;
        gap: 10px;
        font-weight: 600;
        color: var(--dark);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        animation: slideUp 0.6s ease-out 0.3s backwards;
    }

    .counter-label {
        color: var(--gray);
        font-size: 0.875rem;
        letter-spacing: 1px;
        font-weight: 700;
    }

    .counter-display {
        color: var(--primary);
        font-size: 1.25rem;
        font-weight: 700;
    }

    /* THUMBNAILS SECTION */
    .thumbnails-section {
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    .section-title {
        font-size: 1.75rem;
        color: var(--dark);
        position: relative;
        padding-bottom: 15px;
        font-weight: 800;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--gradient-blue);
        border-radius: 2px;
    }

    .thumbnails-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 15px;
        animation: fadeIn 0.6s ease-out;
    }

    .thumbnail-item {
        position: relative;
        aspect-ratio: 1;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .thumbnail-item.active,
    .thumbnail-item:hover {
        border-color: var(--primary);
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .thumbnail-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .thumbnail-item:hover .thumbnail-img,
    .thumbnail-item.active .thumbnail-img {
        transform: scale(1.1);
    }

    .thumbnail-overlay {
        position: absolute;
        inset: 0;
        background: rgba(13, 110, 253, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .thumbnail-item:hover .thumbnail-overlay,
    .thumbnail-item.active .thumbnail-overlay {
        opacity: 1;
    }

    /* INFO CARD STYLES */
    .info-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: var(--shadow-card);
        border-left: 4px solid var(--primary);
        transition: var(--transition-smooth);
    }

    .info-card:hover {
        box-shadow: var(--shadow-hover);
    }

    .info-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    .info-header i {
        font-size: 28px;
        color: var(--primary);
    }

    .info-header h4 {
        font-size: 1.25rem;
        color: var(--dark);
        margin: 0;
        font-weight: 700;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 15px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-of-type {
        border-bottom: none;
    }

    .info-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        color: var(--gray);
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .info-label i {
        color: var(--primary);
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
    }

    .info-divider {
        height: 2px;
        background: linear-gradient(to right, var(--primary) 0%, transparent 100%);
        margin: 20px 0;
    }

    .btn-share-gallery {
        width: 100%;
        padding: 14px 20px;
        background: var(--light);
        border: 2px solid var(--primary);
        color: var(--primary);
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: var(--transition-smooth);
    }

    .btn-share-gallery:hover {
        background: var(--primary);
        color: white;
    }

    /* CTA PREMIUM SECTION */
    .cta-premium-section {
        position: relative;
        padding: 80px 0;
        background: var(--dark);
        overflow: hidden;
        margin-top: 60px;
    }

    .cta-pattern {
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(13, 110, 253, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 193, 7, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }

    .cta-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        animation: slideUp 0.8s ease-out;
    }

    .cta-content h2 {
        font-size: clamp(1.75rem, 4vw, 2.75rem);
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }

    .cta-content p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-cta-primary,
    .btn-cta-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: var(--transition-smooth);
        border: none;
    }

    .btn-cta-primary {
        background: var(--gradient-blue);
        color: white;
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
    }

    .btn-cta-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(13, 110, 253, 0.4);
        color: white;
    }

    .btn-cta-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-cta-secondary:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: white;
    }

    /* BACK BUTTON */
    .btn-back-simple {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        color: var(--primary);
        text-decoration: none;
        border: 2px solid var(--primary);
        border-radius: 12px;
        font-weight: 700;
        transition: var(--transition-smooth);
        cursor: pointer;
    }

    .btn-back-simple:hover {
        background: var(--primary);
        color: white;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media(max-width: 768px) {
        .thumbnails-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 12px;
        }

        .info-card {
            padding: 25px;
        }

        .btn-cta-primary,
        .btn-cta-secondary {
            width: 100%;
            justify-content: center;
            padding: 12px 20px;
            font-size: 0.95rem;
        }

        .cta-premium-section {
            padding: 60px 0;
            margin-top: 40px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = <?= $js_images ?>;
        if (images.length === 0) return;

        let currentIndex = 0;
        const totalImages = images.length;
        const mainImage = document.getElementById("mainImage");
        const prevImage = document.getElementById("prevImage");
        const nextImage = document.getElementById("nextImage");
        const currentText = document.getElementById("currentIndex");
        const overlay = document.getElementById("imageLoadingOverlay");
        const thumbnails = document.querySelectorAll('.thumbnail-item');

        const getImageUrl = (image) => "<?= base_url('assets/gallery/') ?>" + image;

        // Fungsi untuk memperbarui semua elemen galeri
        const updateGallery = () => {
            // 1. Tampilkan overlay loading
            overlay.style.opacity = '1';
            overlay.style.display = 'flex';

            // 2. Hitung index preview
            const prevIndex = (currentIndex - 1 + totalImages) % totalImages;
            const nextIndex = (currentIndex + 1) % totalImages;

            prevImage.src = getImageUrl(images[prevIndex]);
            nextImage.src = getImageUrl(images[nextIndex]);

            // 3. Update gambar utama
            mainImage.onload = () => {
                overlay.style.opacity = '0';
                setTimeout(() => overlay.style.display = 'none', 300);
            };
            mainImage.onerror = mainImage.onload; // Handle error case gracefully
            mainImage.src = getImageUrl(images[currentIndex]);

            // 4. Update teks counter
            currentText.textContent = currentIndex + 1;

            // 5. Update kelas aktif pada thumbnail
            thumbnails.forEach((t, i) => {
                if (i === currentIndex) {
                    t.classList.add('active');
                } else {
                    t.classList.remove('active');
                }
            });
        };

        // Event Listeners untuk Navigasi Utama
        document.querySelector(".gallery-prev").addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            updateGallery();
        });

        document.querySelector(".gallery-next").addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % totalImages;
            updateGallery();
        });

        // Event Listeners untuk Klik pada Preview Kiri/Kanan
        document.querySelector(".gallery-prev-img").addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            updateGallery();
        });

        document.querySelector(".gallery-next-img").addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % totalImages;
            updateGallery();
        });

        // Event Listener untuk Klik Thumbnail
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                currentIndex = index;
                updateGallery();
            });
        });

        // Set thumbnail pertama aktif saat load
        if (thumbnails.length > 0) {
            thumbnails[0].classList.add('active');
        }

        // Keyboard Navigation (Panah Kiri/Kanan)
        document.addEventListener('keydown', (e) => {
            // Cek apakah user tidak sedang mengetik di input form
            if (e.target.tagName.toLowerCase() !== 'input' && e.target.tagName.toLowerCase() !== 'textarea') {
                if (e.key === 'ArrowLeft') {
                    currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                    updateGallery();
                } else if (e.key === 'ArrowRight') {
                    currentIndex = (currentIndex + 1) % totalImages;
                    updateGallery();
                }
            }
        });

        // Inisialisasi awal
        updateGallery();
    });
</script>