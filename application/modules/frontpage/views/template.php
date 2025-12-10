<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bursa Kerja Khusus SMKN 1 Purwosari</title>

    <!-- CSS -->
    <link href="<?= base_url('assets/frontpage/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/jquery-ui.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/jquery.fancybox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/nice-select.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/swiper-bundle.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/slick.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/slick-theme.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/daterangepicker.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontpage/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/backend/libs/sweetalert2/dist/sweetalert2.min.css") ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link href="<?php echo base_url('assets/backend') ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('assets/vendors/jquery-easy-loading/dist/jquery.loading.min.css') ?>">
    <script src="<?php echo base_url('assets/backend') ?>/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/vendors/jquery-easy-loading/dist/jquery.loading.min.js') ?>"></script>

    <link href="<?= base_url('assets/frontpage/style.css') ?>" rel="stylesheet">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">


    <link rel="icon" href="<?= base_url('assets/logosmkn.png') ?>" type="image/svg+xml" sizes="20x20">

    <style>
        .swal2-popup {
            text-align: center !important;
            display: block !important;
        }

        #swal2-title {
            display: block !important;
        }

        .swal2-icon-text {
            font-size: 50px !important;
        }
    </style>

</head>
<style>
    .floating-wa {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 20px;
        right: 20px;
        background-color: #25d366;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: floatWa 3s ease-in-out infinite;
        /* efek melayang */
    }

    .floating-wa:hover {
        transform: scale(1.1);
        box-shadow: 0 0 12px rgba(37, 211, 102, 0.6);
    }

    /* Gambar di dalam tombol */
    .floating-wa img {
        width: 35px;
        height: 35px;
    }

    /* Animasi melayang */
    @keyframes floatWa {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }
</style>

