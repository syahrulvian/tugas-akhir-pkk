<?php
$this->template->title->set('Data blog');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Data blog');
?>
<div class="card">
    <div class="card-header">
        <div class="card-title font-weight-bold d-flex justify-content-between">Data blog
            <div class="float-right">
                <a href="<?= site_url('admin/new-blog') ?>" class="btn btn-sm btn-primary text-white"><i class="fas fa-plus"></i> blog</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Thumbnail</th>
                        <th>Title blog</th>
                        <th width="20%">Date</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $limit          = 10;
                    $offset         = ($this->input->get('page')) ? $this->input->get('page') : 0;
                    $no             = $offset + 1;

                    $this->db->order_by('blog_date', 'desc');
                    $getblog = $this->db->get('tb_blog', $limit, $offset);

                    $getotal = $this->db->get('tb_blog')->num_rows();
                    foreach ($getblog->result() as $rows) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><img src="<?= base_url('assets/blog/thumbnail/' . $rows->blog_img) ?>" alt="gambar blog" style="max-width: 100px;"></td>
                            <td><?= $rows->blog_judul ?></td>
                            <td><?= $rows->blog_date ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/edit-blog/' . $rows->blog_code) ?>" class="btn btn-sm btn-success" title="Edit blog" style="min-width: 20px;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="hapusblog('<?php echo $rows->blog_code ?>')" class="btn btn-sm btn-danger text-white" style="min-width: 20px;" title="Hapus blog">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php echo $this->paginationmodel->paginate('blog', $getotal, $limit) ?>
        </div>
    </div>
</div>

<script>
    function hapusblog(code) {
        Swal.fire({
            allowOutsideClick: false,
            title: 'Apakah Anda Yakin',
            text: "Blog Akan Dihapus dan Tidak Dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {

                $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/blog/hapusblog') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            code: code,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
                    })

                    .done(function(data) {

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