<style>
    body {
        background-color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: #fff;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: #fff;
        font-size: 1.5rem;
        flex-shrink: 0; /* Mencegah icon tergencet */
    }

    .bg-gradient-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .bg-gradient-green { background: linear-gradient(135deg, #10b981, #059669); }
    .bg-gradient-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .bg-gradient-orange { background: linear-gradient(135deg, #f97316, #ea580c); }
    .bg-gradient-pink { background: linear-gradient(135deg, #ec4899, #db2777); }
    .bg-gradient-teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }

    .count {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
    }

    .card-title {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
    }

    /* Member Area Layout */
    .member-area {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        padding: 1rem; /* Tambahan safety padding */
    }

    .big-clock {
        font-size: 4rem; /* Default Desktop */
        font-weight: 800;
        color: #334155;
        font-family: 'Courier New', monospace;
        line-height: 1.2;
    }

    .welcome-text {
        font-size: 2rem;
        font-weight: bold;
        color: #1e293b;
        margin-top: 20px;
    }

    /* --- PERBAIKAN RESPONSIVE (MEDIA QUERIES) --- */
    @media (max-width: 768px) {
        /* Saat di layar Tablet/HP */
        .big-clock {
            font-size: 2.5rem; /* Ukuran font dikecilkan agar muat */
        }
        .welcome-text {
            font-size: 1.5rem; /* Nama user agak dikecilkan */
        }
        .count {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        /* Saat di layar HP Kecil */
        .big-clock {
            font-size: 2rem; /* Lebih kecil lagi */
        }
    }
</style>

<?php
// ===============================
// 1. Ambil Nama User
// ===============================
$nama_asli = "User";

$user_id = $this->session->userdata('user_id') ?: $this->session->userdata('id');

if (!empty($user_id)) {
    $query = $this->db->get_where('tb_users', ['id' => $user_id]);
    if ($query->num_rows() > 0) {
        $data_user = $query->row();

        if (!empty($data_user->first_name)) {
            $nama_asli = $data_user->first_name . (!empty($data_user->last_name) ? " " . $data_user->last_name : "");
        } elseif (!empty($data_user->username)) {
            $nama_asli = $data_user->username;
        } elseif (!empty($data_user->email)) {
            $nama_asli = explode("@", $data_user->email)[0];
        }
    }
}

if (is_numeric($nama_asli)) $nama_asli = "Member";

// ===============================
// 2. Ambil Role
// ===============================
$user_status = !empty($data_user->user_status) ? strtolower($data_user->user_status) : 'member';

$isAdmin  = ($user_status === 'admin');
$isStaff  = ($user_status === 'staff');
$isMember = ($user_status === 'member');

// ===============================
// 3. Hitung Data jika admin
// ===============================
$totblog = $totmember = $totstaff = $totgallery = $tottest = $totpesan = 0;

if ($isAdmin) {
    $totblog    = $this->db->table_exists('tb_blog') ? $this->db->get('tb_blog')->num_rows() : 0;
    $totmember  = $this->db->table_exists('tb_users') ? $this->db->get('tb_users')->num_rows() : 0;
    $totstaff   = $totmember; // sama sumber
    $totgallery = $this->db->table_exists('tb_gallery') ? $this->db->get('tb_gallery')->num_rows() : 0;
    $tottest    = $this->db->table_exists('tb_testimoni') ? $this->db->get('tb_testimoni')->num_rows() : 0;
    $totpesan   = $this->db->table_exists('tb_kontak') ? $this->db->get('tb_kontak')->num_rows() : 0;
}
?>

<?php if ($isAdmin): ?>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="p-4 rounded-3 text-white shadow-sm" style="background: linear-gradient(135deg, #1e293b, #0f172a);">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">👋 Selamat Siang, <?= ucfirst($nama_asli) ?>!</h4>
                        <p class="mb-0 text-white-50">Berikut ringkasan performa website sekolah hari ini.</p>
                    </div>
                    <div class="text-end">
                        <div id="clock-admin" class="fs-4 fw-bold font-monospace">00:00:00</div>
                        <div id="date-admin" class="small text-white-50">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="dashboard-card p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="card-title">Total Artikel</div>
                        <div class="count"><?= $totblog ?></div>
                    </div>
                    <div class="icon-box bg-gradient-green"><i class="fas fa-newspaper"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="dashboard-card p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="card-title">Data Member</div>
                        <div class="count"><?= $totmember ?></div>
                    </div>
                    <div class="icon-box bg-gradient-blue"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="dashboard-card p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="card-title">Guru & Staff</div>
                        <div class="count"><?= $totstaff ?></div>
                    </div>
                    <div class="icon-box bg-gradient-purple"><i class="fas fa-chalkboard-teacher"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="dashboard-card p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="card-title">Total Galeri</div>
                        <div class="count"><?= $totgallery ?></div>
                    </div>
                    <div class="icon-box bg-gradient-orange"><i class="fas fa-images"></i></div>
                </div>
            </div>
        </div>
    </div>


    <?php elseif ($isStaff): ?>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="p-4 rounded-3 text-white shadow-sm" style="background: linear-gradient(135deg, #1e293b, #0f172a);">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">👋 Selamat Datang, <?= ucfirst($nama_asli) ?>!</h4>
                        <p class="mb-0 text-white-50">Anda masuk sebagai Staff.</p>
                    </div>
                    <div class="text-end">
                        <div id="clock-admin" class="fs-4 fw-bold font-monospace">00:00:00</div>
                        <div id="date-admin" class="small text-white-50">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>

    <div class="container member-area">
        <div class="p-3 p-md-5 bg-white rounded-3 shadow-sm w-100" style="max-width: 800px; border-top: 5px solid #3b82f6;">
            <div class="mb-3 text-primary">
                <i class="fas fa-user-circle fa-5x"></i>
            </div>

            <h5 class="text-muted text-uppercase ls-2">Selamat Datang</h5>

            <div class="welcome-text text-break"><?= ucfirst($nama_asli) ?></div>

            <hr class="my-4 w-50 mx-auto" style="opacity: 0.1;">

            <div id="clock-member" class="big-clock">00:00:00</div>
            <div id="date-member" class="text-muted fs-5">Loading date...</div>
        </div>
    </div>

<?php endif; ?>


<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const dateString = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        if (document.getElementById('clock-admin')) {
            document.getElementById('clock-admin').textContent = timeString;
            document.getElementById('date-admin').textContent = dateString;
        }
        if (document.getElementById('clock-member')) {
            document.getElementById('clock-member').textContent = timeString;
            document.getElementById('date-member').textContent = dateString;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>