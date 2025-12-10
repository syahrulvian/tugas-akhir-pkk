<?php
// Asumsi ini adalah Controller atau file View di CodeIgniter 3

// --- 1. AMBIL DATA TESTIMONI ---
$limit = 15;
// Menggunakan $this->input->get('page', TRUE) untuk keamanan (XSS filtering)
$offset_page = $this->input->get('page', TRUE) ? (int)$this->input->get('page', TRUE) : 0;
$no = $offset_page + 1; // Untuk nomor urut jika diperlukan

// Check if tb_testimoni table exists and fetch data
$testimoni_table_exists = $this->db->table_exists('tb_testimoni');

$testimoni_data = [];
$total_testimoni = 0;

if ($testimoni_table_exists) {
    // Ambil data testimoni dengan limit dan offset
    $this->db->order_by('testimoni_date', 'DESC');
    $get_data_query = $this->db->get('tb_testimoni', $limit, $offset_page);
    $testimoni_data = $get_data_query->result();

    // Ambil total baris (untuk pagination)
    $total_testimoni = $this->db->count_all('tb_testimoni');
} else {
    // Jika tabel tidak ada, data tetap array kosong dan total 0
    $testimoni_data = [];
    $total_testimoni = 0;
}

// --- 2. AMBIL DATA MITRA ---
// Menggunakan $this->db->get() dengan parameter for cleaner query building
$this->db->select('tb_mitra.*, tb_kategori_mitra.kategori_mitra_nama');
$this->db->from('tb_mitra');
$this->db->join('tb_kategori_mitra', 'tb_kategori_mitra.kategori_mitra_id = tb_mitra.kategori_mitra_id', 'left');
$this->db->order_by('tb_mitra.created_at', 'DESC');
$mitra_data = $this->db->get()->result();

// Untuk keperluan slider/marquee, kita gandakan data mitra (agar terlihat mulus)
$mitra_marquee_data = array_merge($mitra_data, $mitra_data);

// --- 3. AMBIL DATA KATEGORI (Baru) ---
$this->db->order_by('kategori_mitra_nama', 'ASC');
$kategori_data = $this->db->get('tb_kategori_mitra')->result();

