<?php
$this->template->title->set('About & Faq');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('About & Faq');
?>

<div class="card">
    <div class="card-header">
        <div class="card-title">About</div>
    </div>
    <div class="card-body">
        <?php
        $this->db->where('about_id', 1);
        $getAbout = $this->db->get('tb_about')->row();

        echo form_open_multipart('', 'id="newpackage"') ?>

        <div class="form-group mb-3">
            <label for="">Title</label>
            <input type="text" class="form-control" value="<?= $getAbout->about_title ?>" name="about_title" placeholder="Masukkan Title" autocomplete="off" required>
        </div>

        <script type="text/javascript" src="<?php echo base_url('assets/vendors/tinymce/tinymce.min.js') ?>"></script>
        <script>
            tinymce.init({
                selector: '#textarea',
                menubar: true,
                statusbar: false,
                toolbar: false,
                // plugins: [
                //     "advlist autolink lists link charmap print preview hr anchor pagebreak",
                //     "searchreplace wordcount visualblocks visualchars code fullscreen",
                //     "insertdatetime nonbreaking save table contextmenu directionality",
                //     "emoticons template paste textcolor colorpicker textpattern",
                // ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
            });
        </script>
        <div class="form-group mb-3">
            <label for="">Deskripsi</label>
            <textarea id="textarea" name="about_desc" rows="10"><?= $getAbout->about_desc ?></textarea>
        </div>

        <div class="form-group">
            <button type="submit" id="btns1" class="btn btn-md btn-block font-weight-bold" style="background: #27ae60;color:#fff">Simpan Perubahan</button>
            <button disabled type="button" id="btns2" class="btn btn-md btn-block font-weight-bold" style="background: #27ae60;color:#fff">PROSES</button>
        </div>

        <?php echo form_close(); ?>
        <script>
            jQuery(document).ready(function($) {
                $('#btns2').hide();
                $('#newpackage').submit(function(event) {
                    event.preventDefault();
                    tinymce.triggerSave();
                    $('#btns1').hide();
                    $('#btns2').show();

                    $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/about/saveAbout') ?>', // endpoint baru
                        type: 'post',
                        dataType: 'json',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                    }).done(function(data) {
                        // update CSRF token
                        updateCSRF(data.csrf_data);
                        Swal.fire(
                            data.heading,
                            data.message,
                            data.type
                        ).then(function() {
                            if (data.status) {
                                location.href = "<?php echo site_url('admin/about') ?>";
                            }
                        });
                        $('#btns1').show();
                        $('#btns2').hide();
                    })
                });
            });
        </script>
    </div>
</div>

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