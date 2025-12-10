<div class="card">
    <div class="card-header">
        <div class="card-title font-weight-bold d-flex justify-content-between align-items-center">
            Data FAQ
            <div class="float-right">
                <a data-bs-href="<?php echo site_url('modal/admin/add-faq') ?>" data-bs-title="Tambah Faq" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#dinamicModal" data-bs-backdrop="static" data-bs-keyboard="false" class="btn btn-sm btn-success">Tambah Faq</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $limit  = 15;
                    $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
                    $no     = $offset + 1;

                    $this->db->order_by('faq_date', 'DESC');
                    $getfaq = $this->db->get('tb_faq', $limit, $offset);

                    $gettotal = $this->db->get('tb_faq')->num_rows();

                    if ($getfaq->num_rows() > 0) {
                        foreach ($getfaq->result() as $row) {
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->faq_quest ?></td>
                                <td><?= $row->faq_answ ?></td>
                                <td>
                                    <a data-bs-href="<?php echo site_url('modal/admin/edit-faq?code=' . $row->faq_code) ?>" data-bs-title="Edit Faq" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#dinamicModal" data-bs-backdrop="static" data-bs-keyboard="false" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="hapus('<?= $row->faq_code ?>')" class="btn btn-sm btn-danger text-white" title="Hapus Faq"> <i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center text-muted">Belum ada data Faq</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php echo $this->paginationmodel->paginate('about', $gettotal, $limit) ?>
        </div>
    </div>
</div>

<script>
    function hapus(code) {
        Swal.fire({
            allowOutsideClick: false,
            text: "Data Faq Akan Dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA HAPUS',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo site_url('postdata/admin_post/about/hapus_faq') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        code: code,
                        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                }).done(function(data) {
                    updateCSRF(data.csrf_data);
                    Swal.fire(
                        data.heading,
                        data.message,
                        data.type
                    ).then(function() {
                        if (data.status) {
                            location.reload();
                        }
                    });
                })
            }
        });
    }
</script>