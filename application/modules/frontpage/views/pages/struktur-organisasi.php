<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Struktur Organisasi</title>

    <?php
    // LOGIC PHP
    $count_admin  = $this->db->where('user_status', 'admin')->count_all_results('tb_users');
    $count_staff  = $this->db->where('user_status', 'staff')->count_all_results('tb_users');
    $count_member = $this->db->where('user_status', 'member')->count_all_results('tb_users');
    ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================= VARIABLES ================= */
        :root {
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --primary: #0d6efd;
            --dark-text: #0f172a;
            --gray-text: #64748b;
            --bg-light: #f8fafc;
            --card-bg: #ffffff;
            
            --grad-text: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            --grad-glow: radial-gradient(circle at 50% 50%, rgba(13, 110, 253, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            
            --admin-grad: linear-gradient(135deg, #FFC75F 0%, #FF9642 100%);
            --staff-grad: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --member-grad: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        body {
            margin: 0; padding: 0;
            background-color: var(--bg-light);
            font-family: var(--font-body);
            color: var(--dark-text);
            overflow-x: hidden;
        }

        /* ================= HERO SECTION ================= */
        .org-hero-section {
            position: relative;
            padding: 3rem 1rem 2rem;
            background-color: var(--bg-light);
            background-image: var(--grad-glow);
            overflow: hidden;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }

        .hero-shape {
            position: absolute; width: 200px; height: 200px;
            filter: blur(60px); border-radius: 50%; z-index: 0; opacity: 0.5;
        }
        .shape-left { top: -40px; left: -60px; background: linear-gradient(180deg, rgba(13, 110, 253, 0.1), transparent); }
        .shape-right { bottom: -40px; right: -40px; background: linear-gradient(180deg, rgba(255, 193, 7, 0.1), transparent); }

        .hero-content { position: relative; z-index: 1; }

        .badge-modern {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 12px; background: #fff; border: 1px solid #e2e8f0;
            border-radius: 50px; margin-bottom: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--primary); }
        .badge-text { font-size: 11px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px; }

        .hero-heading {
            font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800;
            line-height: 1.1; margin: 0 0 10px 0;
            background: var(--grad-text); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        .hero-sub {
            font-size: 1rem; color: var(--gray-text); max-width: 600px;
            margin: 0 auto 2rem; line-height: 1.5;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;
            max-width: 900px; margin: 0 auto;
        }
        .stat-card {
            background: #fff; padding: 15px 10px; border-radius: 12px;
            border: 1px solid #f1f5f9; text-align: center; position: relative; overflow: hidden;
        }
        /* Garis warna di bawah card stats */
        .stat-card::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
        }
        .stat-admin::after { background: #f59e0b; }
        .stat-staff::after { background: #0d6efd; }
        .stat-member::after { background: #10b981; }

        .stat-count { font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; }
        .stat-label { font-size: 0.7rem; color: var(--gray-text); font-weight: 600; text-transform: uppercase; margin-top: 2px; }

        /* ================= TREE STRUCTURE ================= */
        .tree-container {
            display: flex; flex-direction: column; align-items: center;
            padding: 0 10px 60px; max-width: 1200px; margin: 0 auto;
        }

        .tree-level {
            display: flex; justify-content: center; flex-wrap: wrap;
            gap: 25px; width: 100%; position: relative; z-index: 2;
        }

        .connector {
            height: 30px; width: 2px; background-color: #cbd5e0; margin: 0 auto 15px; position: relative;
        }
        .connector::after {
            content: ""; position: absolute; bottom: -4px; left: -3px;
            width: 8px; height: 8px; background: #cbd5e0; border-radius: 50%;
        }

        /* CARD DESIGN */
        .modern-card {
            background: var(--card-bg); border-radius: 12px;
            width: 260px; /* Default Desktop Width */
            position: relative; box-shadow: 0 4px 6px rgba(0,0,0,0.04);
            overflow: hidden; transition: transform 0.3s ease;
            border: 1px solid #edf2f7; display: flex; flex-direction: column;
        }
        .modern-card:hover { transform: translateY(-5px); }

        .card-banner { height: 60px; width: 100%; }
        .banner-admin { background: var(--admin-grad); }
        .banner-staff { background: var(--staff-grad); }
        .banner-member { background: var(--member-grad); }

        .card-avatar {
            width: 60px; height: 60px; border-radius: 50%; background: #fff;
            margin: -30px auto 8px; display: flex; align-items: center; justify-content: center;
            font-size: 20px; font-weight: 700; color: #4a5568;
            border: 3px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05); position: relative; z-index: 2;
        }

        .card-content {
            padding: 0 12px 15px; text-align: center; flex-grow: 1; display: flex; flex-direction: column;
        }

        .badge-role {
            display: inline-block; padding: 3px 8px; border-radius: 12px;
            font-size: 10px; font-weight: 700; text-transform: uppercase; margin-bottom: 6px;
        }
        .role-admin { background: #fff7ed; color: #d97706; }
        .role-staff { background: #ebf8ff; color: #3182ce; }
        .role-member { background: #f0fdf4; color: #059669; }

        .user-fullname {
            font-size: 15px; font-weight: 700; color: var(--dark-text);
            line-height: 1.2; margin-bottom: 2px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .user-username { font-size: 11px; color: var(--gray-text); margin-bottom: 10px; }

        .info-box {
            background: #f8fafc; border-radius: 8px; padding: 8px;
            margin-bottom: 10px; text-align: left;
        }
        .info-row {
            display: flex; align-items: center; gap: 6px; font-size: 10px; color: #64748b; margin-bottom: 4px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .info-row:last-child { margin-bottom: 0; }
        .info-row svg { width: 12px; height: 12px; opacity: 0.7; min-width: 12px; }

        .btn-action {
            margin-top: auto; background: #fff; border: 1px solid #e2e8f0;
            color: var(--dark-text); padding: 6px; border-radius: 6px;
            font-size: 11px; font-weight: 600; text-decoration: none;
            display: flex; align-items: center; justify-content: center; gap: 4px;
        }

        /* ==========================================
           KHUSUS HP (MEDIA QUERY MOBILE)
           ========================================== */
        @media (max-width: 768px) {
            /* 1. Header menyesuaikan */
            .hero-heading { font-size: 1.8rem; }
            .hero-sub { font-size: 0.9rem; margin-bottom: 1.5rem; }
            
            /* 2. Grid Level Tree - KUNCI 2 KOLOM */
            .tree-level {
                gap: 10px; /* Jarak antar kartu lebih rapat */
                padding: 0 10px; /* Padding wadah */
            }

            /* 3. Ukuran Kartu di HP */
            .modern-card {
                /* Kalkulasi: (100% layar - jarak gap) dibagi 2 */
                width: calc(50% - 6px); 
                max-width: none; /* Hilangkan batas max desktop */
                min-width: 0; /* Biarkan mengecil */
            }

            /* 4. Penyesuaian Elemen Dalam Kartu agar Muat */
            .card-banner { height: 45px; } /* Banner lebih pendek */
            
            .card-avatar {
                width: 45px; height: 45px; font-size: 16px; margin-top: -25px;
            }
            
            .user-fullname { font-size: 13px; } /* Font nama lebih kecil */
            .user-username { font-size: 10px; margin-bottom: 6px; }
            
            .info-box { padding: 6px; }
            .info-row { font-size: 9px; } /* Font info sangat kecil agar tidak putus */
            
            .badge-role { font-size: 9px; padding: 2px 6px; }
        }
    </style>
</head>
<body>

<div class="org-hero-section">
    <div class="hero-shape shape-left"></div>
    <div class="hero-shape shape-right"></div>

    <div class="container hero-content text-center">
        <div class="badge-modern">
            <span class="badge-dot"></span>
            <span class="badge-text">Struktur & Tim</span>
        </div>

        <h1 class="hero-heading">Ecosystem</h1>

        <p class="hero-sub">
            Data anggota & hirarki terdaftar secara <em>real-time</em>.
        </p>

        <div class="stats-grid">
            <div class="stat-card stat-admin">
                <div class="stat-count"><?= number_format($count_admin) ?></div>
                <div class="stat-label">Admin</div>
            </div>
            <div class="stat-card stat-staff">
                <div class="stat-count"><?= number_format($count_staff) ?></div>
                <div class="stat-label">Staff</div>
            </div>
            <div class="stat-card stat-member">
                <div class="stat-count"><?= number_format($count_member) ?></div>
                <div class="stat-label">Member</div>
            </div>
        </div>
    </div>
</div>

<div class="tree-container">

    <div class="tree-level">
        <div class="modern-card">
            <div class="card-banner banner-admin"></div>
            <div class="card-avatar">A</div>
            <div class="card-content">
                <div>
                    <span class="badge-role role-admin">Admin</span>
                    <div class="user-fullname">Super Admin</div>
                    <div class="user-username">@superadmin</div>
                </div>
                <div class="info-box">
                    <div class="info-row">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        admin@sys.com
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="connector"></div>

    <div class="tree-level">
        <?php
        $limit  = 15;
        $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
        $this->db->order_by('created_on', 'DESC');
        $this->db->where('user_status', 'staff');

        if ($this->input->get('search')) {
            $s = $this->input->get('search');
            $this->db->group_start();
            $this->db->like('username', $s);
            $this->db->or_like('user_fullname', $s);
            $this->db->group_end();
        }

        $staffData = $this->db->get('tb_users', $limit, $offset);

        foreach ($staffData->result() as $staff) { 
            $initial = strtoupper(substr($staff->username, 0, 1));
        ?>
            <div class="modern-card">
                <div class="card-banner banner-staff"></div>
                <div class="card-avatar" style="color: #3182ce; border-color: #ebf8ff;"><?= $initial ?></div>
                <div class="card-content">
                    <div>
                        <span class="badge-role role-staff">Staff</span>
                        <div class="user-fullname"><?= $staff->user_fullname ?></div>
                        <div class="user-username">@<?= $staff->username ?></div>
                    </div>
                    <div class="info-box">
                        <div class="info-row" title="<?= $staff->email ?>">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            <span style="overflow: hidden; text-overflow: ellipsis;"><?= $staff->email ?></span>
                        </div>
                        <div class="info-row">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                            <?= date('d/m/y', $staff->created_on) ?>
                        </div>
                    </div>
                    <a href="https://wa.me/<?= $staff->user_phone ?>" target="_blank" class="btn-action">
                        <svg style="width:14px; fill:#25D366;" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Chat
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="connector"></div>

    <div class="tree-level">
        <?php
        $this->db->order_by('created_on', 'DESC');
        $this->db->where('user_status', 'member');
        if ($this->input->get('search')) {
            $s = $this->input->get('search');
            $this->db->group_start();
            $this->db->like('username', $s);
            $this->db->or_like('user_fullname', $s);
            $this->db->group_end();
        }
        $memberData = $this->db->get('tb_users', $limit, $offset);

        foreach ($memberData->result() as $user) { 
            $initial = strtoupper(substr($user->username, 0, 1));
        ?>
            <div class="modern-card">
                <div class="card-banner banner-member"></div>
                <div class="card-avatar" style="color: #059669; border-color: #f0fdf4;"><?= $initial ?></div>
                <div class="card-content">
                    <div>
                        <span class="badge-role role-member">Member</span>
                        <div class="user-fullname"><?= $user->user_fullname ?></div>
                        <div class="user-username">@<?= $user->username ?></div>
                    </div>
                    <div class="info-box">
                        <div class="info-row" title="<?= $user->email ?>">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            <span style="overflow: hidden; text-overflow: ellipsis;"><?= $user->email ?></span>
                        </div>
                        <div class="info-row">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                            <?= date('d/m/y', $user->created_on) ?>
                        </div>
                    </div>
                    <a href="https://wa.me/<?= $user->user_phone ?>" target="_blank" class="btn-action">
                        <svg style="width:14px; fill:#25D366;" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Chat
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>