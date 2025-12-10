 <style>
     body {
         font-family: 'Plus Jakarta Sans', sans-serif;
         background: #f0f2f5;
         overflow-x: hidden;
     }

     /* CSS BAWAAN KAMU */
     .hero-title {
         background: -webkit-linear-gradient(45deg, #0f172a, #334155);
         -webkit-background-clip: text;
         -webkit-text-fill-color: transparent;
         letter-spacing: -1px;
     }

     /* --- CSS KHUSUS BAGIAN PROFIL TENGAH (PREMIUM DESIGN - LEBIH RAME) --- */

     .pro-section {
         font-family: 'Plus Jakarta Sans', sans-serif;
         padding: 3rem 0 5rem 0;
         position: relative;
         /* Untuk background pattern */
     }

     /* Tambahan Pattern Background Halus di Header Section */
     .header-pattern {
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         height: 300px;
         background-image: radial-gradient(#2563eb 1px, transparent 1px);
         background-size: 20px 20px;
         opacity: 0.05;
         z-index: -1;
     }

     .pro-section h1,
     .pro-section h2,
     .pro-section h3,
     .pro-section h4 {
         font-family: 'Outfit', sans-serif;
     }

     .pro-section .highlight-blue {
         color: #2563eb;
         position: relative;
         display: inline-block;
         z-index: 1;
     }

     /* Garis bawah stabilo pada highlight */
     .pro-section .highlight-blue::after {
         content: '';
         position: absolute;
         bottom: 5px;
         left: 0;
         width: 100%;
         height: 10px;
         background: rgba(37, 99, 235, 0.1);
         z-index: -1;
         transform: rotate(-2deg);
     }

     /* Bento Card Style Basic */
     .pro-section .bento-card {
         background: #ffffff;
         border-radius: 24px;
         padding: 2rem;
         /* Sedikit dikurangi biar muat lebih banyak konten */
         height: 100%;
         border: 1px solid rgba(226, 232, 240, 0.8);
         box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
         transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
         position: relative;
         overflow: hidden;
         display: flex;
         flex-direction: column;
     }

     .pro-section .bento-card:hover {
         transform: translateY(-5px);
         box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
         border-color: #bfdbfe;
     }

     /* Visi Card Special (Kiri) */
     .pro-section .visi-card-pro {
         background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
         color: white;
         border: none;
         justify-content: space-between;
     }

     .pro-section .visi-card-pro::before {
         content: '';
         position: absolute;
         top: 0;
         right: 0;
         bottom: 0;
         left: 0;
         background-image: radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.15) 0%, transparent 40%);
         pointer-events: none;
     }

     .pro-section .quote-icon {
         font-size: 3rem;
         color: rgba(255, 255, 255, 0.2);
         position: absolute;
         top: 25px;
         right: 25px;
     }

     /* Tambahan Badge di Visi Card */
     .visi-badge {
         background: rgba(255, 255, 255, 0.15);
         backdrop-filter: blur(5px);
         border-radius: 12px;
         padding: 0.75rem 1rem;
         display: flex;
         align-items: center;
         gap: 10px;
         font-size: 0.9rem;
         border: 1px solid rgba(255, 255, 255, 0.2);
     }

     /* Misi Items (Kanan) */
     .pro-section .misi-grid-item {
         background: #f8fafc;
         border-radius: 16px;
         padding: 1.25rem;
         transition: 0.3s;
         border: 1px solid #e2e8f0;
         height: 100%;
         /* Agar tinggi sama */
     }

     .pro-section .misi-grid-item:hover {
         background: #ffffff;
         border-color: #2563eb;
         box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
     }

     .pro-section .icon-square {
         width: 45px;
         height: 45px;
         border-radius: 10px;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 1.2rem;
         margin-bottom: 1rem;
     }

     .pro-section .bg-blue-soft {
         background: #dbeafe;
         color: #1d4ed8;
     }

     .pro-section .bg-indigo-soft {
         background: #e0e7ff;
         color: #4338ca;
     }

     .pro-section .bg-cyan-soft {
         background: #cffafe;
         color: #0e7490;
     }

     .pro-section .bg-rose-soft {
         background: #ffe4e6;
         color: #be123c;
     }

     /* Warna baru untuk item ke-4 */

     /* Motto Bar */
     .pro-section .motto-wrapper {
         background: #0f172a;
         border-radius: 20px;
         padding: 1.5rem 2.5rem;
         position: relative;
         overflow: hidden;
         display: flex;
         align-items: center;
         justify-content: space-between;
     }

     @media (max-width: 991px) {
         .pro-section .motto-wrapper {
             flex-direction: column;
             text-align: center;
             gap: 1rem;
         }

         .visi-badge {
             width: 100%;
             justify-content: center;
         }
     }

     /* --- MULAI KODE PERBAIKAN RESPONSIVE (PASTE DI PALING BAWAH) --- */
     @media (max-width: 991px) {

         /* 1. Paksa semua elemen agar tidak melebihi lebar layar HP */
         html,
         body {
             overflow-x: hidden !important;
             max-width: 100vw !important;
         }

         /* 2. Sembunyikan hiasan background bulat yang bikin layar geser */
         .hero-bg-accent,
         .cta-gradient-box::before,
         .cta-gradient-box::after {
             display: none !important;
         }

         /* 3. Paksa kartu agar tingginya otomatis (tidak tumpuk) */
         .bento-card,
         .job-card-pro,
         .mitra-card-premium {
             height: auto !important;
             min-height: auto !important;
             margin-bottom: 20px !important;
         }

         /* 4. Paksa teks judul mengecil di HP */
         h1.display-4 {
             font-size: 2rem !important;
             line-height: 1.2 !important;
         }

         /* 5. Perbaikan Navbar agar tidak berantakan */
         .navbar-collapse {
             background: rgba(15, 23, 42, 0.95);
             padding: 20px;
             border-radius: 10px;
         }
     }

     /* --- SELESAI KODE PERBAIKAN --- */
 </style>
 <section class="pro-section container mb-5 mt-5">
     <div class="header-pattern"></div>

     <div class="row justify-content-center mb-5" data-aos="fade-up">
         <div class="col-lg-8 text-center position-relative z-1">
             <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold letter-spacing-1">
                 IDENTITAS BKK
             </span>
             <h1 class="display-4 fw-bold text-dark">
                 Membangun Masa Depan <br>
                 <span class="highlight-blue">Profesional & Kompeten</span>
             </h1>
             <p class="text-secondary fs-5 mt-3 col-md-10 mx-auto">
                 Membentuk lulusan SMKN 1 Purwosari yang siap kerja, cerdas, dan memiliki daya saing tinggi di era industri global.
             </p>
         </div>
     </div>

     <div class="row g-4 align-items-stretch">
         <div class="col-lg-5" data-aos="fade-right">
             <div class="bento-card visi-card-pro">
                 <i class="fas fa-quote-right quote-icon"></i>

                 <div>
                     <span class="badge bg-white text-primary bg-opacity-100 px-3 py-2 rounded-pill fw-bold mb-4 shadow-sm">VISI UTAMA</span>
                     <h2 class="fw-bold mt-2 mb-4 lh-base">Menjadi Jembatan Karir Terdepan & Terpercaya</h2>
                     <p class="fs-5 lh-lg fst-italic text-white opacity-90 mb-4">
                         "Menjadi Bursa Kerja Khusus yang unggul dalam memfasilitasi lulusan kompeten untuk bersaing dan berkarya di dunia industri skala nasional maupun internasional."
                     </p>
                 </div>

                 <div class="mt-auto">
                     <p class="text-white-50 small fw-bold text-uppercase mb-3 ls-1 border-bottom border-white border-opacity-25 pb-2">Fokus Strategis Kami:</p>
                     <div class="d-flex flex-wrap gap-3">
                         <div class="visi-badge">
                             <i class="fas fa-globe text-info"></i>
                             <span class="fw-bold">Global Mindset</span>
                         </div>
                         <div class="visi-badge">
                             <i class="fas fa-robot text-warning"></i>
                             <span class="fw-bold">Industri 4.0 Ready</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-lg-7">
             <div class="d-flex flex-column h-100 gap-4">
                 <div class="bento-card flex-grow-1" data-aos="fade-left">
                     <div class="d-flex align-items-center justify-content-between mb-4">
                         <h3 class="fw-bold text-dark m-0"><span class="text-primary">#</span> MISI STRATEGIS</h3>
                         <small class="text-muted">4 Pilar Utama</small>
                     </div>

                     <div class="row g-3">
                         <div class="col-md-6">
                             <div class="misi-grid-item">
                                 <div class="icon-square bg-blue-soft">
                                     <i class="fas fa-handshake"></i>
                                 </div>
                                 <h6 class="fw-bold text-dark">1. Kerjasama DUDI</h6>
                                 <p class="small text-muted mb-0 lh-sm">Kemitraan luas dengan industri nasional & internasional.</p>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="misi-grid-item">
                                 <div class="icon-square bg-indigo-soft">
                                     <i class="fas fa-user-tie"></i>
                                 </div>
                                 <h6 class="fw-bold text-dark">2. Karakter Kerja</h6>
                                 <p class="small text-muted mb-0 lh-sm">Pengembangan soft-skill disiplin & etos kerja unggul.</p>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="misi-grid-item">
                                 <div class="icon-square bg-cyan-soft">
                                     <i class="fas fa-bullhorn"></i>
                                 </div>
                                 <h6 class="fw-bold text-dark">3. Informasi Akurat</h6>
                                 <p class="small text-muted mb-0 lh-sm">Layanan info lowongan kerja real-time & tervalidasi.</p>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="misi-grid-item">
                                 <div class="icon-square bg-rose-soft">
                                     <i class="fas fa-chalkboard-user"></i>
                                 </div>
                                 <h6 class="fw-bold text-dark">4. Bimbingan Karir</h6>
                                 <p class="small text-muted mb-0 lh-sm">Konsultasi dan pendampingan intensif persiapan kerja.</p>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="motto-wrapper shadow-lg mt-auto" data-aos="fade-up" data-aos-delay="200">
                     <div class="position-relative z-1">
                         <span class="text-white-50 text-uppercase small fw-bold ls-1">MOTTO PELAYANAN KAMI</span>
                         <h3 class="text-white fw-bold mb-0 mt-2">"Cepat, Tepat, Profesional"</h3>
                     </div>
                     <div class="d-none d-md-block">
                         <a href="programkerja.html" class="btn btn-sm btn-outline-light rounded-pill px-3 fw-bold">Lihat Program <i class="fas fa-arrow-right ms-1"></i></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>