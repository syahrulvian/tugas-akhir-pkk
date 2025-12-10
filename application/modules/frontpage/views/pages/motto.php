<style>
      /* --- GLOBAL STYLES --- */
      body {
          font-family: 'Plus Jakarta Sans', sans-serif;
          background: #f8fafc;
          overflow-x: hidden;
          color: #334155;
      }

      /* 1. MOTTO SECTION (Style Baru - Dotted Pattern & Clean Cards) */
      .motto-section {
          padding: 5rem 0;
          background-color: #f8fafc;
          /* Pattern titik-titik halus untuk membedakan dari background polos/gradient roadmap */
          background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
          background-size: 24px 24px;
      }

      .gradient-text {
          background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          font-weight: 800;
      }

      /* Kartu Motto: Style lebih 'Boxy' dan Centered */
      .motto-card {
          background: #ffffff; 
          border-radius: 16px; 
          padding: 2.5rem 2rem;
          position: relative; 
          height: 100%; 
          border: 1px solid #e2e8f0;
          box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); 
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
          overflow: hidden;
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          z-index: 1;
      }

      .motto-card:hover {
          transform: translateY(-8px);
          box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
          border-color: #bfdbfe;
      }

      /* Garis aksen di bawah kartu (bukan di atas seperti roadmap) */
      .motto-card::after {
          content: ''; 
          position: absolute; 
          bottom: 0; 
          left: 0; 
          width: 100%; 
          height: 4px;
          background: #e2e8f0; 
          transition: 0.3s;
          transform-origin: center;
          transform: scaleX(0.8);
          border-radius: 4px 4px 0 0;
      }
      .motto-card:hover::after {
          background: #2563eb; 
          transform: scaleX(1);
      }

      /* Huruf Watermark Besar di Belakang */
      .motto-letter-bg {
          position: absolute; 
          right: -10px; 
          bottom: -20px; 
          font-size: 10rem; 
          font-weight: 900;
          color: #f1f5f9; 
          line-height: 1;
          transition: 0.4s; 
          z-index: -1;
          font-family: 'Plus Jakarta Sans', sans-serif;
          user-select: none;
      }
      .motto-card:hover .motto-letter-bg { 
          color: #eff6ff; 
          transform: scale(1.1) rotate(-5deg); 
          bottom: -10px;
      }
      
      /* Icon Circle Style */
      .motto-icon-circle {
          width: 72px; height: 72px; 
          background: #ffffff; 
          color: #2563eb; 
          border: 2px solid #eff6ff;
          border-radius: 50%; /* Lingkaran */
          display: flex; align-items: center; justify-content: center; 
          font-size: 1.75rem;
          margin-bottom: 1.5rem; 
          transition: 0.4s; 
          box-shadow: 0 4px 6px rgba(0,0,0,0.02);
      }
      
      .motto-card:hover .motto-icon-circle {
          background: #2563eb; 
          color: #fff; 
          border-color: #2563eb;
          transform: scale(1.1);
          box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
      }
      
      /* Label Judul Kecil */
      .motto-label {
          display: inline-block; 
          padding: 4px 12px; 
          background: #f1f5f9; 
          color: #64748b;
          border-radius: 6px; 
          font-size: 0.75rem; 
          font-weight: 700; 
          letter-spacing: 0.5px;
          text-transform: uppercase; 
          margin-bottom: 1rem;
          transition: 0.3s;
      }
      .motto-card:hover .motto-label {
          background: #eff6ff;
          color: #2563eb;
      }
      
      /* Special Card for 'Trustworthy' (T) */
      .motto-card-dark {
          background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);
          border: none;
      }
      .motto-card-dark h4, .motto-card-dark p { color: white !important; }
      .motto-card-dark .motto-label { background: rgba(255,255,255,0.1); color: #94a3b8; }
      .motto-card-dark .motto-icon-circle { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: white; }
      .motto-card-dark .motto-letter-bg { color: rgba(255,255,255,0.03); }
      .motto-card-dark:hover .motto-icon-circle { background: #38bdf8; border-color: #38bdf8; color: white; }
      .motto-card-dark:hover::after { background: #38bdf8; }

      /* 2. STATS SECTION (Clean Horizontal) */
      .stats-clean { padding: 4rem 0; background: white; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
      .stat-clean-item { 
          text-align: center; 
          padding: 1rem; 
          border-right: 1px solid #f1f5f9; /* Divider antar stat */
      }
      .stat-clean-item:last-child { border-right: none; }
      .stat-clean-val { font-size: 2.25rem; font-weight: 800; color: #0f172a; line-height: 1.2; }
      .stat-clean-lbl { color: #64748b; font-weight: 500; font-size: 0.95rem; margin-top: 0.25rem; }
      
      @media (max-width: 768px) {
          .stat-clean-item { border-right: none; border-bottom: 1px solid #f1f5f9; padding: 2rem 0; }
          .stat-clean-item:last-child { border-bottom: none; }
      }

      /* 3. CTA SECTION (Dark Modern) */
      .cta-section-modern {
          padding: 5rem 0;
          background: white;
      }
      .cta-box {
          background: #0f172a;
          border-radius: 20px;
          padding: 0;
          overflow: hidden;
          position: relative;
          color: white;
      }
      .cta-content { padding: 4rem 3rem; position: relative; z-index: 2; }
      .cta-image {
          background: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
          background-size: cover;
          background-position: center;
          position: absolute;
          top: 0; right: 0; bottom: 0; left: 50%;
          opacity: 0.4;
          mix-blend-mode: overlay;
      }
      .cta-gradient-overlay {
          position: absolute; top: 0; left: 0; right: 0; bottom: 0;
          background: linear-gradient(90deg, #0f172a 0%, #0f172a 50%, rgba(15, 23, 42, 0.4) 100%);
          z-index: 1;
      }

      .btn-primary-soft {
          background: white; color: #0f172a; 
          border: none; padding: 12px 32px; border-radius: 8px;
          font-weight: 700; transition: 0.3s;
          text-decoration: none; display: inline-block;
      }
      .btn-primary-soft:hover { background: #e2e8f0; transform: translateY(-2px); color: #0f172a; }
      
      .btn-outline-soft {
          border: 1px solid rgba(255,255,255,0.3); color: white; 
          padding: 11px 31px; border-radius: 8px;
          font-weight: 600; transition: 0.3s; background: transparent;
          text-decoration: none; display: inline-block;
      }
      .btn-outline-soft:hover { background: rgba(255,255,255,0.1); border-color: white; color: white; }

      @media (max-width: 991px) {
          .cta-image { left: 0; opacity: 0.2; }
          .cta-gradient-overlay { background: linear-gradient(0deg, #0f172a 0%, rgba(15, 23, 42, 0.8) 100%); }
          .cta-content { text-align: center; }
          .d-flex.gap-3 { justify-content: center; }
      }
    </style>
</head>
<body>
    
    <!-- MOTTO SECTION -->
    <section class="motto-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-down">
                <div class="d-inline-flex align-items-center bg-white border px-3 py-2 rounded-pill shadow-sm mb-3">
                    <span class="text-primary fw-bold small me-2">💎 CORE VALUES</span>
                    <span class="text-muted small">SMKN 1 PURWOSARI</span>
                </div>
                <h2 class="display-5 fw-bold text-dark mb-3">Motto Layanan <span class="gradient-text">HEBAT</span></h2>
                <p class="text-muted col-lg-7 mx-auto fs-5 fw-light">
                    "Melayani dengan HEBAT" adalah komitmen kami untuk memberikan pengalaman terbaik bagi peserta didik, alumni, dan industri.
                </p>
            </div>

            <!-- Grid Kartu HEBAT -->
            <div class="row g-4 justify-content-center">
                
                <!-- H - Help and hear -->
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="motto-card">
                        <div class="motto-letter-bg">H</div>
                        <div class="motto-icon-circle"><i class="fas fa-hands-holding-circle"></i></div>
                        <span class="motto-label">Help and Hear</span>
                        <h4 class="fw-bold mb-3 text-dark">Menolong & Mendengar</h4>
                        <p class="text-muted small mb-0">Siap menolong dan mendengarkan setiap keluhan serta masukan pengguna layanan dengan empati tinggi.</p>
                    </div>
                </div>

                <!-- E - Effective -->
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="motto-card">
                        <div class="motto-letter-bg">E</div>
                        <div class="motto-icon-circle"><i class="fas fa-stopwatch"></i></div>
                        <span class="motto-label">Effective</span>
                        <h4 class="fw-bold mb-3 text-dark">Efektif</h4>
                        <p class="text-muted small mb-0">Memberikan solusi pelayanan yang cepat, tepat sasaran, dan efisien tanpa prosedur yang berbelit.</p>
                    </div>
                </div>

                <!-- B - Be polite -->
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="motto-card">
                        <div class="motto-letter-bg">B</div>
                        <div class="motto-icon-circle"><i class="fas fa-user-tie"></i></div>
                        <span class="motto-label">Be Polite</span>
                        <h4 class="fw-bold mb-3 text-dark">Sopan & Tulus</h4>
                        <p class="text-muted small mb-0">Mengedepankan sikap sopan, santun, dan ketulusan dalam berinteraksi dengan siapa saja.</p>
                    </div>
                </div>

                <!-- A - Accountable -->
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="motto-card">
                        <div class="motto-letter-bg">A</div>
                        <div class="motto-icon-circle"><i class="fas fa-file-circle-check"></i></div>
                        <span class="motto-label">Accountable</span>
                        <h4 class="fw-bold mb-3 text-dark">Akuntabel</h4>
                        <p class="text-muted small mb-0">Setiap data, informasi, dan layanan yang diberikan dapat dipertanggungjawabkan validitasnya.</p>
                    </div>
                </div>

                <!-- T - Trustworthy -->
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="motto-card motto-card-dark shadow-lg">
                        <div class="motto-letter-bg">T</div>
                        <div class="motto-icon-circle"><i class="fas fa-handshake-simple"></i></div>
                        <span class="motto-label">Trustworthy</span>
                        <h4 class="fw-bold mb-3">Terpercaya</h4>
                        <p class="small mb-0 opacity-75">Membangun kepercayaan penuh dari industri dan alumni sebagai pusat pelayanan karir yang kredibel.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STATS SECTION (Clean Style) -->
    <section class="stats-clean">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-md-3" data-aos="fade-in" data-aos-delay="100">
                    <div class="stat-clean-item">
                        <div class="stat-clean-val">50+</div>
                        <div class="stat-clean-lbl">Mitra Industri</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-in" data-aos-delay="200">
                    <div class="stat-clean-item">
                        <div class="stat-clean-val">85%</div>
                        <div class="stat-clean-lbl">Terserap Kerja</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-in" data-aos-delay="300">
                    <div class="stat-clean-item">
                        <div class="stat-clean-val">1.2k</div>
                        <div class="stat-clean-lbl">Database Alumni</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-in" data-aos-delay="400">
                    <div class="stat-clean-item">
                        <div class="stat-clean-val">24/7</div>
                        <div class="stat-clean-lbl">Akses Layanan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION (Modern Dark Box) -->
    <section class="cta-section-modern">
        <div class="container">
            <div class="cta-box" data-aos="zoom-in">
                <div class="cta-image"></div>
                <div class="cta-gradient-overlay"></div>
                
                <div class="row align-items-center cta-content">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <h2 class="fw-bold mb-2">Siap Memulai Karir?</h2>
                        <p class="text-white-50 fs-5 mb-0">
                            Jangan ragu menghubungi BKK SMKN 2 Surabaya. Kami siap membantu Anda mencapai masa depan yang gemilang.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex gap-3 justify-content-lg-end">
                            <a  href="<?= site_url('kontak') ?>" class="btn-primary-soft">
                                <i class="fas fa-paper-plane me-2"></i> Hubungi Kami
                            </a>
                            <a  href="<?= site_url('karir') ?>" class="btn-outline-soft">
                                Info Lowongan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>