// Variabel untuk statistik
$stats = [
    ['num' => '92%', 'label' => 'Serapan Alumni'],
    ['num' => '50+', 'label' => 'Mitra Industri'],
    ['num' => '1.5k+', 'label' => 'Alumni Sukses'],
    ['num' => '20Th', 'label' => 'Pengalaman BKK'],
];
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* --- CSS KHUSUS TESTIMONI (ULTRA MODERN PROFESSIONAL DESIGN) --- */
    :root {
        --corp-blue: #0f62fe;
        /* IBM Blue Style */
        --corp-dark: #020617;
        --corp-gray: #475569;
        --accent-gradient: linear-gradient(135deg, #0f62fe 0%, #0043ce 100%);
        --bg-light: #f8fafc;
        --surface-white: #ffffff;
        --shadow-soft: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 20px 60px -15px rgba(15, 98, 254, 0.25);
        --border-light: #e2e8f0;
    }

    body {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: var(--bg-light);
        overflow-x: hidden;
        color: var(--corp-dark);
        -webkit-font-smoothing: antialiased;
    }

    /* 1. MAIN SECTION */
    .testi-pro-section {
        padding: 7rem 0 5rem;
        background-color: #f1f5f9;
        /* Modern Grid Pattern Background */
        background-image:
            linear-gradient(rgba(15, 98, 254, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 98, 254, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        position: relative;
    }

    /* Efek Glow di Background */
    .testi-pro-section::before {
        content: '';
        position: absolute;
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 300px;
        background: radial-gradient(circle, rgba(15, 98, 254, 0.08) 0%, transparent 70%);
        z-index: 0;
        pointer-events: none;
    }

    /* Header Styling */
    .section-heading-pro {
        color: var(--corp-dark);
        font-weight: 800;
        letter-spacing: -1.5px;
        font-size: clamp(2rem, 5vw, 3rem);
        /* Responsif Font */
        position: relative;
        display: inline-block;
    }

    .section-subheading-pro {
        color: var(--corp-gray);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* 2. CARD DESAIN (GLASSMOPRHISM FEEL) */
    .testi-card-pro {
        background: var(--surface-white);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        /* text-align: center;  <-- Hapus atau abaikan ini jika ingin rata kiri */
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: var(--shadow-soft);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;

        /* TAMBAHAN WAJIB AGAR CENTER VERTIKAL */
        display: flex;
        flex-direction: column;
    }

    /* --- CLASS BARU: PENYEIMBANG TEKS --- */
    .testi-content-wrapper {
        flex: 1;
        /* Ini kuncinya! Dia akan memakan sisa ruang kosong */
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Membuat teks selalu di TENGAH (Atas-Bawah) */
        /* align-items: center; */
        /* Aktifkan ini jika ingin teks rata tengah Kiri-Kanan juga */
    }

    .testi-card-pro::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--accent-gradient);
        opacity: 0;
        transition: 0.4s;
    }

    .testi-card-pro:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-hover);
    }

    .testi-card-pro:hover::before {
        opacity: 1;
    }

    /* Icon Kutip Background */
    .quote-icon-bg {
        position: absolute;
        top: 20px;
        right: 25px;
        font-size: 5rem;
        background: linear-gradient(180deg, #e2e8f0 0%, rgba(255, 255, 255, 0) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        opacity: 0.6;
        pointer-events: none;
        transition: 0.5s;
    }

    .testi-card-pro:hover .quote-icon-bg {
        transform: scale(1.1) rotate(5deg);
        opacity: 0.8;
    }

    /* User Profile */
    .user-header-pro {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 1.5rem;
        /* Kurangi margin sedikit agar pas */
        text-align: left;
        position: relative;
        z-index: 2;
    }

    .user-img-pro {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--surface-white);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
        transition: 0.3s;
    }

    .testi-card-pro:hover .user-img-pro {
        transform: scale(1.05);
        border-color: #e0e7ff;
    }

    .user-details h5 {
        font-weight: 800;
        font-size: 1.1rem;
        margin: 0;
        color: var(--corp-dark);
        letter-spacing: -0.5px;
    }

    /* Badge Perusahaan */
    .company-badge-pro {
        display: inline-block;
        font-size: 0.75rem;
        background: #eff6ff;
        color: var(--corp-blue);
        padding: 6px 14px;
        border-radius: 100px;
        margin-top: 6px;
        font-weight: 700;
        letter-spacing: 0.3px;
        border: 1px solid rgba(15, 98, 254, 0.1);
    }

    .quote-text-pro {
        color: var(--corp-gray);
        font-size: 1.05rem;
        line-height: 1.7;
        font-style: italic;
        margin-bottom: 0;
        font-weight: 500;
        text-align: left;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        /* Limit baris agar rapi */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* 3. SECTION STATISTIK */
    .stats-section-pro {
        background: var(--surface-white);
        padding: 5rem 0;
        border-top: 1px solid var(--border-light);
        border-bottom: 1px solid var(--border-light);
    }

    .stat-item-pro {
        text-align: center;
        padding: 1.5rem;
        transition: 0.3s;
    }

    .stat-item-pro:hover {
        transform: translateY(-5px);
    }

    .stat-num-pro {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 800;
        /* Gradient Text */
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: block;
        line-height: 1;
        margin-bottom: 0.5rem;
        letter-spacing: -2px;
    }

    .stat-label-pro {
        color: #64748b;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* 4. SECTION MITRA (MARQUEE) */
    .partners-section-pro {
        padding: 5rem 0;
        background: #f8fafc;
        text-align: center;
    }

    /* Container Marquee dengan Fade Effect Kiri Kanan */
    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        padding: 2rem 0;
        position: relative;
    }

    /* Efek Fade Out di kiri dan kanan */
    .marquee-container::before,
    .marquee-container::after {
        content: "";
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .marquee-container::before {
        left: 0;
        background: linear-gradient(to right, #ffffff, transparent);
    }

    .marquee-container::after {
        right: 0;
        background: linear-gradient(to left, #ffffff, transparent);
    }

    .marquee-content {
        display: inline-block;
        animation: marquee-scroll 40s linear infinite;
    }

    .marquee-content:hover {
        animation-play-state: paused;
    }

    .marquee-item {
        display: inline-block;
        padding: 0 40px;
        vertical-align: middle;
    }

    .marquee-item img {
        height: 45px;
        /* Sedikit lebih kecil agar elegan */
        width: auto;
        object-fit: contain;
        filter: grayscale(100%) opacity(0.5);
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .marquee-item img:hover {
        filter: grayscale(0%) opacity(1);
        transform: scale(1.1);
    }

    @keyframes marquee-scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* --- SLIDER ANIMATION CSS --- */
    .slider-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        padding: 40px 0;
        /* Masking agar slider terlihat menghilang halus di pinggir */
        mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    }

    .slider-track {
        display: flex;
        gap: 30px;
        width: max-content;
        /* Animation duration diatur via JS, tapi default disini */
        animation: scroll 40s linear infinite;
        cursor: grab;
    }

    .slider-track:active {
        cursor: grabbing;
    }

    .slider-track:hover {
        animation-play-state: paused;
    }

    .slider-item {
        width: 400px;
        flex-shrink: 0;
        padding: 10px;
        /* Space for shadow */
    }

    /* BUTTON STYLING (CTA) */
    .btn-cta-glow {
        background: var(--corp-blue);
        color: white;
        padding: 16px 40px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        box-shadow: 0 10px 25px rgba(15, 98, 254, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }

    .btn-cta-glow:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(15, 98, 254, 0.5);
        background: #0043ce;
        color: white;
    }

    /* RESPONSIVE FIXES */
    @media (max-width: 991px) {
        .testi-pro-section {
            padding: 5rem 0 3rem;
        }

        .slider-item {
            width: 350px;
        }

        .stat-num-pro {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 767px) {
        .section-heading-pro {
            font-size: 2rem;
        }

        .section-subheading-pro {
            font-size: 1rem;
        }

        .testi-card-pro {
            padding: 2rem;
            border-radius: 20px;
        }

        .quote-icon-bg {
            font-size: 3rem;
        }

        /* Layout Stat di HP */
        .stat-item-pro {
            margin-bottom: 1rem;
        }

        .stat-num-pro {
            font-size: 2rem;
        }

        .stat-label-pro {
            font-size: 0.8rem;
        }

        .marquee-container::before,
        .marquee-container::after {
            width: 50px;
        }

        /* Kurangi lebar fade di HP */
        .slider-item {
            width: 300px;
        }
    }

    /* Animation Keyframes placeholder - updated by JS */
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-25%);
        }

        /* Hanya geser 1/4 karena data ada 4 set */
    }
</style>

<section class="testi-pro-section">
    <div class="container position-relative z-1">
        <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000">
            <h2 class="section-heading-pro mb-3">
                Kisah Sukses Alumni
            </h2>
            <p class="section-subheading-pro">
                Bukti nyata komitmen BKK dalam mengantarkan lulusan menuju karir
                impian di perusahaan terkemuka.
            </p>
        </div>

        <div class="slider-container" data-aos="fade-up" data-aos-duration="1200">
            <div class="slider-track">
                <?php
                $limit  = 15;
                $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;

                $this->db->order_by('testimoni_date', 'DESC');
                $getdata = $this->db->get('tb_testimoni', $limit, $offset);

                if ($getdata->num_rows() > 0) :
                    // Menggandakan data 2x agar looping infinite scroll mulus
                    $testimoni_display_data = array_merge($getdata->result(), $getdata->result());
                    foreach ($testimoni_display_data as $show) :
                        $foto_url = !empty($show->testimoni_img)
                            ? base_url('assets/testimoni/' . $show->testimoni_img)
                            : '';
                        $nama_testi = htmlspecialchars($show->testimoni_name ?? 'Anonim');
                        $perusahaan_testi = htmlspecialchars($show->testimoni_profesi ?? 'Alumni');
                        $judul_testi = htmlspecialchars($show->testimoni_judul ?? '');
                        $isi_testi = htmlspecialchars($show->testimoni_desc ?? '');
                ?>
                        <div class="slider-item">
                            <div class="testi-card-pro">
                                <i class="fas fa-quote-right quote-icon-bg"></i>

                                <div class="user-header-pro">
                                    <?php if ($foto_url): ?>
                                        <img src="<?= $foto_url ?>" class="user-img-pro" alt="<?= $nama_testi ?>">
                                    <?php else: ?>
                                        <div class="user-img-pro" style="background: linear-gradient(135deg, #0f62fe 0%, #0043ce 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 28px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="user-details text-start">
                                        <h5><?= $nama_testi ?></h5>
                                        <span class="company-badge-pro"><?= $perusahaan_testi ?></span>
                                    </div>
                                </div>

                                <div class="testi-content-wrapper text-start">
                                    <h6 class="fw-bold text-dark mb-2"><?= $judul_testi ?></h6>
                                    <p class="quote-text-pro">
                                        "<?= $isi_testi ?>"
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else : ?>
                    <div class="slider-item" style="width: 100%;">
                        <div class="alert alert-light border shadow-sm text-center py-5" style="border-radius: 24px;">
                            <p class="mb-0 text-muted fw-bold" style="font-size: 1.1rem;">
                                <i class="fas fa-inbox me-2"></i> Belum ada testimoni.
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="text-center py-5 bg-white">
    <a href="javascript:void(0)" onclick="applyNow(event)" class="btn btn-cta-glow">
        <i class="fas fa-paper-plane me-2"></i> Kirim Testimoni
    </a>
</div>

<section class="stats-section-pro" data-aos="fade-up">
    <div class="container">
        <div class="row align-items-center">
            <?php foreach ($stats as $stat) : ?>
                <div class="col-6 col-md-3 stat-item-pro">
                    <span class="stat-num-pro"><?= htmlspecialchars($stat['num']) ?></span>
                    <span class="stat-label-pro"><?= htmlspecialchars($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="partners-section-pro">
    <div class="container">
        <h5 class="text-uppercase fw-bold text-muted mb-4" style="letter-spacing: 2px; font-size: 0.9rem;">
            <i class="fas fa-check-circle me-2 text-primary"></i> Dipercaya oleh Industri Terkemuka
        </h5>

        <div class="py-4 bg-white shadow-sm border rounded-4">
            <div class="marquee-container">
                <div class="marquee-content" data-mitra-count="<?= count($mitra_data) ?>">
                    <?php if (!empty($mitra_marquee_data)) : ?>
                        <?php foreach ($mitra_marquee_data as $index => $row) :
                            $logo_url = !empty($row->mitra_logo) ? base_url('assets/mitra/' . $row->mitra_logo) : base_url('assets/mitra/default.png');
                        ?>
                            <span class="marquee-item" data-index="<?= $index ?>">
                                <img src="<?= $logo_url ?>" alt="<?= htmlspecialchars($row->mitra_nama) ?>" title="<?= htmlspecialchars($row->mitra_nama) ?>" />
                            </span>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <span class="marquee-item text-muted">Belum ada mitra industri yang terdaftar.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <p class="mt-4 text-muted small">Bekerja sama dengan <strong><?= count($mitra_data) ?></strong>++ Perusahaan Nasional & Multinasional</p>
    </div>
</section>

<script>
    // FUNGSI GLOBAL JAVASCRIPT
    const isLoggedIn = <?= $this->ion_auth->logged_in() ? 'true' : 'false' ?>;

    function applyNow(event) {
        event.preventDefault(); // cegah link jalan dulu

        if (!isLoggedIn) {
            Swal.fire({
                icon: 'warning',
                title: 'Anda harus login',
                text: 'Silakan login terlebih dahulu untuk melamar lowongan.',
                confirmButtonText: 'Login Sekarang'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "<?= site_url('login') ?>";
                }
            });
            return;
        }

        window.location.href = "<?= site_url('add-testimoni') ?>";

    }


    // 1. Image Preview
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambarcover').attr('src', e.target.result).show();
                $('#file-label').text(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#gambarcover').hide().attr('src', '');
            $('#file-label').text('Pilih Gambar');
        }
    }

    // 2. Rating Input Handler
    function setupRating() {
        const $ratingContainer = $('#ratingInput');
        const $ratingValueInput = $('#testimoni_rating_value');

        $ratingContainer.find('.fa-star').each(function() {
            $(this).on('click', function() {
                const value = parseInt($(this).data('value'));
                $ratingValueInput.val(value);
                updateStars(value);
            }).on('mouseenter', function() {
                const value = parseInt($(this).data('value'));
                updateStars(value, true);
            }).on('mouseleave', function() {
                updateStars(parseInt($ratingValueInput.val()));
            });
        });

        function updateStars(rating, hover = false) {
            $ratingContainer.find('.fa-star').each(function() {
                const starValue = parseInt($(this).data('value'));
                if (starValue <= rating) {
                    $(this).removeClass('far').addClass('fas');
                } else {
                    $(this).removeClass('fas').addClass('far');
                }
            });
        }

        // Set initial state
        updateStars(parseInt($ratingValueInput.val()));
    }


    jQuery(document).ready(function($) {
        // Panggil setup rating
        setupRating();

        // Tombol proses disembunyikan di awal
        $('#btns2').hide();

        // Fungsi untuk memperbarui CSRF token di form
        function updateCSRF(csrf_data) {
            $('[name="' + csrf_data.name + '"]').val(csrf_data.hash);
            $('#csrf_token_nw').val(csrf_data.hash); // Perbarui juga hidden input spesifik
        }


        // --- 3. Dynamic Slider Animation (FIXED INFINITE LOOP) ---
        const sliderTrack = document.querySelector('.slider-track');
        const uniqueItemCount = <?php echo count($testimoni_data); ?>; // Jumlah data asli (1 set)

        if (uniqueItemCount > 0) {
            // 1. Definisi Lebar & Gap (Harus SAMA PERSIS dengan CSS)
            // Cek CSS: .slider-item width + .slider-track gap
            // Default Desktop
            let cardWidth = 400;
            let gap = 30;

            // Cek jika layar HP (sesuaikan dengan media query CSS Anda)
            if (window.innerWidth <= 768) {
                cardWidth = 300; // Sesuai CSS mobile
                gap = 30;
            } else if (window.innerWidth <= 991) {
                cardWidth = 350; // Sesuai CSS tablet
                gap = 30;
            }

            // 2. Hitung Lebar Satu Set Data (Original)
            // Rumus: (Lebar Kartu + Gap) * Jumlah Data Asli
            const singleSetWidth = (cardWidth + gap) * uniqueItemCount;

            // 3. Hitung Durasi (Agar kecepatan konsisten, tidak ngebut/lambat)
            // Semakin banyak data, waktu makin lama supaya speed tetap santai
            const animationDuration = Math.max(uniqueItemCount * 2, 20); // Minimal 20 detik

            // 4. INJECT STYLE ANIMASI BARU (Nama: scroll-dynamic)
            // Kita geser track ke kiri sebesar MINUS LEBAR SATU SET (-singleSetWidth)
            // Setelah sampai sana, dia akan reset ke 0 secara instan (karena tampilan 0 dan -SetWidth itu identik)
            const style = document.createElement('style');
            style.textContent = `
                .slider-track {
                    animation: scroll-dynamic ${animationDuration}s linear infinite !important;
                    width: max-content; /* Pastikan track memanjang */
                    display: flex;
                    gap: ${gap}px;
                }
                
                @keyframes scroll-dynamic {
                    0% { 
                        transform: translateX(0); 
                    }
                    100% { 
                        transform: translateX(-${singleSetWidth}px); 
                    }
                }
            `;
            document.head.appendChild(style);

        } else {
            // Jika tidak ada data, matikan animasi
            if (sliderTrack) {
                sliderTrack.style.animation = 'none';
                sliderTrack.style.justifyContent = 'center';
            }
        }


        // --- 4. Form Submission Handler ---
        $('#formTestimoni').submit(function(event) {
            event.preventDefault();
            $('#btns1').hide();
            $('#btns2').show();

            // Ambil URL dari form action
            const formUrl = $(this).attr('action');

            $.ajax({
                    url: formUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function(data) {
                    // Periksa dan perbarui CSRF token
                    if (data.csrf_data) {
                        updateCSRF(data.csrf_data);
                    }

                    Swal.fire({
                        icon: data.type || 'success',
                        title: data.heading || 'Sukses',
                        text: data.message || 'Testimoni berhasil dikirim dan akan segera di-review.',
                    }).then(function() {
                        // Hanya reload jika sukses dan status true (opsional)
                        if (data.status) {
                            location.reload();
                        } else {
                            // Jika tidak ada reload, reset form dan tampilkan tombol
                            $('#btns1').show();
                            $('#btns2').hide();
                        }
                    });
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // Tangani error, termasuk error server 500
                    console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);

                    // Coba ambil CSRF token baru jika error (misal: token expired)
                    $.get('<?php echo site_url("auth/get_csrf") ?>', function(csrf_data) {
                        updateCSRF(csrf_data);
                    }, 'json');

                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Jaringan',
                        text: 'Terjadi kesalahan saat mengirim testimoni. Silakan coba lagi. (' + textStatus + ')',
                    });
                    $('#btns1').show();
                    $('#btns2').hide();
                });
        });

        // --- 5. Custom File Input Label Update ---
        $(document).on('change', '.custom-file-input', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').html(fileName || 'Pilih Gambar');
        });
    });
</script>