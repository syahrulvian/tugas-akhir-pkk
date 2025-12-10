<?php $this->template->title->set('Data Staff'); ?>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class=" mb-0">Data Staff</h4>
        <a data-bs-href="<?php echo site_url('modal/admin/add-data-staff') ?>" data-bs-title="Tambah Staff" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#dinamicModal" data-bs-backdrop="static" data-bs-keyboard="false" class="btn btn-sm btn-primary mb-1 px-3" title="Tambah Staff">
            <i class="fas fa-plus"></i> Tambah Staff
        </a>
    </div>

    <div class="card-body">

        <!-- SEARCH -->
        <form action="<?= site_url('admin/data-staff') ?>" method="GET" class="mb-3">
            <div class="mb-3">
                <label for="search" class="form-label">Search Staff</label>
                <div class="input-group">
                    <input name="search" id="search"
                        value="<?= $this->input->get('search'); ?>"
                        type="text" class="form-control"
                        placeholder="Cari username / nama staff" autocomplete="off">

                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Tgl Gabung</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $limit  = 15;
                    $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
                    $no     = $offset + 1;

                    // --- DATA STAFF ---
                    $this->db->order_by('created_on', 'DESC');
                    $this->db->where('user_status', 'staff');

                    if ($this->input->get('search')) {
                        $s = $this->input->get('search');
                        $this->db->group_start();
                        $this->db->like('username', $s);
                        $this->db->or_like('user_fullname', $s);
                        $this->db->group_end();
                    }

                    $getdata = $this->db->get('tb_users', $limit, $offset);

                    // ---- TOTAL DATA ----
                    $this->db->where('user_status', 'staff');
                    if ($this->input->get('search')) {
                        $s = $this->input->get('search');
                        $this->db->group_start();
                        $this->db->like('username', $s);
                        $this->db->or_like('user_fullname', $s);
                        $this->db->group_end();
                    }
                    $Gettotal = $this->db->get('tb_users')->num_rows();

                    foreach ($getdata->result() as $staff) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <small class="text-primary"><?= $staff->username ?></small><br>
                                <?= $staff->user_fullname ?>
                            </td>

                            <td>
                                <?= $staff->email ?><br>
                                <a href="https://wa.me/<?= $staff->user_phone ?>" target="_blank">
                                    <?= $staff->user_phone ?>
                                </a>
                            </td>

                            <td><?= date('d-M-Y', $staff->created_on) ?></td>

                            <td>
                                <a data-bs-href="<?= site_url('modal/admin/staff-update?code=' . $staff->user_code) ?>"
                                    data-bs-title="Update Staff"
                                    data-bs-toggle="modal" data-bs-target="#dinamicModal"
                                    class="btn btn-sm btn-info">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>

                                <a href="#" class="btn btn-sm btn-danger login_as_user"
                                    data-id="<?= $staff->id ?>">
                                    Login
                                </a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <div class="pt-2">
            <?= $this->paginationmodel->paginate('data-staff', $Gettotal, $limit) ?>
        </div>

    </div>
</div>

<!-- CSRF -->
<input type="hidden" name="csrf_cadangan" value="<?= $this->security->get_csrf_hash(); ?>">

<script>
    $(document).ready(function() {

        // LOGIN AS STAFF
        $('.login_as_user').click(function(e) {
            e.preventDefault();

            $.ajax({
                    url: '<?= site_url('postdata/admin_post/userlist/login_as_user') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user_id: $(this).data('id'),
                        csrf_myapp: $('input[name=csrf_cadangan]').val()
                    }
                })
                .done(function(result) {
                    $('input[name=csrf_cadangan]').val(result.csrf_data);

                    if (result.status) {
                        Swal.fire('Berhasil', result.heading, result.type).then(() => {
                            location.href = '<?= site_url('dashboard') ?>';
                        });
                    } else {
                        Swal.fire({
                            title: result.heading,
                            text: result.message,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'YA, Logout',
                            cancelButtonText: 'Batal'
                        }).then((res) => {
                            if (res.value) {
                                location.href = '<?= site_url('authentication/logout') ?>';
                            }
                        });
                    }
                });
        });

    });
</script>