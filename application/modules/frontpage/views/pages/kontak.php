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

     /* Custom Scrollbar for aesthetic */
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
     
     /* Wrapper Utama */
    .modern-location-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.05);
    }

    /* Kolom Kiri */
    .z-index-2 { position: relative; z-index: 2; }

    /* Icon Box Premium */
    .icon-box-premium {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
    }

    /* Jam Digital */
    .digital-clock-wrapper {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 15px;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .tracking-tight { letter-spacing: -1px; }
    .spacing-2 { letter-spacing: 2px; }

    /* Efek Hover Tombol */
    .hover-lift {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* Peta di Kanan */
    .google-map-split {
        filter: saturate(90%);
        display: block;
    }

    /* Hiasan Bulat Samar di Background */
    .decoration-circle {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(37,99,235,0.08) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        z-index: 1;
    }

    /* Status Styles */
    .status-pill {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        width: 100%;
    }

    .status-closing-animate {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
        animation: soft-pulse 2s infinite;
    }

    @keyframes soft-pulse {
        0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
    }

    /* Responsive: Di HP Peta harus punya tinggi fix */
    @media (max-width: 768px) {
        .google-map-split {
            height: 350px !important; /* Tinggi peta di HP */
        }
    }
 </style>
 <section class="py-5" style="background-color: #fafbfc">
     <div class="container py-5 mt-4">
         <div class="row g-5 align-items-center">
             <div class="col-lg-5" data-aos="fade-right" data-aos-duration="1000">
                 <div class="mb-5">
                     <h6 class="text-primary fw-bold text-uppercase ls-2 mb-3">
                         <i class="fas fa-minus me-2"></i>Hubungi Kami
                     </h6>
                     <h1 class="display-5 fw-bold text-dark mb-4">
                         Siap Membantu Karir Masa Depan Anda
                     </h1>
                     <p class="lead text-muted">
                         Jangan ragu menghubungi kami untuk kendala teknis, pertanyaan
                         lowongan, atau kerjasama industri.
                     </p>
                 </div>

                 <div class="d-flex flex-column gap-3">
                     <div class="contact-item">
                         <div class="icon-wrapper me-4">
                             <i class="fas fa-map-marker-alt"></i>
                         </div>
                         <div>
                             <h5 class="fw-bold mb-1 text-dark">Alamat Kantor</h5>
                             <p class="text-muted mb-0 small">
                                 <?= option('alamat')['option_desc1'] ?>
                             </p>
                         </div>
                     </div>

                     <div class="contact-item">
                         <div class="icon-wrapper me-4">
                             <i class="fas fa-envelope-open-text"></i>
                         </div>
                         <div>
                             <h5 class="fw-bold mb-1 text-dark">Email Resmi</h5>

                             <p class="text-muted mb-0 small"><?= option('email')['option_desc1'] ?></p>
                         </div>
                     </div>

                     <div class="contact-item">
                         <div class="icon-wrapper me-4">
                             <i class="fas fa-headset"></i>
                         </div>
                         <div>
                             <h5 class="fw-bold mb-1 text-dark">Layanan Bantuan</h5>
                             <p class="text-muted mb-0 small">
                                 <?= option('telp')['option_desc1'] ?>
                             </p>
                         </div>
                     </div>
                 </div>
             </div>



             <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000" id="formkontak">
                <div class="form-card p-4 p-md-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="fw-bold m-0">Kirim Pesan</h3>
                        <span class="badge bg-light text-primary rounded-pill px-3 py-2">Respon < 24 Jam</span>
                    </div>
                    
                    <form id="formkontak">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label-custom">Nama Lengkap</label>
                                <input type="text" id="nama" class="form-control form-control-modern" placeholder="Contoh: Budi Santoso" autocomplete="off" />
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label-custom">No WhatsApp</label>
                                <input type="number" id="wa" class="form-control form-control-modern" placeholder="Isi No Telp..." autocomplete="off" />
                            </div>

                             <div class="col-12">
                                 <label class="form-label-custom">Pesan Anda</label>
                                 <textarea
                                     id="pesan"
                                     class="form-control form-control-modern"
                                     rows="4"
                                     placeholder="Jelaskan kebutuhan Anda secara detail..."></textarea>
                             </div>

                             <div class="col-12 mt-4">
                                 <button
                                     type="submit"
                                     class="btn btn-send-gradient w-100 shadow-lg">
                                     <i class="fas fa-paper-plane me-2"></i>Kirim Pesan Sekarang
                                 </button>
                             </div>
                         </div>
                     </form>

                 </div>
             </div>
         </div>
         <br>

         <div class="container mt-5" data-aos="fade-up">
            <div class="modern-location-card shadow-lg overflow-hidden rounded-4">
                <div class="row g-0">
                    
                    <div class="col-lg-4 col-md-5 bg-white position-relative d-flex flex-column justify-content-center p-4 p-lg-5 text-center text-md-start">
                        
                        <div class="decoration-circle"></div>

                        <div class="position-relative z-index-2">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-4">
                                <div class="icon-box-premium me-3">
                                    <i class="fas fa-school text-white"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark">SMK Negeri 1</h5>
                                    <small class="text-primary fw-bold spacing-1">PURWOSARI</small>
                                </div>
                            </div>

                            <div class="digital-clock-wrapper mb-4 text-center">
                                <div id="digital-clock" class="display-4 fw-bold text-dark tracking-tight">--:--:--</div>
                                <div id="current-date" class="text-muted small text-uppercase spacing-2">Memuat Tanggal...</div>
                            </div>

                            <div id="dynamic-status-box" class="mb-4">
                                </div>

                            <hr class="opacity-10 my-4">

                            <div class="mb-4">
                                <div class="d-flex align-items-start justify-content-center justify-content-md-start mb-2">
                                    <i class="fas fa-map-marker-alt text-danger mt-1 me-2"></i>
                                    <span class="small text-secondary">Jl. Raya Purwosari, Polerejo, Purwosari, Kec. Purwosari, Pasuruan, Jawa Timur 67162</span>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/ZuR2y2YRh89364Zn6" target="_blank" class="btn btn-dark w-100 rounded-pill py-3 fw-bold hover-lift">
                                <i class="fas fa-location-arrow me-2"></i> Buka Rute
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="map-container h-100">
                            <iframe 
                                class="google-map-split"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.104278637734!2d112.74621741477732!3d-7.767780394396269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7d4c5631aebf5%3A0x771d9f205034b481!2sSMK%20Negeri%201%20Purwosari!5e0!3m2!1sid!2sid!4v1629876543210!5m2!1sid!2sid"
                                width="100%" 
                                height="100%" 
                                style="border:0; min-height: 400px;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</section>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#formkontak");
            const adminNumber = "6285138345293"; // NOMOR ADMIN

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                // Mengambil elemen input
                const namaInput = document.querySelector("#nama");
                const waInput = document.querySelector("#wa");
                const pesanInput = document.querySelector("#pesan");

                // Mengambil nilai (value) untuk dikirim
                const nama = namaInput.value.trim();
                const wa = waInput.value.trim();
                const pesan = pesanInput.value.trim();

                if (nama === "" || wa === "" || pesan === "") {
                    alert("Harap isi semua field sebelum mengirim pesan.");
                    return;
                }

                const text =
                    `Halo Admin BKK,%0A` +
                    `Saya ingin mengirim pesan:%0A%0A` +
                    `👤 Nama: ${nama}%0A` +
                    `📱 WhatsApp: ${wa}%0A` +
                    `💬 Pesan:%0A${pesan}`;

                const url = `https://wa.me/${adminNumber}?text=${text}`;
                
                // Membuka WhatsApp
                window.open(url, "_blank");

                // --- BAGIAN INI YANG MEMBUAT FORM KOSONG (REFRESH) ---
                // Kita kosongkan paksa satu per satu
                setTimeout(() => {
                    namaInput.value = "";
                    waInput.value = "";
                    pesanInput.value = "";
                }, 500); // Jeda setengah detik agar terlihat natural
            });

        });

        // Fungsi untuk memperbarui jam digital dan status
        document.addEventListener('DOMContentLoaded', function() {
    // === 1. KONFIGURASI JADWAL ===
    const jadwal = {
        buka: 6 * 60 + 45, // 06:45
        tutupBiasa: 15 * 60, // 15:00
        tutupJumat: 15 * 60 + 30, // 15:30
        warningMenit: 60 // Peringatan muncul 60 menit sebelum tutup
    };

    // === 2. FUNGSI JAM DIGITAL ===
    function updateClock() {
        const now = new Date();
        
        // Update Jam (HH:MM:SS)
        const timeString = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false 
        }).replace(/\./g, ':');
        document.getElementById('digital-clock').innerText = timeString;

        // Update Tanggal (Senin, 20 Oktober 2025)
        const dateString = now.toLocaleDateString('id-ID', { 
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' 
        });
        document.getElementById('current-date').innerText = dateString;

        // Cek Status Sekolah
        checkStatus(now);
    }

    // === 3. LOGIKA STATUS ===
    function checkStatus(now) {
        const day = now.getDay(); // 0=Minggu
        const currentMins = now.getHours() * 60 + now.getMinutes();
        const statusBox = document.getElementById('dynamic-status-box');
        
        let html = '';
        let tutupJam = (day === 5) ? jadwal.tutupJumat : jadwal.tutupBiasa;
        let tutupStr = (day === 5) ? '15:30' : '15:00';

        // Logika Minggu/Sabtu Libur
        if (day === 0 || day === 6) {
            html = `<div class="status-pill bg-secondary text-white"><i class="fas fa-door-closed me-2"></i>Libur Hari Ini</div>`;
        } 
        // Belum Buka
        else if (currentMins < jadwal.buka) {
            html = `<div class="status-pill bg-light text-muted border"><i class="fas fa-coffee me-2"></i>Buka jam 06:45</div>`;
        }
        // Sudah Tutup
        else if (currentMins > tutupJam) {
            html = `<div class="status-pill bg-danger text-white"><i class="fas fa-times-circle me-2"></i>Sudah Tutup</div>`;
        } 
        // Masih Buka (Cek Warning)
        else {
            let sisaWaktu = tutupJam - currentMins;
            
            if (sisaWaktu <= jadwal.warningMenit && sisaWaktu > 0) {
                // WARNING: Sebentar Lagi Tutup
                html = `
                <div class="status-pill status-closing-animate text-start">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                        <div>
                            <div class="lh-1">Sebentar Lagi Tutup</div>
                            <small class="fw-normal">Kurang ${sisaWaktu} menit lagi</small>
                        </div>
                    </div>
                </div>`;
            } else {
                // BUKA NORMAL
                html = `<div class="status-pill bg-success text-white"><i class="fas fa-check-circle me-2"></i>Buka Sekarang</div>`;
            }
        }

        statusBox.innerHTML = html;
    }

    // Jalankan setiap detik
    setInterval(updateClock, 1000);
    updateClock(); // Jalankan langsung saat load
});
 </script>