<style>
    :root {
        --soft-black: #2E2E2E;
        --accent-teal: #3A7C82;
    }

    /* gaya untuk halaman blog */
    .blog-content h4 {
        font-size: 1.1rem;
        font-weight: 600;
    }


    /* 1. Atur container utamanya agar menata elemen di dalamnya secara berdampingan */
    /* .header-logo {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
    }

    .header-logo .site-logo {
        height: 75px;
        width: auto;
        object-fit: contain;
        margin-left: -80px;
    }

    .header-logo .text-logo {
        height: 95px;
        width: auto;
        object-fit: contain;
        margin-right: -30px;
        margin-left: -30px;
    } */

    .topbar-area {
        padding: 0;
        border-bottom: 1px solid var(--borders-color);
    }

    .justify-content-between {
        justify-content: space-between !important;
    }

    .footer-section .footer-bottom .copyright-and-payment-method-area p {
        color: var(--soft-black);
        font-family: var(--font-poppins);
        font-weight: 500;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .footer-section {
        background-image: linear-gradient(to bottom right, rgba(184, 154, 133, 0.88), rgba(210, 190, 178, 0.88)),
            url('<?= base_url("assets/frontpage/img/home1/footer-bg.png") ?>');
        background-size: cover;
        background-repeat: no-repeat;
        color: #000;
    }

    .footer-section .footer-contact-wrap .inquiry-area .content h6 {
        color: var(--accent-teal);
        font-family: var(--font-poppins);
        font-weight: 600;
        font-size: 18px;
        line-height: 1.3;
        margin-bottom: 5px;
    }

    .footer-section .footer-contact-wrap .contact-area .single-contact .content a {
        color: var(--accent-teal);
        font-family: var(--font-poppins);
        font-weight: 600;
        font-size: 20px;
        line-height: 1;
        transition: 0.5s;
    }

    .footer-section .footer-menu-wrap .footer-widget .widget-title h5 {
        color: var(--accent-teal);
        font-family: var(--font-roboto);
        font-weight: 500;
        font-size: 20px;
        line-height: 1;
        margin-bottom: 0;
    }

    .footer-section .footer-contact-wrap .inquiry-area .content span {
        color: var(--soft-black);
        font-family: var(--font-poppins);
        font-weight: 600;
        font-size: 18px;
        line-height: 28px;
    }

    .footer-section .footer-contact-wrap .contact-area .single-contact .content span {
        color: var(--soft-black);
        font-family: var(--font-roboto);
        font-weight: 500;
        font-size: 16px;
        line-height: 1;
        display: block;
        margin-bottom: 7px;
    }

    .footer-section .footer-menu-wrap .footer-logo-and-addition-info .address-area span {
        color: var(--black);
        font-family: var(--font-poppins);
        font-weight: 600;
        font-size: 16px;
        line-height: 1;
        display: block;
        margin-bottom: 10px;
    }

    .footer-section .footer-menu-wrap .footer-logo-and-addition-info .address-area a {
        color: var(--soft-black);
        font-family: var(--font-roboto);
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        transition: 0.5s;
    }

    .footer-section .footer-menu-wrap .footer-widget .widget-list li a {
        color: var(--soft-black);
        font-family: var(--font-roboto);
        font-weight: 500;
        font-size: 16px;
        line-height: 1;
        transition: 0.5s;
    }

    .footer-section .footer-bottom .copyright-and-payment-method-area p a {
        color: var(--accent-teal);
        transition: 0.5s;
    }

    @media (max-width: 576px) {
        .navbar-brand img {
            height: 50px !important;
            /* kecilkan logo */
        }

        .navbar-brand span {
            font-size: 15px !important;
            /* kecilkan teks */
        }
    }
</style>
<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6285138345293?text=Halo%20Admin%20BKK%2C%20saya%20ingin%20bertanya%20tentang%20informasi%20lowongan%20kerja%20di%20Bursa%20Kerja%20Khusus."
    class="floating-wa" target="_blank" aria-label="Chat via WhatsApp">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp Icon">
</a>


<!-- Floating WA CSS -->
<!-- Floating WA CSS -->




<body class="tt-magic-cursor">

    <div id="magic-cursor">
        <div id="ball"></div>
    </div>
    <nav class="navbar navbar-expand-lg fixed-top" style="background: var(--primary-bg)">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
                <img src="<?= base_url('assets/logosmkn.png') ?>" alt="Logo" class="me-2" />
                <span class="text-white fw-bold">BKK SMKN 1 PURWOSARI</span>
            </a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?= site_url('/') ?>">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <?php
                        $profil_pages = ['visimisi', 'programkerja', 'motto', 'struktur-organisasi'];
                        $profil_active = in_array($this->uri->segment(1), $profil_pages) ? 'active' : '';
                        ?>
                        <a class="nav-link dropdown-toggle <?= $profil_active ?>" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil <i class="fas fa-chevron-down custom-arrow"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'visimisi' ? 'active' : '') ?>" href="<?= site_url('visimisi') ?>">Visi Misi BKK</a></li>
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'programkerja' ? 'active' : '') ?>" href="<?= site_url('programkerja') ?>">Program Kerja BKK</a></li>
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'motto' ? 'active' : '') ?>" href="<?= site_url('motto') ?>">Motto BKK</a></li>
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'struktur-organisasi' ? 'active' : '') ?>" href="<?= site_url('struktur-organisasi') ?>">Struktur Organisasi</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(1) == 'karir' ? 'active' : '') ?>" href="<?= site_url('karir') ?>">Lowongan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(1) == 'mitra' ? 'active' : '') ?>" href="<?= site_url('mitra') ?>">Mitra</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(1) == 'faq' ? 'active' : '') ?>" href="<?= site_url('faq') ?>">Faq</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        $news_pages = ['blog', 'galeri', 'testimoni', 'statistik'];
                        $news_active = in_array($this->uri->segment(1), $news_pages) ? 'active' : '';
                        ?>
                        <a class="nav-link dropdown-toggle <?= $news_active ?>" href="#" id="newsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            News <i class="fas fa-chevron-down custom-arrow"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="newsDropdown">
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'blog' ? 'active' : '') ?>" href="<?= site_url('blog') ?>">Berita Terbaru</a></li>
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'galeri' ? 'active' : '') ?>" href="<?= site_url('galeri') ?>">Galeri / Kegiatan</a></li>
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'testimoni' ? 'active' : '') ?>" href="<?= site_url('testimoni') ?>">Testimoni</a></li>
                            <li><a class="dropdown-item <?= ($this->uri->segment(1) == 'statistik' ? 'active' : '') ?>" href="<?= site_url('statistik') ?>">Statistik</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(1) == 'kontak' ? 'active' : '') ?>" href="<?= site_url('kontak') ?>">Kontak</a>
                    </li>
                    <?php if ($userdata): ?>

                        <!-- USER LOGGED IN DROPDOWN -->
                        <li class="nav-item dropdown user-dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle btn btn-login-nav" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-user-circle" style="font-size:20px;"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="<?= site_url('dashboard') ?>">My Profile</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="logout_confirm()">Logout</a></li>
                            </ul>
                        </li>

                    <?php else: ?>

                        <!-- USER NOT LOGGED IN -->
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-login-nav <?= ($this->uri->segment(1) == 'login' ? 'active' : '') ?>"
                                href="<?= site_url('login') ?>">
                                Login Portal
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <br />

    <?php echo $this->template->content ?>

    <!-- header Section Start-->
    <footer class="footer-tech">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <a href="#" class="brand-gradient">BKK SMKN 1 PURWOSARI</a>
                    <p class="footer-tagline">
                        Platform karir generasi masa depan. Kami menghubungkan talenta
                        terbaik dengan ekosistem industri global melalui teknologi dan
                        inovasi.
                    </p>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="d-flex align-items-center gap-2 text-white">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <small>Pasuruan, Jawa Timur</small>
                        </div>
                        <div class="d-flex align-items-center gap-2 text-white">
                            <i class="fas fa-envelope text-primary"></i>
                            <small>bkk@smkn1.sch.id</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <span class="nav-title">Platform</span>
                    <a href="karir.html" class="nav-item-tech">Lowongan Kerja</a>
                    <a href="mitra.html" class="nav-item-tech">Mitra Industri</a>
                    <a href="informasi.html" class="nav-item-tech">Berita & Event</a>
                    <a href="visimisi.html" class="nav-item-tech">Visi & Misi</a>
                </div>
                <div class="col-lg-2 col-6">
                    <span class="nav-title">Alumni</span>
                    <a href="login.html" class="nav-item-tech">Login Portal</a>
                    <a href="register.html" class="nav-item-tech">Registrasi</a>
                    <a href="#" class="nav-item-tech">Tracer Study</a>
                    <a href="karir.html" class="nav-item-tech">Panduan Karir</a>
                </div>
                <div class="col-lg-3">
                    <div class="newsletter-box">
                        <span class="nav-title mb-3 d-block">Dapatkan Info Loker</span>
                        <p class="small text-muted mb-3">
                            Notifikasi lowongan terbaru langsung ke email Anda.
                        </p>
                        <form>
                            <input
                                type="email"
                                class="input-tech"
                                placeholder="Email Anda..." />
                            <button class="btn-tech-submit">Berlangganan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer-bottom-tech">
                <div>&copy; 2025 BKK SMKN 1 Purwosari. All rights reserved.</div>
                <div class="d-flex align-items-center">
                    <a href="https://www.instagram.com/" class="social-link-tech"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/" class="social-link-tech"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.youtube.com/" class="social-link-tech"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/" class="social-link-tech"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
        <div class="modal-dialog login-pop-form" role="document">
            <div class="modal-content" id="loginmodal">
                <div class="modal-headers">
                    <button type="button" class="border-0 close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="m-0 ft-regular">Login</h2>
                    </div>

                    <form>
                        <div class="form-group mb-3">
                            <label class="mb-2">User Name</label>
                            <input type="text" class="form-control" placeholder="Username*">
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-2">Password</label>
                            <input type="password" class="form-control" placeholder="Password*">
                        </div>

                        <div class="form-group mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <input id="dd" class="checkbox-custom" name="dd" type="checkbox">
                                    <label for="dd" class="checkbox-custom-label">Remember Me</label>
                                </div>
                                <div class="eltio_k2">
                                    <a href="#">Lost Your Password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit"
                                class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                        </div>

                        <div class="form-group text-center mb-0">
                            <p class="extra">Not a member?<a href="#et-register-wrap" class="text-dark">
                                    Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--  Main jQuery  -->
    <!-- <script data-cfasync="false" src="https://demo.egenslab.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/jquery-ui.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/moment.min.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/daterangepicker.min.js"></script>

    <!-- Popper and Bootstrap JS -->
    <!-- <script src="<?php echo base_url('assets/frontpage') ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/popper.min.js"></script> -->
    <!-- Swiper slider JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/slick.js"></script>
    <!-- Waypoints JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/waypoints.min.js"></script>
    <!-- Counterup JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/jquery.counterup.min.js"></script>
    <!-- Nice Select JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/jquery.nice-select.min.js"></script>
    <!-- Wow JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/wow.min.js"></script>
    <!-- Gsap  JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/gsap.min.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/ScrollTrigger.min.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/jquery.fancybox.min.js"></script>
    <script src="<?php echo base_url('assets/backend/libs/sweetalert2/dist/sweetalert2.min.js') ?>"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/frontpage') ?>/js/select-dropdown.js"></script>
    <script src="<?php echo base_url('assets/frontpage') ?>/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="<?= base_url('assets/frontpage/') ?>script.js"></script>
    <script>
        function logout_confirm() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan keluar dari sesi dan kembali ke halaman login!",
                type: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'YA, Logout',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    location.href = '<?php echo site_url('authentication/logout') ?>';
                }
            })
        }
    </script>

    <script>
        AOS.init({
            once: true,
            duration: 800
        });

        // 1. TYPING EFFECT
        const textElement = document.getElementById("typing-text");
        const texts = ["Industri Global", "Masa Depan", "Karir Sukses"];
        let count = 0;
        let index = 0;
        let currentText = "";
        let letter = "";

        (function type() {
            if (count === texts.length) {
                count = 0;
            }
            currentText = texts[count];
            letter = currentText.slice(0, ++index);

            if (textElement) {
                textElement.textContent = letter;
                if (letter.length === currentText.length) {
                    count++;
                    index = 0;
                    setTimeout(type, 2000); // Wait before next word
                } else {
                    setTimeout(type, 100);
                }
            }
        })();

        // 2. COUNTER ANIMATION
        const counters = document.querySelectorAll(".counter");
        const speed = 200;

        let counterObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = +counter.getAttribute("data-target");
                        const inc = target / speed;

                        const updateCount = () => {
                            const count = +counter.innerText;
                            if (count < target) {
                                counter.innerText = Math.ceil(count + inc);
                                setTimeout(updateCount, 20);
                            } else {
                                counter.innerText = target + "+";
                            }
                        };
                        updateCount();
                        observer.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            }
        );

        counters.forEach((counter) => {
            counterObserver.observe(counter);
        });

        // 3. FILTER FUNCTION
        function filterSelection(c) {
            var x, i;
            x = document.getElementsByClassName("filter-item");
            if (c == "all") c = "";
            for (i = 0; i < x.length; i++) {
                w3RemoveClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
            }
            var btns = document.getElementsByClassName("btn-filter-pro");
            for (i = 0; i < btns.length; i++) {
                btns[i].className = btns[i].className.replace(" active", "");
            }
            event.currentTarget.className += " active";
        }

        function w3AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                    element.className += " " + arr2[i];
                }
            }
        }

        function w3RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                    arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
        }

        // Add custom style for filter show
        const style = document.createElement("style");
        style.innerHTML = `
            .filter-item { display: none; }
            .filter-item.show { display: block; animation: fadeIn 0.5s ease; }
            @keyframes fadeIn { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        `;
        document.head.appendChild(style);

        // Init filter
        filterSelection("all");
    </script>
    <script>
        AOS.init();
    </script>

    <!-- <script>
        // Ambil semua elemen nav-link
        const navLinks = document.querySelectorAll('.nav-link');
        const menuToggle = document.getElementById('navbarNav');
        const bsCollapse = new bootstrap.Collapse(menuToggle, {
            toggle: false
        });

        navLinks.forEach((l) => {
            l.addEventListener('click', () => {
                // Cek apakah menu sedang terbuka (memiliki class 'show')
                if (menuToggle.classList.contains('show')) {
                    bsCollapse.toggle();
                }
            })
        })
    </script> -->
    <script>
        // Ambil semua elemen nav-link
        const navLinks = document.querySelectorAll('.nav-link');
        const menuToggle = document.getElementById('navbarNav');

        // Pastikan elemen ada sebelum dijalankan agar tidak error
        if (menuToggle) {
            const bsCollapse = new bootstrap.Collapse(menuToggle, {
                toggle: false
            });

            navLinks.forEach((l) => {
                l.addEventListener('click', (e) => {
                    // FIX: Cek apakah yang diklik adalah dropdown-toggle
                    // Jika IYA (itu tombol dropdown), jangan tutup menunya!
                    if (l.classList.contains('dropdown-toggle')) {
                        return;
                    }

                    // Cek apakah menu sedang terbuka (memiliki class 'show')
                    if (menuToggle.classList.contains('show')) {
                        bsCollapse.toggle();
                    }
                })
            })
        }
    </script>

</body>

</html>