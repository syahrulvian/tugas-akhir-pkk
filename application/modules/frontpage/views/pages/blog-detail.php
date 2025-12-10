<?php
// === METADATA ===
// Menggunakan data blog yang ada untuk metadata
$this->template->title->set($blog->blog_judul);
$this->template->description->set(substr(htmlspecialchars($blog->blog_desc), 0, 100));
$this->template->keywords->set(str_replace('-', ', ', $blog->blog_alias));

// LOGIKA QUERY PHP
$recent_blog = $this->db
    ->order_by('blog_date', 'DESC')
    ->limit(5)
    ->get('tb_blog')
    ->result();
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

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Outfit', sans-serif;
    }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    .news-hero-card {
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        height: 450px; /* Diperbarui dari 420px */
        box-shadow: var(--shadow-card);
        border: 1px solid rgba(0, 0, 0, 0.05); /* Ditambahkan */
        margin-bottom: 30px; /* Ditambahkan */
    }
    .news-hero-img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.6s ease;
    }
    .news-hero-card:hover .news-hero-img {
        transform: scale(1.03); /* Hover effect diperbarui */
    }

    .news-hero-overlay {
        position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.25) 50%, rgba(0,0,0,0) 100%); /* Overlay diperbarui */
        display: flex; align-items: flex-end; padding: 36px; /* Padding diperbarui */
    }

    .news-title-link {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: #fff; /* Warna untuk hero */
        text-decoration: none;
        transition: color 0.3s;
        line-height: 1.4;
        display: block;
    }
    .news-title-link:hover { color: #e6f0ff; } /* Hover color diperbarui */

    /* Recent Post Widget (Disamakan dengan gaya BKK) */
    .recent-post-widget {
        display: flex; /* Mengubah menjadi flex untuk layout berdampingan */
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
        border-radius: 12px;
        padding: 10px; /* Padding sedikit lebih besar */
    }

    .recent-post-widget:hover {
        background-color: #f0f4f8; /* Warna hover baru */
        transform: translateY(-2px); /* Efek hover baru */
    }

    .recent-post-img img {
        width: 80px;
        height: 65px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .recent-post-content {
        flex: 1;
        line-height: 1.3;
    }
    .recent-post-content a {
        font-size: 13px;
        color: var(--gray);
        display: block;
        margin-bottom: 3px;
        text-decoration: none;
        transition: color 0.3s;
    }
    .recent-post-content a:hover {
        color: var(--primary);
    }
    .recent-post-content h6 a {
        font-weight: 600;
        color: var(--dark);
        font-size: 16px; /* Ukuran yang lebih wajar */
    }

    /* Styling untuk Content Blog Detail */
    .blog-content-detail h2 {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .blog-content-detail p {
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 1rem;
        color: #333;
    }
    
    .blog-content-detail .lead {
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--dark);
    }

    .blog-content-detail .line-break {
        display: none; /* Menyembunyikan elemen pemisah yang berlebihan */
    }
    
    .blog-image-wrapper {
        margin: 30px 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-card);
    }

    .blog-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .blog-image-wrapper span {
        display: block;
        text-align: center;
        font-style: italic;
        color: var(--gray);
        font-size: 0.9rem;
        padding: 10px 0;
        background-color: #f1f5f9;
        border-top: 1px solid #e2e8f0;
    }

    /* Blockquote Styling */
    blockquote {
        margin: 30px 0;
        padding: 30px;
        background-color: #f8f9fa;
        border-left: 5px solid var(--primary);
        position: relative;
        font-style: italic;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    blockquote svg:first-child {
        display: none; /* Menyembunyikan SVG lama */
    }
    
    blockquote .quote {
        position: absolute;
        top: 15px;
        right: 20px;
        opacity: 0.1;
        width: 80px;
        height: auto;
    }
    
    blockquote .content p {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #1f2937;
        margin-bottom: 0;
    }

    blockquote .content p strong,
    blockquote .content p b {
        font-size: 1.3rem;
        font-weight: 700;
    }

    /* Tag & Social Area */
    .tag-and-social-area {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-top: 1px solid #eee;
        margin-top: 30px;
    }

    .tag-area, .social-area {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .tag-area h6, .social-area h6 {
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0;
    }

    .tag-list, .social-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 10px;
    }

    .tag-list a {
        display: inline-block;
        background-color: #e2e8f0;
        color: var(--dark);
        padding: 5px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .tag-list a:hover {
        background-color: var(--primary);
        color: #fff;
    }

    .social-list a {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid #e2e8f0;
        color: var(--gray);
        font-size: 1.2rem;
        transition: 0.3s;
    }

    .social-list a:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }
    
    /* Sidebar styling dari BKK */
    .blog-sidebar-area {
        padding-top: 30px;
    }

    .search-widget form {
        position: relative;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        border-radius: 20px;
        padding-left: 40px;
        padding-right: 15px;
        height: 45px;
        border: 1px solid #e2e8f0;
    }
    
    .search-box svg {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }
    
    .single-widget {
        background-color: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: var(--shadow-card);
        border: 1px solid #e2e8f0;
    }
    
    .widget-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        border-bottom: 2px solid var(--primary);
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--dark);
    }
    
    .widget-title svg {
        fill: var(--primary);
    }
