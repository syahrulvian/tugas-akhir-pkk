<?php
// === METADATA DARI Halaman 1 ===
$this->template->title->set('BKK SMKN 1 Purwosari – Informasi, Berita & Kegiatan');
$this->template->description->set('Dapatkan informasi terbaru, kegiatan, berita, dan update resmi dari BKK SMKN 1 Purwosari.');
$this->template->keywords->set('BKK SMKN 1 Purwosari, BKK SMK, Bursa Kerja Khusus, lowongan kerja, info BKK, kegiatan SMK');

// LOGIKA QUERY PHP DARI Halaman 1 (Dipindahkan ke atas untuk eksekusi)
$limit  = 9;
$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
$no     = $offset + 1;

$this->db->order_by('blog_date', 'desc');
$get_blog = $this->db->get('tb_blog', $limit, $offset);
$blog_posts = $get_blog->result();
$gettotals = $this->db->get('tb_blog')->num_rows();

// Ambil postingan pertama untuk Hero Section
$first_post = !empty($blog_posts) ? $blog_posts[0] : null;
$other_posts = !empty($blog_posts) ? array_slice($blog_posts, 1) : [];
$recent_posts = $this->db->order_by('blog_date', 'DESC')->limit(4)->get('tb_blog')->result();

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

    /* Scrollbar */
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

    .news-hero-card {
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        height: 450px;
        box-shadow: var(--shadow-card);
    }

    .news-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .news-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0) 100%);
        display: flex;
        align-items: flex-end;
        padding: 30px;
    }

    .news-item-card {
        border-radius: 16px;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #e2e8f0;
        transition: var(--transition-smooth);
    }

    .news-item-card:hover {
        box-shadow: var(--shadow-hover);
        border-color: var(--primary);
    }

    .news-thumb-wrapper {
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 16/10;
        height: 100%;
    }

    .news-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .news-item-card:hover .news-thumb-img {
        transform: scale(1.05);
    }

    .news-title-link {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--dark);
        text-decoration: none;
        transition: color 0.3s;
        line-height: 1.4;
        display: block;
    }

    .news-title-link:hover {
        color: var(--primary);
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        padding-top: 30px;
    }

    .pagination-wrapper ul {
        display: flex;
        list-style: none;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: var(--shadow-card);
    }

    .pagination-wrapper ul li a,
    .pagination-wrapper ul li span {
        padding: 8px 16px;
        text-decoration: none;
        display: block;
        color: var(--dark);
        font-weight: 500;
    }

    .pagination-wrapper ul li.active a {
        background-color: var(--primary);
        color: #fff;
    }

    .cat-link {
        padding: 8px 0;
        color: var(--dark);
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
    }

    .cat-link:hover {
        color: var(--primary);
    }

    .cat-count {
        background-color: #f1f5f9;
        color: var(--gray);
        padding: 2px 8px;
        border-radius: 12px;
    }
</style>

<section class="py-5" style="background-color: var(--light)">
    <div class="container mt-5 pt-4">

        <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-down">
            <div>
                <span class="text-primary fw-bold text-uppercase ls-2 small">Berita / Kegiatan</span>
                <h2 class="fw-bold display-6 text-dark mb-0">BKK SMKN 1 Purwosari</h2>
            </div>
        </div>

        <?php if ($first_post): ?>
            <div class="mb-5" data-aos="zoom-in" data-aos-duration="800">
                <div class="news-hero-card">
                    <img src="<?php echo base_url('assets/blog/' . $first_post->blog_img) ?>" class="news-hero-img">

                    <div class="news-hero-overlay">
                        <div data-aos="fade-up" data-aos-delay="200">
                            <span class="badge bg-danger mb-3 px-3 py-2 rounded-pill">🔥 FEATURED</span>
                            <h1 class="fw-bold text-white display-5 mb-3">
                                <?= $first_post->blog_judul ?>
                            </h1>
                            <p class="text-white-50 lead mb-4 d-none d-lg-block">
                                <?= substr(strip_tags($first_post->blog_desc), 0, 150) ?>...
                            </p>
                            <a href="<?= site_url('blog-detail/' . $first_post->blog_alias) ?>" class="btn btn-light text-dark fw-bold rounded-pill px-4 py-2 shadow-lg">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row g-5">
            <div class="col-lg-8">
                <h4 class="fw-bold mb-4 pb-2 border-bottom">Postingan Terbaru</h4>

                <?php
                $delay = 0;
                foreach ($other_posts as $rowsss) {
                    $delay += 100;
                ?>
                    <div class="news-item-card mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-4">
                                <div class="news-thumb-wrapper">
                                    <a href="<?= site_url('blog-detail/' . $rowsss->blog_alias) ?>">
                                        <img src="<?= base_url('assets/blog/' . $rowsss->blog_img) ?>" class="news-thumb-img">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="pe-md-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill me-2">BKK SMKN 1 PURWOSARI</span>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> <?= date('d F Y', strtotime($rowsss->blog_date)) ?></small>
                                    </div>

                                    <a href="<?= site_url('blog-detail/' . $rowsss->blog_alias) ?>" class="news-title-link h4 mb-2">
                                        <?= $rowsss->blog_judul ?>
                                    </a>

                                    <p class="text-muted small mb-0 line-clamp-2">
                                        <?= substr(strip_tags($rowsss->blog_desc), 0, 100) ?>...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <div class="pagination-wrapper">
                    <?php
                    if (isset($this->paginationmodel)) {
                        echo $this->paginationmodel->paginate('blog', $gettotals, $limit);
                    }
                    ?>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <div class="bg-white p-4 rounded-4 shadow-sm mb-4 border">
                    <h5 class="fw-bold mb-3">Cari Blog</h5>
                    <div class="position-relative">
                        <input type="text" class="form-control rounded-pill ps-4 py-2 bg-light border-0" placeholder="Cari...">
                        <button class="btn btn-primary position-absolute end-0 top-0 rounded-pill m-1 py-1 px-3">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-4 shadow-sm border">
                    <h5 class="fw-bold mb-4">Recent Post</h5>

                    <?php foreach ($recent_posts as $rp): ?>
                        <a href="<?= site_url('blog-detail/' . $rp->blog_alias) ?>" class="d-flex mb-3 text-decoration-none">
                            <div style="width: 70px; height: 60px; border-radius: 10px; overflow: hidden; margin-right: 12px;">
                                <img src="<?= base_url('assets/blog/' . $rp->blog_img) ?>"
                                    style="width:100%; height:100%; object-fit:cover;">
                            </div>

                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-dark mb-1 line-clamp-2" style="font-size: 15px;">
                                    <?= $rp->blog_judul ?>
                                </h6>
                                <small class="text-muted">
                                    <i class="far fa-clock me-1"></i>
                                    <?= date('d M Y', strtotime($rp->blog_date)) ?>
                                </small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</section>