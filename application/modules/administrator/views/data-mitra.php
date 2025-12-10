<?php
$this->template->title->set('Data Mitra');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Data Mitra');
?>

<div class="card">
    <div class="card-header">
        <div class="card-title font-weight-bold d-flex justify-content-between align-items-center">
            Data Mitra
            <div class="float-right">
                <a href="<?= site_url('admin/add-mitra') ?>" class="btn btn-sm btn-primary text-white">
                    <i class="fas fa-plus"></i> Tambah Mitra
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Logo</th>
                        <th>Nama Mitra</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th width="15%">Tanggal Dibuat</th>
                        <th width="15%">Tanggal Diperbarui</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $limit = 15;
                    $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
                    $no = $offset + 1;

                    $this->db->select('tb_mitra.*, tb_kategori_mitra.kategori_mitra_nama');
                    $this->db->from('tb_mitra');
                    $this->db->join(
                        'tb_kategori_mitra',
                        'tb_kategori_mitra.kategori_mitra_id = tb_mitra.kategori_mitra_id',
                        'left'
                    );
                    $this->db->order_by('tb_mitra.created_at', 'DESC');
                    $getmitra = $this->db->get('', $limit, $offset);

                    $gettotal = $this->db->from('tb_mitra')->count_all_results();

                    if ($getmitra->num_rows() > 0) {
                        foreach ($getmitra->result() as $row) {
                            $logo = !empty($row->mitra_logo)
                                ? base_url('assets/mitra/' . $row->mitra_logo)
                                : base_url('assets/mitra/default.png');
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>

                                <td>
                                    <img src="<?= $logo ?>" alt="logo"
                                        style="width:60px; height:60px; object-fit:cover; border-radius:5px; border:1px solid #ddd;">
                                </td>

                                <td><?= htmlspecialchars($row->mitra_nama) ?></td>

                                <td><?= htmlspecialchars($row->kategori_mitra_nama ?: '-') ?></td>

                                <td><?= htmlspecialchars($row->mitra_deskripsi ?: '-') ?></td>

                                <td><?= date('d M Y H:i', strtotime($row->created_at)) ?></td>

                                <td>
                                    <?php
                                    if (!empty($row->updated_at)) {
                                        echo date('d M Y H:i', strtotime($row->updated_at));
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <a href="<?= site_url('admin/edit-mitra?code=' . $row->mitra_code) ?>"
                                        class="btn btn-sm btn-success text-white" title="Edit Mitra">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)" onclick="hapus('<?= $row->mitra_code ?>')"
                                        class="btn btn-sm btn-danger text-white">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center text-muted">Belum ada data mitra</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <?= $this->paginationmodel->paginate('mitra', $gettotal, $limit) ?>
        </div>
    </div>
</div>

<script>
    function hapus(code) {
        Swal.fire({
            allowOutsideClick: false,
            text: "Data Mitra Akan Dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA HAPUS',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo site_url('postdata/admin_post/Mitra/delete_mitra') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        code: code,
                        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                }).done(function(data) {

                    if (typeof updateCSRF === 'function') {
                        updateCSRF(data.csrf_data);
                    }

                    Swal.fire(
                        data.heading,
                        data.message,
                        data.type
                    ).then(function() {
                        if (data.status) {
                            location.reload();
                        }
                    });
                });
            }
        });
    }
</script>