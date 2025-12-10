<style>
      /* --- CSS KHUSUS ROADMAP & DETAIL BARU --- */
      
      body {
          font-family: 'Plus Jakarta Sans', sans-serif;
          background: #f0f2f5;
          overflow-x: hidden;
      }

      /* 1. ROADMAP SECTION */
      .roadmap-ultimate {
          padding: 5rem 0;
          background: linear-gradient(180deg, #f0f2f5 0%, #ffffff 100%);
      }
      .gradient-text {
          background: linear-gradient(135deg, #0061f2 0%, #00c6f9 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          font-weight: 800;
      }
      .flow-card {
          background: #ffffff; border-radius: 20px; padding: 2.5rem 2rem;
          position: relative; height: 100%; border: 1px solid rgba(0,0,0,0.03);
          box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05); transition: 0.4s; overflow: hidden;
      }
      .flow-card:hover {
          transform: translateY(-15px) scale(1.02);
          box-shadow: 0 20px 40px -10px rgba(0, 97, 242, 0.15);
          border-color: rgba(0, 97, 242, 0.2);
      }
      .flow-card::before {
          content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px;
          background: linear-gradient(90deg, #0061f2, #00c6f9); transform: scaleX(0); 
          transform-origin: left; transition: transform 0.4s ease;
      }
      .flow-card:hover::before { transform: scaleX(1); }
      .flow-number {
          position: absolute; right: -10px; top: -15px; font-size: 5rem; font-weight: 900;
          color: rgba(0,0,0,0.03); transition: 0.4s; z-index: 0;
      }
      .flow-card:hover .flow-number { color: rgba(0, 97, 242, 0.05); transform: translateX(-10px) translateY(10px); }
      .icon-box-anim {
          width: 60px; height: 60px; background: #eff6ff; color: #0061f2; border-radius: 16px;
          display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
          margin-bottom: 1.5rem; transition: 0.4s; position: relative; z-index: 1;
      }
      .flow-card:hover .icon-box-anim {
          background: #0061f2; color: #fff; transform: rotate(360deg);
          box-shadow: 0 10px 20px rgba(0, 97, 242, 0.3);
      }
      .time-pill {
          display: inline-block; padding: 6px 14px; background: rgba(0, 97, 242, 0.08); color: #0061f2;
          border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 1rem;
      }
      .card-special { background: linear-gradient(135deg, #0061f2 0%, #2979ff 100%); }
      .card-special h4, .card-special p { color: white !important; }
      .card-special .time-pill, .card-special .icon-box-anim { background: rgba(255,255,255,0.2); color: white; }
      .card-special .flow-number { color: rgba(255,255,255,0.1); }

      /* 2. STATS SECTION */
      .stats-modern { padding: 3rem 0; background: white; border-top: 1px solid rgba(0,0,0,0.05); }
      .stat-item-modern { text-align: center; padding: 1.5rem; border-radius: 16px; transition: 0.3s; }
      .stat-item-modern:hover { background: #f8fafc; transform: translateY(-5px); }
      .stat-val { font-size: 2.5rem; font-weight: 800; color: #1e293b; display: block; }
      .stat-lbl { color: #64748b; font-weight: 600; font-size: 0.9rem; }

      /* 3. NEW CTA SECTION (PENAMBAHAN BARU) */
      .cta-section-ultimate {
          padding-bottom: 5rem;
          background: white;
      }
      .cta-card-ultimate {
          background: linear-gradient(120deg, #0f172a 0%, #1e293b 100%);
          border-radius: 24px;
          padding: 4rem 3rem;
          position: relative;
          overflow: hidden;
          box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.3);
          color: white;
      }
      /* Dekorasi Lingkaran Halus */
      .cta-circle {
          position: absolute; border-radius: 50%; background: radial-gradient(circle, rgba(0,97,242,0.4) 0%, rgba(0,0,0,0) 70%);
          filter: blur(40px); pointer-events: none;
      }
      .c1 { width: 300px; height: 300px; top: -100px; right: -50px; }
      .c2 { width: 200px; height: 200px; bottom: -50px; left: -50px; background: radial-gradient(circle, rgba(0,198,249,0.3) 0%, rgba(0,0,0,0) 70%); }

      .btn-glow {
          background: #0061f2; color: white; border: none; padding: 12px 30px; border-radius: 50px;
          font-weight: 700; transition: 0.3s; box-shadow: 0 0 20px rgba(0, 97, 242, 0.4);
      }
      .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 0 30px rgba(0, 97, 242, 0.6); background: #2563eb; color: white; }
      
      .btn-outline-glow {
          border: 2px solid rgba(255,255,255,0.3); color: white; padding: 10px 28px; border-radius: 50px;
          font-weight: 600; transition: 0.3s; background: transparent;
      }
      .btn-outline-glow:hover { background: white; color: #0f172a; border-color: white; }

      @media (max-width: 768px) {
          .cta-card-ultimate { padding: 3rem 1.5rem; text-align: center; }
          .d-flex.gap-3 { justify-content: center; }
      }
      

    </style>
  </head>
  <body>
    <br>
    <section class="roadmap-ultimate">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-down">
                <span class="badge bg-white text-primary shadow-sm px-3 py-2 rounded-pill mb-3 fw-bold">🚀 AGENDA TAHUNAN</span>
                <h2 class="display-4 fw-bold text-dark">Roadmap <span class="gradient-text">Program Kerja</span></h2>
                <p class="text-muted col-lg-6 mx-auto">
                    Timeline kegiatan strategis untuk mencetak lulusan kompeten yang siap bersaing di era global.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="flow-card">
                        <span class="flow-number">01</span>
                        <div class="icon-box-anim"><i class="fas fa-brain"></i></div>
                        <span class="time-pill">Jan - Mar</span>
                        <h4 class="fw-bold mb-3 text-dark">Soft Skill & Psikotes</h4>
                        <p class="text-muted small mb-0">Pembekalan mental intensif dan simulasi tes psikologi.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="flow-card">
                        <span class="flow-number">02</span>
                        <div class="icon-box-anim"><i class="fas fa-building"></i></div>
                        <span class="time-pill">April</span>
                        <h4 class="fw-bold mb-3 text-dark">Kunjungan Industri</h4>
                        <p class="text-muted small mb-0">Observasi budaya kerja langsung ke pabrik mitra.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="300">
                    <div class="flow-card card-special shadow-lg">
                        <span class="flow-number">03</span>
                        <div class="icon-box-anim"><i class="fas fa-rocket"></i></div>
                        <span class="time-pill">Juni 2024</span>
                        <h4 class="fw-bold mb-3">GRAND JOB FAIR</h4>
                        <p class="small mb-0 opacity-75">Event Puncak! Rekrutmen massal dengan 30+ HRD Perusahaan.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="flow-card">
                        <span class="flow-number">04</span>
                        <div class="icon-box-anim"><i class="fas fa-user-check"></i></div>
                        <span class="time-pill">Agust - Okt</span>
                        <h4 class="fw-bold mb-3 text-dark">Tracer Study</h4>
                        <p class="text-muted small mb-0">Pendataan status kebekerjaan alumni untuk laporan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-modern">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-item-modern">
                        <span class="stat-val text-primary">50+</span>
                        <span class="stat-lbl">Mitra Industri</span>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-item-modern">
                        <span class="stat-val text-info">85%</span>
                        <span class="stat-lbl">Terserap Kerja</span>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-item-modern">
                        <span class="stat-val text-warning">1.2k</span>
                        <span class="stat-lbl">Data Alumni</span>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="stat-item-modern">
                        <span class="stat-val text-success">24/7</span>
                        <span class="stat-lbl">Support Karir</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section-ultimate">
        <div class="container">
            <div class="cta-card-ultimate" data-aos="fade-up">
                <div class="cta-circle c1"></div>
                <div class="cta-circle c2"></div>

                <div class="row align-items-center position-relative z-1">
                    <div class="col-lg-7">
                        <h2 class="fw-bold mb-3">Siap Memulai Karir Impianmu?</h2>
                        <p class="text-white-50 fs-5 mb-4 mb-lg-0">
                            Jangan lewatkan kesempatan emas. Bergabunglah dengan ribuan alumni yang telah sukses di dunia industri.
                        </p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <div class="d-flex gap-3 justify-content-lg-end">
                            <a  href="<?= site_url('kontak') ?>" class="btn-glow">
                                <i class="fas fa-sign-in-alt me-2"></i> Login Portal
                            </a>
                            <a href="contact.html" class="btn-outline-glow">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>