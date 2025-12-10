<!DOCTYPE html>
<html lang="ID" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BKK - Login</title>
    <meta name="google" content="notranslate">
    <meta name="theme-color" content="#C62E2E">
    <link rel="icon" href="<?php echo base_url('assets/logosmkn.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/authentication/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontpage/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendors/jquery-easy-loading/dist/jquery.loading.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendors/sweetalert2/dist/sweetalert2.min.css') ?>">
    <link href="<?php echo base_url('assets/backend') ?>/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/vendors/jquery-easy-loading/dist/jquery.loading.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendors/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
    <script type="text/javascript" charset="utf-8" async defer>
        function updateCSRF(value) {
            return $('input[name=csrf_myapp]').val(value);
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
        }

        /* --- SETTINGAN UMUM (DESKTOP) --- */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            width: 100%;
            overflow: hidden;
            /* Mencegah scroll samping */
        }

        /* Bagian Gambar Kiri (Desktop) */
        .login-side-image {
            flex: 1;
            /* Mengisi sisa ruang */
            /* Gambar background gedung/tanaman */
            background: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070') center center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 3rem;
        }

        .login-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.3), rgba(15, 23, 42, 0.9));
        }

        /* Bagian Form Kanan (Desktop lebar tetap 550px) */
        .login-content {
            flex: 0 0 550px;
            background: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        /* Custom Tabs & Form Styling */
        .nav-pills-custom .nav-link {
            color: #94a3b8;
            background: #f1f5f9;
            font-weight: 600;
            margin-right: 10px;
            border-radius: 8px;
            width: 100%;
            text-align: center;
        }

        .nav-pills-custom .nav-link.active {
            background: #0f172a;
            color: white;
        }

        .form-floating-custom input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
        }

        .form-floating-custom input:focus {
            border-color: #0f172a;
            box-shadow: none;
        }

        .text-accent {
            color: #f59e0b;
        }

        /* =========================================
           SETTINGAN KHUSUS HP (RESPONSIVE)
           ========================================= */
        @media (max-width: 991px) {

            /* 1. Sembunyikan Bagian Gambar Samping */
            .login-side-image {
                display: none !important;
            }

            /* 2. Lebarkan Form Menjadi 100% Layar */
            .login-content {
                flex: 1;
                /* Ambil semua ruang */
                width: 100%;
                padding: 2rem;
                /* Padding lebih kecil di HP */
            }

            /* 3. Sesuaikan ukuran font judul biar tidak terlalu besar */
            h2.fw-bold {
                font-size: 1.8rem;
            }
        }

        /* --- COPY KODE INI KE BARIS PALING BAWAH CSS KAMU --- */

        @media (max-width: 991px) {

            /* 1. Hilangkan gambar samping saat di HP */
            .login-side-image {
                display: none !important;
            }

            /* 2. Paksa Form jadi Full Layar (100%) */
            .login-content {
                flex: 0 0 100% !important;
                width: 100% !important;
                max-width: 100% !important;
            }
        }

        /* --- GANTI KODE BAGIAN PALING BAWAH DENGAN INI --- */

        @media (max-width: 991px) {

            /* 1. Tampilkan Gambar Gedung sebagai Background Utama di HP */
            .login-wrapper {
                /* Gambar yang sama dengan versi desktop */
                background: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070') center center/cover no-repeat;
                /* Tambahkan padding agar form tidak nempel pinggir layar */
                padding: 20px;
                /* Posisikan form di tengah layar */
                align-items: center;
                justify-content: center;
            }

            /* 2. Sembunyikan pembungkus gambar kiri (karena gambarnya sudah pindah ke background utama) */
            .login-side-image {
                display: none !important;
            }

            /* 3. Ubah Form Putih Polos menjadi "Kartu Keren" */
            .login-content {
                flex: unset !important;
                /* Matikan lebar full paksa */
                width: 100% !important;
                max-width: 450px !important;
                /* Batasi lebar agar enak dilihat */

                /* Dekorasi Kartu */
                border-radius: 24px;
                /* Sudut melengkung */
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
                /* Bayangan hitam agar timbul */

                /* Efek Kaca (Glassmorphism) Sedikit Transparan */
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);

                /* Jarak dalam kartu */
                padding: 2.5rem !important;
                margin: auto;
            }

            /* 4. Pemanis Tambahan: Mempercantik Input di HP */
            .form-control {
                background-color: #f8fafc;
                /* Input agak abu dikit biar kontras */
                border-radius: 12px;
            }

            /* Tombol Login jadi Full Width dan Bulat */
            .btn {
                border-radius: 50px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>

<body>
    <?php echo $this->template->content ?>
    <script>
        function initselect(context = document) {
            $(context).find('.select2').each(function() {
                var $select = $(this);

                // Cegah inisialisasi ulang
                if ($select.data('inited')) return;

                var placeholder = $select.find('option:first').text(),
                    selectedOption = $select.find('option:selected'),
                    selectedValue = selectedOption.val(),
                    selectedText = selectedOption.text(),
                    options = [];

                // Ambil data option
                $select.find('option').each(function() {
                    var $opt = $(this);
                    options.push({
                        value: $opt.attr('value'),
                        text: $opt.text(),
                        disabled: $opt.prop('disabled'),
                        selected: $opt.prop('selected')
                    });
                });

                // Buat elemen custom
                var $wrapper = $('<div class="custom-select-wrapper"></div>'),
                    $input = $('<input type="text" class="custom-select-input" placeholder="' + placeholder + '">'),
                    $list = $('<div class="custom-select-dropdown"></div>'),
                    $notfound = $('<div class="custom-select-notfound" style="display:none; color:#888; padding:5px;">Data tidak ditemukan</div>');

                // Tambahkan items ke dropdown
                options.forEach(function(opt) {
                    var $item = $('<div class="custom-select-item"></div>')
                        .text(opt.text)
                        .attr('data-value', opt.value);

                    if (opt.disabled) {
                        $item.addClass('disabled').css({
                            color: '#ccc',
                            pointerEvents: 'none'
                        });
                    }

                    $list.append($item);
                });

                $list.append($notfound);

                // Ganti select dengan wrapper
                $select.hide().after($wrapper);
                $wrapper.append($input).append($list);

                // Set selected jika ada
                if (selectedValue && !selectedOption.prop('disabled') && selectedValue !== '') {
                    $input.val(selectedText);
                }

                // Event: klik input → toggle dropdown
                $input.on('click', function(e) {
                    e.stopPropagation();
                    $('.custom-select-dropdown').not($list).hide();
                    $list.toggle();
                });

                // Event: pilih item
                $list.on('click', '.custom-select-item:not(.disabled)', function() {
                    var v = $(this).data('value'),
                        t = $(this).text();
                    $input.val(t);
                    $select.val(v).trigger('change');
                    $list.hide();
                });

                // Event: klik di luar → tutup semua
                $(document).on('click', function() {
                    $list.hide();
                });

                // Prevent input manual
                $input.on('blur', function() {
                    var currentText = $input.val().toLowerCase();
                    var matched = options.find(function(opt) {
                        return !opt.disabled && opt.text.toLowerCase() === currentText;
                    });
                    if (!matched) {
                        $input.val('');
                        $select.val('').trigger('change');
                    }
                });

                // Searchable input
                $input.prop('readonly', false).on('input', function() {
                    var term = $input.val().toLowerCase();
                    var found = false;
                    $list.children('.custom-select-item').each(function() {
                        var txt = $(this).text().toLowerCase();
                        var isMatch = txt.indexOf(term) > -1;
                        $(this).toggle(isMatch);
                        if (isMatch) found = true;
                    });

                    $notfound.toggle(!found);
                    $list.show();
                });

                // Tandai sudah di-init
                $select.data('inited', true);
            });
        }


        $(document).ready(function() {
            initselect();
        });
    </script>
    <script src="<?php echo base_url('assets/authentication/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/authentication/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend') ?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/authentication/js/main.js'); ?>"></script>
</body>

</html>