</style>

<section class="py-5" style="background-color: var(--light)">
    <div class="container mt-5 pt-4">

        <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-down">
            <div>
                <ul class="breadcrumb-list list-unstyled d-flex gap-2 mb-0">
                    <li><a href="<?= site_url('home') ?>" class="text-muted text-decoration-none small">Home</a></li>
                    <li class="text-muted small">/</li>
                    <li><a href="<?= site_url('blog') ?>" class="text-muted text-decoration-none small">Blog</a></li>
                    <li class="text-muted small">/</li>
                    <li class="text-primary small fw-bold"><?= $blog->blog_judul ?></li>
                </ul>
            </div>
        </div>

        <div class="mb-5" data-aos="zoom-in" data-aos-duration="800">
            <div class="news-hero-card">
                <img src="<?= base_url('assets/blog/' . $blog->blog_img) ?>" class="news-hero-img"
                    alt="<?= htmlspecialchars($blog->blog_judul) ?>" />
                <div class="news-hero-overlay">
                    <div data-aos="fade-up" data-aos-delay="200">
                        <span class="badge bg-danger mb-3 px-3 py-2 rounded-pill">Artikel</span>
                        <h1 class="fw-bold text-white display-5 mb-3">
                            <a class="news-title-link"
                                href="<?= site_url('blog/' . ($blog->blog_alias ?? ($blog->blog_code ?? ''))) ?>"><?= htmlspecialchars($blog->blog_judul) ?></a>
                        </h1>
                        <div class="d-flex align-items-center">
                            <small class="text-white-50 me-3"><i class="far fa-clock me-1"></i>
                                <?= date('d F Y', strtotime($blog->blog_date)) ?></small>
                            <small class="text-white-50"><i class="fas fa-user-circle me-1"></i>
                                Penulis</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="inspiration-details-page pt-3 mb-100">
    <div class="container">
        <div class="row g-lg-5 gy-5 justify-content-between">
            <div class="col-xl-8 col-lg-8">
                <div class="blog-content-detail">
                    <h2 class="mb-3"><?= $blog->blog_judul ?></h2>
                    
                    <p class="lead mb-4"><?= $blog->blog_desc ?></p>
                    
                    <div class="blog-image-wrapper">
                        <img src="<?= base_url('assets/blog/' . $blog->blog_img) ?>" alt="<?= htmlspecialchars($blog->blog_judul) ?>">
                        
                    </div>

                    <blockquote>
                        <svg class="quote" width="100" height="74" viewBox="0 0 100 74" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M76.0844 0.333984C62.1979 0.333984 52.1722 11.7089 52.1722 28.5534C52.2591 53.0243 70.802 70.326 97.5533 73.6474C100.031 73.958 100.988 70.5417 98.7054 69.5366C88.4449 65.0074 83.2581 59.2617 82.5886 53.5764C82.0886 49.3275 84.4146 45.6049 87.3406 44.9061C94.9186 43.0987 99.9967 33.734 99.9967 24.0586C99.9967 17.7665 97.4774 11.732 92.993 7.28277C88.5086 2.83354 82.4264 0.333984 76.0844 0.333984ZM23.9123 0.333984C10.0258 0.333984 0 11.7089 0 28.5534C0.0869522 53.0243 18.6298 70.326 45.3811 73.6474C47.8593 73.958 48.8158 70.5417 46.5333 69.5366C36.2727 65.0074 31.0859 59.2617 30.4164 53.5764C29.9164 49.3275 32.2424 45.6049 35.1684 44.9061C42.7464 43.0987 47.8245 33.734 47.8245 24.0586C47.8245 17.7665 45.3052 11.732 40.8208 7.28277C36.3364 2.83354 30.2542 0.333984 23.9123 0.333984Z"
                                fill="#F0F0F0" />
                        </svg>
                        <div class="content">
                            <p><?= $blog->blog_content ?></p>
                        </div>
                    </blockquote>
                    
                    <p><?= $blog->blog_desc ?></p> <div class="tag-and-social-area">
                        <div class="tag-area">
                            <h6><i class="fas fa-tags me-1"></i> Tag:</h6>
                            <ul class="tag-list">
                                <?php
                                $tags_string = $blog->blog_alias;
                                $tags_array = explode('-', $tags_string);
                                foreach ($tags_array as $tag):
                                ?>
                                <li><a href="<?= site_url('tag/' . $tag) ?>"><?= ucfirst($tag) ?></a></li>
                                <?php endforeach; ?>
                                <li><a href="#">Custom</a></li>
                                <li><a href="#">Responsive</a></li>
                            </ul>
                        </div>
                        <div class="social-area">
                            <h6><i class="fas fa-share-alt me-1"></i> Share:</h6>
                            <ul class="social-list">
                                <li><a
                                        href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(site_url('blog/' . ($blog->blog_alias ?? ($blog->blog_code ?? '')))) ?>"
                                        target="_blank"><i class="bx bxl-facebook"></i></a></li>
                                <li><a
                                        href="https://twitter.com/intent/tweet?text=<?= urlencode($blog->blog_judul) ?>&url=<?= urlencode(site_url('blog/' . ($blog->blog_alias ?? ($blog->blog_code ?? '')))) ?>"
                                        target="_blank"><i class="bx bxl-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/alamkarangsewu?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i
                                            class="bx bxl-instagram-alt"></i></a></li>
                                <li><a
                                        href="https://api.whatsapp.com/send?text=Lihat artikel ini: <?= urlencode($blog->blog_judul . ' ' . site_url('blog/' . ($blog->blog_alias ?? ($blog->blog_code ?? '')))) ?>"
                                        target="_blank"><i class="bx bxl-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="blog-sidebar-area">
                    
                    <div class="search-widget mb-40">
                        <form action="<?= site_url('blog/search') ?>" method="GET">
                            <div class="search-box">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.8044 14.8845L13.0544 12.197L12.9901 12.0992C12.8689 11.9797 12.7055 11.9127 12.5354 11.9127C12.3652 11.9127 12.2018 11.9797 12.0807 12.0992C9.74349 14.2433 6.14318 14.3595 3.66568 12.3714C1.18818 10.3833 0.604738 6.90545 2.30068 4.24732C3.99661 1.5892 7.44661 0.572634 10.3632 1.87232C13.2797 3.17201 14.7551 6.38638 13.8126 9.38138C13.7793 9.48804 13.7754 9.60167 13.8012 9.71037C13.827 9.81907 13.8815 9.91883 13.9591 9.9992C14.0375 10.081 14.1358 10.1411 14.2444 10.1736C14.3529 10.2061 14.468 10.21 14.5785 10.1848C14.6884 10.1606 14.79 10.108 14.8732 10.0322C14.9564 9.95643 15.0183 9.86013 15.0526 9.75295C16.1776 6.19888 14.4782 2.37388 11.0526 0.752946C7.62693 -0.867991 3.50474 0.199821 1.3513 3.26763C-0.802137 6.33545 -0.339949 10.4808 2.43911 13.0229C5.21818 15.5651 9.47974 15.7398 12.4688 13.4367L14.9038 15.8173C15.026 15.9348 15.189 16.0004 15.3585 16.0004C15.528 16.0004 15.6909 15.9348 15.8132 15.8173C15.8728 15.7589 15.9202 15.6892 15.9525 15.6123C15.9849 15.5353 16.0016 15.4527 16.0016 15.3692C16.0016 15.2857 15.9849 15.2031 15.9525 15.1261C15.9202 15.0492 15.8728 14.9795 15.8132 14.9211L15.8044 14.8845Z"
                                        fill="#110F0F" />
                                </svg>
                                <input type="text" placeholder="Cari Blog..." name="q">
                            </div>
                        </form>
                    </div>

                    <div class="single-widget mb-30">
                        <h5 class="widget-title">
                            <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.9688 11C20.9726 12.1773 20.9019 13.3538 20.7569 14.5221C20.1691 19.1327 18.5625 20.9688 18.5625 20.9688H1.03125V18.9062C14.1316 17.7671 11.6596 7.89809 10.4264 4.54609C10.1607 4.50672 9.89326 4.48091 9.625 4.46875C9.625 4.46875 4.46875 4.125 4.8125 8.25C4.8125 8.25 2.0625 7.5625 2.75 4.8125C3.4375 2.0625 6.1875 2.75 6.1875 2.75C6.1875 2.75 6.875 1.03125 9.28125 1.03125C11.6875 1.03125 12.7188 3.09375 12.7188 3.09375C14.4375 1.03125 20.9688 3.78125 20.9688 11Z" />
                            </svg>
                            Postingan Terbaru
                        </h5>

                        <?php if (!empty($recent_blog)): ?>
                            <?php $recent_blog_limit = array_slice($recent_blog, 0, 4); // Batasi hanya 4 post ?>
                            <?php foreach ($recent_blog_limit as $blogg): ?>
                                <div class="recent-post-widget mb-3">
                                    <div class="recent-post-img">
                                        <a href="<?= site_url('blog-detail/' . $blogg->blog_alias) ?>">
                                    <img src="<?= base_url('assets/blog/' . $blogg->blog_img) ?>" class="news-thumb-img">
                                </a>
                                    </div>
                                    <div class="recent-post-content">
                                        <a
                                            href="<?= site_url('blog/' . ($blogg->blog_alias ?? ($blogg->blog_code ?? ''))) ?>"><?= date('d F, Y', strtotime($blogg->blog_date)); ?></a>
                                        <h6>
                                            <a
                                                href="<?= site_url('blog/' . ($blogg->blog_alias ?? ($blogg->blog_code ?? ''))) ?>"><?= htmlspecialchars($blogg->blog_judul); ?></a>
                                        </h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">Belum ada post terbaru.</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="single-widget mb-30">
                        <h5 class="widget-title">
                            <i class="fas fa-folder-open me-1"></i>
                            Kategori Populer
                        </h5>
                        <a href="#" class="cat-link">
                            <i class="fas fa-school me-2 opacity-50"></i> Informasi BKK
                            <span class="cat-count">45</span>
                        </a>
                        <a href="#" class="cat-link">
                            <i class="fas fa-briefcase me-2 opacity-50"></i> Lowongan Kerja
                            <span class="cat-count">32</span>
                        </a>
                        <a href="#" class="cat-link">
                            <i class="fas fa-users me-2 opacity-50"></i> Kegiatan Siswa
                            <span class="cat-count">28</span>
                        </a>
                        <a href="#" class="cat-link">
                            <i class="fas fa-bullhorn me-2 opacity-50"></i> Pengumuman Resmi
                            <span class="cat-count">15</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>