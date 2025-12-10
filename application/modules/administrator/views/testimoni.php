<?php
$this->template->title->set('Data Testimoni');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Data Testimoni');
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="<?= site_url('admin/add-testimoni') ?>" class="btn btn-sm btn-primary text-white">
            <i class="fas fa-plus"></i> Tambah Testimoni
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle table-hover caption-top">
                <caption>Daftar Testimoni</caption>

                <thead class="table-dark text-center">
                    <tr class="align-middle">
                        <th style="width:50px;">#</th>
                        <th>Nama</th>
                        <th class="d-none d-md-table-cell">Profesi</th>
                        <th class="d-none d-md-table-cell">Foto</th>
                        <th>Judul</th>
                        <th class="d-none d-lg-table-cell">Deskripsi</th>
                        <th class="d-none d-lg-table-cell">Tanggal</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $limit  = 15;
                    $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
                    $no     = $offset + 1;

                    $this->db->order_by('testimoni_date', 'DESC');
                    $getdata = $this->db->get('tb_testimoni', $limit, $offset);
                    $Gettotal = $this->db->get('tb_testimoni')->num_rows();

                    if ($getdata->num_rows() > 0) :
                        foreach ($getdata->result() as $show) :
                    ?>
                            <tr>
                                <td class="text-center fw-bold"><?= $no++; ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($show->testimoni_name); ?></strong><br>
                                    <span class="badge bg-secondary d-md-none mt-1"><?= htmlspecialchars($show->testimoni_profesi); ?></span>
                                </td>

                                <td class="d-none d-md-table-cell text-nowrap"><?= htmlspecialchars($show->testimoni_profesi); ?></td>

                                <td class="text-center d-none d-md-table-cell">
                                    <?php if (!empty($show->testimoni_img)) : ?>
                                        <img src="<?= base_url('assets/testimoni/' . $show->testimoni_img); ?>"
                                            alt="foto testimoni"
                                            width="60" height="60"
                                            class="img-thumbnail rounded-circle">
                                    <?php else : ?>
                                        <i class="fas fa-user-circle text-muted fs-3"></i>
                                    <?php endif; ?>
                                </td>

                                <td class="fw-semibold"><?= htmlspecialchars($show->testimoni_judul); ?></td>

                                <td class="small d-none d-lg-table-cell text-wrap">
                                    <?= substr(strip_tags($show->testimoni_desc), 0, 100); ?>...
                                </td>

                                <td class="text-center d-none d-lg-table-cell text-nowrap">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    <?= date('d M Y', strtotime($show->testimoni_date)); ?>
                                </td>

                                <td class="text-center text-nowrap">
                                    <a href="<?= site_url('admin/edit-testimoni/' . $show->testimoni_code) ?>"
                                        class="btn btn-sm btn-success m-1"
                                        title="Edit" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="hapusTestimoni('<?= $show->testimoni_code ?>')"
                                        class="btn btn-sm btn-danger text-white m-1"
                                        title="Hapus" data-bs-toggle="tooltip">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    else :
                        echo '<tr><td colspan="8" class="text-center text-muted p-4">
                            <i class="fas fa-info-circle me-2"></i>Tidak ada data testimoni yang ditemukan.
                        </td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>

            <?= $this->paginationmodel->paginate('tb_testimoni', $Gettotal, $limit); ?>
        </div>
    </div>
</div>

<script>
    function hapusTestimoni(code) {
        Swal.fire({
            allowOutsideClick: false,
            title: 'Apakah Anda Yakin?',
            text: "Testimoni akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: '<?= site_url('postdata/admin_post/testimoni/hapusTestimoni') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            code: code,
                            <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>'
                        }
                    })
                    .done(function(data) {
                        updateCSRF(data.csrf_data);
                        Swal.fire(data.heading, data.message, data.type)
                            .then(function() {
                                if (data.status) location.reload();
                            });
                    });
            }
        });
    }
</script>