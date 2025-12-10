<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Bursa Kerja Khusus SMK Negeri 1 Purwosari</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="images/jpeg" href="<?php echo base_url('assets/logosmkn.png') ?>">
    <link href="<?php echo base_url('assets/backend') ?>/css/app.min.css" rel="stylesheet" type="text/css"
        id="app-style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link href="<?php echo base_url('assets/backend') ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('assets/vendors/jquery-easy-loading/dist/jquery.loading.min.css') ?>">
    <script src="<?php echo base_url('assets/backend') ?>/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/vendors/jquery-easy-loading/dist/jquery.loading.min.js') ?>"></script>
    <link href="<?php echo base_url("assets/backend/libs/sweetalert2/dist/sweetalert2.min.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/backend/libs/simple-datatables/style.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url() ?>assets/backend/libs/mobius1-selectr/selectr.min.css" rel="stylesheet"
        type="text/css" />

</head>
<script type="text/javascript" charset="utf-8" async defer>
    function updateCSRF(value) {
        return $('input[name=csrf_myapp]').val(value);
    }

    function myCSRF(value) {
        return $('input[name=csrf_cadangan]').val(value);
    }
</script>
<style>
    li .active {
        color: #1e293b !important;
        font-weight: 500 !important;
        /* background-color: rgba(0, 208, 255, 0.56) !important; */
    }

    li .subactive {
        color: #60a3bc !important;
        font-weight: 500 !important;
    }

    .tp-link:hover {
        color: #60a3bc !important;
    }

    .swal2-container {
        z-index: 20000 !important;
        background: rgba(30, 41, 59, 0.5) !important;
        backdrop-filter: blur(1px);
    }

    .swal2-content {
        text-align: center !important;
    }

    .swal2-popup {
        border-radius: 12px !important;
        background: #f8fafc !important;
        box-shadow: 0 4px 24px rgba(31, 38, 135, 0.10) !important;
        padding: 2rem 1.5rem !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .swal2-title {
        color: #1e293b !important;
        font-size: 1.3rem !important;
        font-weight: 600 !important;
        margin-bottom: .5rem !important;
    }

    .swal2-html-container {
        color: #334155 !important;
        font-size: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .swal2-confirm,
    .swal2-cancel {
        border-radius: 6px !important;
        font-weight: 500 !important;
        padding: .5rem 1.2rem !important;
        border: none !important;
        min-width: 90px;
    }

    .swal2-confirm {
        background: #2563eb !important;
        color: #fff !important;
    }

    .swal2-confirm:hover,
    .swal2-confirm:focus {
        background: #1d4ed8 !important;
    }

    .swal2-cancel {
        background: #f1f5f9 !important;
        color: #64748b !important;
        margin-left: .5rem !important;
    }

    .swal2-cancel:hover,
    .swal2-cancel:focus {
        background: #e2e8f0 !important;
        color: #334155 !important;
    }

    .swal2-icon-text {
        font-size: 3.2em !important;
        animation: swal2-pop 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        display: inline-block;
        text-align: center;
    }

    @keyframes swal2-pop {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }

        80% {
            transform: scale(1.1);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .hr-text {
        display: flex;
        align-items: center;
        text-align: center;
        margin-top: 1rem !important;
    }

    .hr-text::before,
    .hr-text::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #ccc;
    }

    .hr-text::before {
        margin-right: 0.75rem;
    }

    .hr-text::after {
        margin-left: 0.75rem;
    }

    .custom-select-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .custom-select-input {
        width: 100%;
        box-sizing: border-box;
        padding: 0.5em;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .custom-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 250px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background: #fff;
        z-index: 99999;
        display: none;
    }

    .custom-select-item {
        padding: 0.5em;
        cursor: pointer;
    }

    .custom-select-item:hover {
        background: #f0f0f0;
    }

    /* Bottom navbar default: hidden */
    .bottom-nav {
        display: none;
    }

    /* Mobile only */
    @media (max-width: 768px) {
        .bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: #1f1f1f;
            /* abu gelap */
            border-top: 1px solid #333;
            justify-content: space-around;
            align-items: center;
            z-index: 9999;
        }

        .bottom-nav a {
            text-align: center;
            font-size: 12px;
            color: #cfcfcf;
            /* abu terang */
        }

        .bottom-nav i {
            font-size: 20px;
            display: block;
            margin-bottom: 3px;
            color: #e5e5e5;
        }

        /* Active hover effect */
        .bottom-nav a:active i,
        .bottom-nav a:active {
            color: #ffffff;
        }

        /* Sidebar hide */
        .sidebar {
            display: none;
        }
    }
</style>
<!-- body start -->

<body data-menu-color="light" data-sidebar="default" id="body">

    <!-- Begin page -->
    <div id="app-layout">

        <!-- Topbar Start -->
        <div class="topbar-custom">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li>
                            <button class="button-toggle-menu nav-link">
                                <i class="fas fa-bars noti-icon"></i>
                            </button>
                        </li>
                        <li class="d-none d-lg-block">
                            <h5 class="mb-0"> <?php echo howdy(userdata()->user_fullname) ?> </h5>
                        </li>
                    </ul>

                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" data-toggle="fullscreen">
                                <i class="fas fa-expand align-middle fullscreen noti-icon"></i>
                            </button>
                        </li>

                        <!-- PROFILE MENU START -->
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo base_url('assets') ?>/user-black.png" alt="user-image"
                                    class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    <?php echo userdata()->username ?> <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="<?php echo base_url('dashboard/settings') ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <!-- <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                                    <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
                                    <span>Lock Screen</span>
                                </a> -->

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a onclick="logout_confirm()" class="dropdown-item notify-item">
                                    <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <div class="logo-box">
                        <a href="<?php echo base_url('dashboard') ?>" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('assets/') ?>logosmkn.png" alt="" height="60">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('assets/') ?>logosmkn.png" alt="" height="70">
                            </span>
                        </a>
                        <!-- <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url('assets/backend') ?>/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url('assets/backend') ?>/images/logo-dark.png" alt="" height="24">
                                </span>
                            </a> -->
                    </div>

                    <ul id="side-menu">
                        <!-- <li class="menu-title">Menu</li>
                        <li>
                            <a href="#sidebarDashboards" data-bs-toggle="collapse">
                                <i data-feather="home"></i>
                                <span> Dashboard </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="index.html" class="tp-link">CRM</a>
                                    </li>
                                    <li>
                                        <a href="analytics.html" class="tp-link">Analytics</a>
                                    </li>
                                    <li>
                                        <a href="ecommerce.html" class="tp-link">eCommerce</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#sidebarExpages" data-bs-toggle="collapse">
                                <i data-feather="file-text"></i>
                                <span> Utility </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarExpages">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="pages-starter.html" class="tp-link">Starter</a>
                                    </li>
                                    <li>
                                        <a href="pages-profile.html" class="tp-link">Profile</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="menu-title mt-2">Apps</li>

                        <li>
                            <a href="apps-todolist.html" class="tp-link">
                                <i data-feather="columns"></i>
                                <span> Todo List </span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-contacts.html" class="tp-link">
                                <i data-feather="map-pin"></i>
                                <span> Contacts </span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-calendar.html" class="tp-link">
                                <i data-feather="calendar"></i>
                                <span> Calendar </span>
                            </a>
                        </li> -->


                    </ul>
                    <?php
                    $user_group = $this->ion_auth->get_users_groups()->row();
                    $status   = $userdata->user_status;

                    if ($status == 'admin') {
                        // MENU ADMIN
                        $array_menu = array(
                            array(
                                'heading' => 'DASHBOARD',
                                'data' => array(
                                    array(
                                        'title' => 'Dashboard',
                                        'icon' => 'fas fa-tachometer-alt',
                                        'url' => 'dashboard',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                            array(
                                'heading' => 'DATA',
                                'data' => array(
                                    array(
                                        'title' => 'Data Member',
                                        'icon' => 'fas fa-users',
                                        'url' => 'admin/data-member',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Data Staff',
                                        'icon' => 'fas fa-user-tie',
                                        'url' => 'admin/data-staff',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Data Mitra',
                                        'icon' => 'fas fa-handshake',
                                        'url' => 'admin/data-mitra',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Data Blog',
                                        'icon' => 'fas fa-file-alt',
                                        'url' => 'admin/blog',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Data Gallery',
                                        'icon' => 'fas fa-image',
                                        'url' => 'admin/gallery',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Faq',
                                        'icon' => 'fas fa-question-circle',
                                        'url' => 'admin/faq',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Testimoni',
                                        'icon' => 'fas fa-comment-dots',
                                        'url' => 'admin/testimoni',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                            array(
                                'heading' => 'SETTINGS',
                                'data' => array(
                                    array(
                                        'title' => 'Settings',
                                        'icon' => 'fas fa-cogs',
                                        'url' => 'dashboard/settings',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Kontak',
                                        'icon' => 'fas fa-address-book',
                                        'url' => 'admin/contact',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Kembali ke Beranda',
                                        'icon' => 'fas fa fa-home',
                                        'url' => '/',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Logout',
                                        'icon' => 'fas fa-sign-out-alt',
                                        'url' => 'logout',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                        );
                    } elseif ($status == 'staff') {
                        // MENU STAFF
                        $array_menu = array(
                            array(
                                'heading' => 'DASHBOARD',
                                'data' => array(
                                    array(
                                        'title' => 'Dashboard',
                                        'icon' => 'fas fa-tachometer-alt',
                                        'url' => 'dashboard',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                            array(
                                'heading' => 'STAFF',
                                'data' => array(
                                    array(
                                        'title' => 'Data Lowongan',
                                        'icon' => 'fas fa-briefcase',
                                        'url' => 'staff/lowongan',
                                        'submenu' => FALSE,
                                    ),
                                    // array(
                                    //     'title' => 'Data Lamaran',
                                    //     'icon' => 'fas fa-briefcase',
                                    //     'url' => 'staff/data-lamaran',
                                    //     'submenu' => FALSE,
                                    // ),
                                )
                            ),
                            array(
                                'heading' => 'SETTINGS',
                                'data' => array(
                                    array(
                                        'title' => 'Logout',
                                        'icon' => 'fas fa-sign-out-alt',
                                        'url' => 'logout',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Kembali ke Halaman Utama',
                                        'icon' => 'fas fa-sign-out-alt',
                                        'url' => '/',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                        );
                    } else {
                        // MENU MEMBER
                        $array_menu = array(
                            array(
                                'heading' => 'MENU',
                                'data' => array(
                                    array(
                                        'title' => 'Dashboard',
                                        'icon' => 'fas fa-home',
                                        'url' => 'dashboard',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Profile',
                                        'icon' => 'fas fa-user',
                                        'url' => 'dashboard/profile',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                            array(
                                'heading' => 'ACCOUNT',
                                'data' => array(
                                    array(
                                        'title' => 'Kembali ke Beranda',
                                        'icon' => 'fas fa fa-home',
                                        'url' => '/',
                                        'submenu' => FALSE,
                                    ),
                                    array(
                                        'title' => 'Logout',
                                        'icon' => 'fas fa-sign-out-alt',
                                        'url' => 'logout',
                                        'submenu' => FALSE,
                                    ),
                                )
                            ),
                        );
                    }

                    $uriNow = $this->uri->uri_string();   // url yang sedang dibuka
                    $counter = 0;                          // agar id #collapse unik
                    ?>

                    <ul id="side-menu">
                        <?php foreach ($array_menu as $group): ?>

                            <!-- Judul kelompok menu -->
                            <li class="menu-title<?= isset($group['class']) ? ' ' . $group['class'] : '' ?>">
                                <?= htmlspecialchars($group['heading'], ENT_QUOTES, 'UTF-8') ?>
                            </li>

                            <?php foreach ($group['data'] as $item): ?>
                                <?php
                                $hasSub = !empty($item['submenu']);
                                $isActive = $uriNow === $item['url'];
                                $openSub = false;

                                if ($hasSub) {
                                    /* cek apakah salah satu submenu sedang aktif */
                                    $subUrls = array_column($item['submenu'], 'url');
                                    $openSub = in_array($uriNow, $subUrls, true);

                                    /* pembuat id unik utk setiap collapse */
                                    $counter++;
                                    $collapseId = 'sidebarCollapse' . $counter;
                                }
                                ?>

                                <?php if ($hasSub): ?>
                                    <!-- ===== MENU BERSUB ===== -->
                                    <li>
                                        <a href="#<?= $collapseId ?>" data-bs-toggle="collapse"
                                            class="<?= $openSub ? 'active' : '' ?>">
                                            <i class="<?= $item['icon'] ?>"></i>
                                            <span> <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?> </span>
                                            <span class="menu-arrow"></span>
                                        </a>

                                        <div class="collapse <?= $openSub ? 'show' : '' ?>" id="<?= $collapseId ?>">
                                            <ul class="nav-second-level">
                                                <?php foreach ($item['submenu'] as $sub): ?>
                                                    <?php $subActive = $uriNow === $sub['url'] ? 'active' : ''; ?>
                                                    <li>
                                                        <a href="<?= site_url($sub['url']) ?>" class="tp-link <?= $subActive ?>">
                                                            <?= htmlspecialchars($sub['title'], ENT_QUOTES, 'UTF-8') ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </li>

                                <?php else: ?>
                                    <!-- ===== MENU TANPA SUB ===== -->
                                    <?php
                                    $logoutAttr = ($item['title'] === 'Logout') ? 'onclick="logout_confirm()"' : '';
                                    $href = ($item['title'] !== 'Logout')
                                        ? site_url($item['url'])
                                        : 'javascript:';
                                    ?>
                                    <li>
                                        <a href="<?= $href ?>" class="tp-link <?= $isActive ? 'active' : '' ?>" <?= $logoutAttr ?>>
                                            <i class="<?= $item['icon'] ?>"></i>
                                            <span> <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?> </span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="clearfix"></div>

            </div>
        </div>
        <div class="content-page">
            <div class="content">

                <?php if ($this->session->userdata('admin_userid') && ($this->session->userdata('admin_userid') != userid())):
                    $getgroups = $this->ion_auth->get_users_groups($this->session->userdata('admin_userid'))->row();
                    echo form_hidden('csrf_cadangan', $this->security->get_csrf_hash());
                ?>
                    <div class="alert alert-danger mt-5" role="alert" style="background: #e74c3c;color:#fff">
                        <?php echo 'ANDA LOGIN SEBAGAI <u><b>' . strtoupper($userdata->user_fullname) . '</b></u> <a href="javascript:" id="login-back-admin" class="badge bg-success p-2" style="color:#fff">KLIK DISINI</a> UNTUK KEMBALI KE ' . strtoupper($getgroups->name); ?>
                    </div>
                    <script type="text/javascript" charset="utf-8" async defer>
                        jQuery(document).ready(function($) {

                            $('#login-back-admin').click(function(event) {

                                $.ajax({
                                        url: '<?php echo site_url('postdata/public_post/auth/login_back_admin') ?>',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {
                                            userid: 1,
                                            csrf_myapp: $('input[name=csrf_cadangan]').val()
                                        }
                                    })
                                    .done(function(data) {

                                        swal(
                                            data.heading,
                                            data.message,
                                            data.type
                                        ).then(function() {
                                            location.href =
                                                '<?php echo site_url('dashboard') ?>';
                                        });

                                    });

                            });

                        });
                    </script>
                <?php endif ?>
                <div class="container-fluid">

                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

                        <div class="flex-grow-1">

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php echo $this->template->title ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <?php echo $this->template->content ?>
                </div>
            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> <span class="mdi mdi-heart text-danger"></span> by <a href="#!"
                                class="text-reset fw-semibold"> Laqueen International</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
    </div>
    <!-- Modal DinamicModals (Large Modal) -->
    <div class="modal fade" id="dinamicModals" tabindex="-1" aria-labelledby="dinamicModalsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa-spin"></i> loading ...
                </div>
            </div>
        </div>
    </div>
    <!-- Modal DinamicModal (Default Modal) -->
    <div class="modal fade" id="dinamicModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="dinamicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel2">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa-spin"></i> loading ...
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation for Mobile Only -->
    <nav class="bottom-nav">
        <a href="<?= site_url('/') ?>">
            <i class="fas fa-home"></i>
            Home
        </a>

        <a href="<?= site_url('dashboard') ?>">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>

        <a href="<?= site_url('dashboard/profile') ?>">
            <i class="fas fa-user"></i>
            Profil
        </a>

        <a href="javascript:void(0)" onclick="logout_confirm()">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </nav>

    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="<?php echo base_url('assets/backend') ?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/backend') ?>/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('assets/backend') ?>/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url('assets/backend') ?>/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url('assets/backend') ?>/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url('assets/backend') ?>/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url('assets/backend/libs/sweetalert2/dist/sweetalert2.min.js') ?>"></script>

    <script>
        if (!window.location.href.includes('bonus-unilevel')) {
            localStorage.setItem('activeUnilevel', '#unipending');
        }
        if (!window.location.href.includes('activeWD')) {
            localStorage.setItem('activeWD', '#pending');
        }

        // $(document).ready(function() {
        //     $('.select2-single').select2();
        // });
        $("#dinamicModals").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("data-bs-href"));
            $(this).find("#myModalLabel1").text(link.attr("data-bs-title"));
        });
        $("#dinamicModal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("data-bs-href"));
            $(this).find("#myModalLabel2").text(link.attr("data-bs-title"));
        });

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
        $(document).ready(function() {
            const selectids = [
                "#default-select",
                "#default-select1",
                "#default-select2",
                "#default-select3",
                "#default-select4"
            ];
            selectids.forEach(id => {
                const $select = $(id);
                if ($select.length) {
                    new Selectr($select[0]);

                }
            });
            const multiselectids = [
                "#multi-select",
                "#multi-select1",
                "#multi-select2",
                "#multi-select3",
                "#multi-select4"
            ];
            multiselectids.forEach(id => {
                const $multiselect = $(id);
                if ($multiselect.length) {
                    new Selectr($multiselect[0], {
                        multiple: !0
                    });

                }
            });
            // const $select = $("#default-select");

            // Array ID untuk datatable
            const datatableIds = [
                "#datatable_1",
                "#datatable_2",
                "#datatable_3",
                "#datatable_4",
                "#datatable_5"
            ];

            // Loop dan inisialisasi datatable jika elemen ada
            datatableIds.forEach(id => {
                const $table = $(id);
                if ($table.length) {
                    const options = {
                        searchable: true,
                        fixedHeight: false
                    };

                    // Jika datatable_5, nonaktifkan sorting
                    if (id === "#datatable_5") {
                        options.sortable = false;
                    }

                    new simpleDatatables.DataTable($table[0], options);
                }
            });

            document.querySelectorAll('.dataTable-dropdown label').forEach(function(label) {
                const select = label.querySelector('select');
                label.innerHTML = '';
                label.appendChild(select);
            });
        });
    </script>
    <script src="<?php echo base_url('assets/backend') ?>/js/app.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/libs/mobius1-selectr/selectr.min.js"></script>

</body>

</html>