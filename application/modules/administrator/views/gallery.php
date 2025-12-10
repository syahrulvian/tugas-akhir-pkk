<?php
$this->template->title->set('Data Gallery');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Data Gallery');
?>

<div class="card">
    <div class="card-header">
        <div class="card-title font-weight-bold d-flex justify-content-between align-items-center">
            Data Gallery
            <div class="float-right">
                <a href="<?= site_url('admin/new-gallery') ?>" class="btn btn-sm btn-primary text-white">
                    <i class="fas fa-plus"></i> Gallery
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
                        <th>Thumbnail</th>
                        <th>Judul Galeri</th>
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

                    $this->db->order_by('gallery_created_at', 'DESC');
                    $getgallery = $this->db->get('tb_gallery', $limit, $offset);
                    $gettotal = $this->db->get('tb_gallery')->num_rows();

                    if ($getgallery->num_rows() > 0) {
                        foreach ($getgallery->result() as $row) {
                            $arr_img = json_decode($row->gallery_image, true);
                            $first_img = is_array($arr_img) && count($arr_img) > 0 ? $arr_img[0] : 'default.png';
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php
                                    if (is_array($arr_img) && count($arr_img) > 0) {
                                        foreach ($arr_img as $img) {
                                            $file = base_url('assets/gallery/' . $img);
                                            echo '<img src="' . $file . '" alt="galeri" style="width:60px; height:60px; object-fit:cover; border-radius:5px; border:1px solid #ddd; margin:2px;">';
                                        }
                                    } else {
                                        echo '<img src="' . base_url('assets/gallery/default.png') . '" alt="default" style="width:60px; height:60px; object-fit:cover; border-radius:5px; border:1px solid #ddd;">';
                                    }
                                    ?>
                                </td>

                                <td><?= htmlspecialchars($row->gallery_title) ?></td>
                                <td><?= htmlspecialchars($row->gallery_description ?: '-') ?></td>
                                <td><?= date('d M Y H:i', strtotime($row->gallery_created_at)) ?></td>
                                <td>
                                    <?php
                                    if (!empty($row->gallery_updated_at)) {
                                        echo date('d M Y H:i', strtotime($row->gallery_updated_at));
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/edit-gallery?code=' . $row->gallery_code) ?>"
                                       class="btn btn-sm btn-success text-white" title="Edit Galeri">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)" onclick="hapusGallery('<?= $row->gallery_code ?>')"
                                       class="btn btn-sm btn-danger text-white" title="Hapus Galeri">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center text-muted">Belum ada data galeri</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <?php echo $this->paginationmodel->paginate('data-gallery', $gettotal, $limit) ?>
        </div>
    </div>
</div>

<script>
    function hapusGallery(code) {
        Swal.fire({
            allowOutsideClick: false,
            title: 'Apakah Anda Yakin?',
            text: "Data galeri akan dihapus dan tidak bisa dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= site_url('postdata/admin_post/Gallery/deletegallery') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        code: code,
                        <?= $this->security->get_csrf_token_name(); ?>:
                            '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (data) {
                        if (typeof updateCSRF === 'function') {
                            updateCSRF(data.csrf_data);
                        }

                        Swal.fire(data.heading, data.message, data.type).then(function () {
                            if (data.status) {
                                location.reload();
                            }
                        });
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
