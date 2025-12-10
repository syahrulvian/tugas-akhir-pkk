    <?php
    // Detail Lowongan Page untuk BKK SMKN 1 Purwosari

    // Check if lowongan data exists (passed from controller)
    if (!isset($lowongan) || !$lowongan) {
        echo '<div class="alert alert-danger mt-5 text-center">Lowongan not found.</div>';
        return;
    }

    // Get kategori keahlian
    $keahlian = $this->db->get_where('tb_kategori', ['id_kategori' => $lowongan->kategori_id])->row();
    // Get kategori tipe kerja
    $tipe_kerja = $this->db->get_where('tb_kategori', ['id_kategori' => $lowongan->kategori_tipe])->row();

    $this->template->title->set($lowongan->lowongan_judul . ' | Bursa Kerja SMKN 1 Purwosari');
    $this->template->description->set(substr(htmlspecialchars($lowongan->lowongan_desc), 0, 100));
    $this->template->keywords->set('Lowongan, ' . htmlspecialchars($lowongan->lowongan_judul) . ', ' . htmlspecialchars($lowongan->lowongan_perusahaan));
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
            --shadow-card: 0 10px 30px -5px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 20px 40px -5px rgba(13, 110, 253, 0.15);
            --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
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

        .hero-lowongan {
            background: var(--gradient-blue);
            color: white;
            padding: 60px 20px;
            text-align: center;
            margin-top: 60px;
            margin-bottom: 40px;
        }

        .hero-lowongan h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .hero-lowongan p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .lowongan-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow-card);
            margin-bottom: 30px;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
        }

        .detail-header-left h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .detail-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge-custom {
            display: inline-block;
            padding: 8px 16px;
            background-color: #e0f2fe;
            color: #0369a1;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .detail-image {
            margin-bottom: 30px;
        }

        .detail-image img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .info-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .info-row i {
            color: var(--primary);
            min-width: 24px;
            margin-top: 3px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 30px 0 20px 0;
            color: var(--dark);
        }

        .description-text {
            line-height: 1.8;
            color: #475569;
            white-space: pre-wrap;
        }

        .sidebar-info {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--shadow-card);
            position: sticky;
            top: 100px;
        }

        .sidebar-item {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e2e8f0;
        }

        .sidebar-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .sidebar-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--gray);
            font-weight: 700;
            margin-bottom: 8px;
            display: block;
        }

        .sidebar-value {
            font-size: 1.1rem;
            color: var(--dark);
            font-weight: 600;
        }

        .apply-button {
            width: 100%;
            padding: 16px;
            background: var(--gradient-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition-smooth);
            margin-top: 20px;
        }

        .apply-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            color: white;
            text-decoration: none;
        }

        .share-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .share-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: var(--transition-smooth);
            font-size: 0.9rem;
        }

        .share-btn:hover {
            background: #f1f5f9;
            border-color: var(--primary);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .back-link:hover {
            gap: 12px;
            color: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .detail-header {
                flex-direction: column;
            }

            .hero-lowongan h1 {
                font-size: 1.8rem;
            }

            .detail-card {
                padding: 20px;
            }

            .sidebar-info {
                position: static;
            }
        }
    </style>

    <div class="lowongan-container mt-5">
        <a href="<?= site_url('karir') ?>" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Lowongan
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <div class="detail-header-left">
                    <h2><?= htmlspecialchars($lowongan->lowongan_judul) ?></h2>
                    <div class="detail-badges">
                        <?php if ($keahlian): ?>
                            <span class="badge-custom">
                                <i class="fas fa-graduation-cap"></i> <?= htmlspecialchars($keahlian->nama_kategori) ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($tipe_kerja): ?>
                            <span class="badge-custom">
                                <i class="fas fa-briefcase"></i> <?= htmlspecialchars($tipe_kerja->nama_kategori) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <?php if (!empty($lowongan->lowongan_img)): ?>
                        <div class="detail-image">
                            <img src="<?= base_url('assets/lowongan/' . $lowongan->lowongan_img) ?>"
                                alt="<?= htmlspecialchars($lowongan->lowongan_judul) ?>">
                        </div>
                    <?php endif; ?>

                    <div class="info-row">
                        <i class="fas fa-building"></i>
                        <div>
                            <strong>Perusahaan:</strong> <?= htmlspecialchars($lowongan->lowongan_perusahaan) ?>
                        </div>
                    </div>

                    <div class="info-row">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Lokasi:</strong> <?= htmlspecialchars($lowongan->lowongan_alamat) ?>
                        </div>
                    </div>

                    <div class="info-row">
                        <i class="fas fa-calendar-alt"></i>
                        <div>
                            <strong>Periode:</strong>
                            <?= date('d M Y', strtotime($lowongan->lowongan_start)) ?> -
                            <?= date('d M Y', strtotime($lowongan->lowongan_end)) ?>
                        </div>
                    </div>

                    <h3 class="section-title">Deskripsi Lowongan</h3>
                    <div class="description-text">
                        <?= nl2br(htmlspecialchars($lowongan->lowongan_desc ?: 'Tidak ada deskripsi')) ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-info">
                        <div class="sidebar-item">
                            <span class="sidebar-label">Perusahaan</span>
                            <div class="sidebar-value"><?= htmlspecialchars($lowongan->lowongan_perusahaan) ?></div>
                        </div>

                        <div class="sidebar-item">
                            <span class="sidebar-label">Keahlian</span>
                            <div class="sidebar-value">
                                <?= $keahlian ? htmlspecialchars($keahlian->nama_kategori) : '-' ?>
                            </div>
                        </div>

                        <div class="sidebar-item">
                            <span class="sidebar-label">Tipe Kerja</span>
                            <div class="sidebar-value">
                                <?= $tipe_kerja ? htmlspecialchars($tipe_kerja->nama_kategori) : '-' ?>
                            </div>
                        </div>

                        <div class="sidebar-item">
                            <span class="sidebar-label">Posting</span>
                            <div class="sidebar-value"><?= date('d M Y', strtotime($lowongan->lowongan_date)) ?></div>
                        </div>


                        <button class="apply-button" onclick="applyNow()">
                            <i class="fas fa-paper-plane"></i> Lamar Sekarang
                        </button>


                        <div class="share-buttons">
                            <button class="share-btn" title="Bagikan ke WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                            <button class="share-btn" title="Bagikan ke Facebook">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button class="share-btn" title="Copy Link">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const isLoggedIn = <?= $this->ion_auth->logged_in() ? 'true' : 'false' ?>;

        function applyNow() {
            const staffPhone = "<?= $lowongan->lowongan_nomor ?>";

            if (!staffPhone) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor Tidak Tersedia',
                    text: 'Nomor WhatsApp pembuat lowongan tidak ditemukan.'
                });
                return;
            }

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

            // ========= DATA USER =========
            const userName = "<?= addslashes((string) userdata()->user_fullname) ?>";
            const userEmail = "<?= addslashes((string) userdata()->email) ?>";
            const userPhone = "<?= addslashes((string) userdata()->user_phone) ?>";

            const rawCv = <?= json_encode(userdata()->user_cv) ?>;

            // Gunakan route download CV
            const userCV = rawCv ?
                "<?= base_url('download-pdf/') ?>" + rawCv :
                "CV belum diupload";

            // ========= DATA LOWONGAN =========
            const jobTitle = "<?= addslashes($lowongan->lowongan_judul) ?>";
            const company = "<?= addslashes($lowongan->lowongan_perusahaan) ?>";

            const message =
                `Halo, saya ${userName} ingin melamar posisi:\n\n` +
                `*${jobTitle}* di ${company}.\n\n` +
                `--- DATA DIRI ---\n` +
                `Nama: ${userName}\n` +
                `Email: ${userEmail}\n` +
                `No. HP: ${userPhone}\n\n` +
                `CV Saya:\n${userCV}`;

            // Buka WhatsApp Web / Mobile
            window.open(
                `https://wa.me/${staffPhone}?text=${encodeURIComponent(message)}`,
                '_blank'
            );
        }






        // Share functionality
        const shareButtons = document.querySelectorAll('.share-btn');
        const pageUrl = window.location.href;
        const pageTitle = '<?= addslashes(htmlspecialchars($lowongan->lowongan_judul)) ?>';
        const pageDesc = 'Lowongan kerja di ' + '<?= addslashes(htmlspecialchars($lowongan->lowongan_perusahaan)) ?>';

        shareButtons[0].addEventListener('click', function() {
            // WhatsApp share
            const waMessage = `${pageTitle}\n${pageDesc}\n\n${pageUrl}`;
            window.open(`https://wa.me/?text=${encodeURIComponent(waMessage)}`, '_blank');
        });

        shareButtons[1].addEventListener('click', function() {
            // Facebook share
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(pageUrl)}`, '_blank');
        });

        shareButtons[2].addEventListener('click', function() {
            // Copy link to clipboard
            navigator.clipboard.writeText(pageUrl).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 2000);
            }).catch(() => {
                alert('Gagal menyalin link');
            });
        });
    </script>