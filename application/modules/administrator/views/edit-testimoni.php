<?php
$this->template->title->set('Edit Testimoni');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Edit Testimoni');
?>

<div class="card">
    <div class="card-header">
        <div class="card-title"><?= $testimoni->testimoni_judul ?></div>
    </div>
    <div class="card-body">
        <?php echo form_open_multipart('', 'id="updtestimoni"'); ?>
        <input type="hidden" name="codes" value="<?= $testimoni->testimoni_code ?>">
        <div class="mb-2">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="testimoni_name" placeholder="Nama pemberi testimoni" autocomplete="off" value="<?= $testimoni->testimoni_name ?>">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Profesi</label>
                <input type="text" class="form-control" name="testimoni_profesi" placeholder="Profesi" autocomplete="off" value="<?= $testimoni->testimoni_profesi ?>">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Judul Testimoni</label>
                <input type="text" class="form-control" name="testimoni_judul" placeholder="Judul testimoni" autocomplete="off" value="<?= $testimoni->testimoni_judul ?>">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Deskripsi Testimoni</label>
                <textarea class="form-control" name="testimoni_desc" rows="5" style="resize: none;" placeholder="Isi testimoni..." autocomplete="off"><?= $testimoni->testimoni_desc ?></textarea>
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label>Upload Gambar</label>
                <div class="custom-file">
                    <input name="testimoni_img" type="file" class="custom-file-input" id="imgcover" onchange="getimggg(this)">
                    <label class="custom-file-label" for="imgcover">Pilih Gambar</label>
                </div>
                <small class="text-danger">Pilih Gambar Untuk Melihat Preview</small><br>
                <img src="<?php echo base_url('assets/testimoni/' . $testimoni->testimoni_img); ?>" id="gambarcover" style="max-width:150px; max-height:150px;margin-top: 10px;border: 1px solid #ddd">
                <script type="text/javascript">
                    function getimggg(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#gambarcover').attr('src', e.target.result);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" id="button1" name="buttonklik" value="simpan" class="btn btn-success btn-md btn-block">SIMPAN EDIT Testimoni</button>
            <button disabled type="button" id="button2" class="btn btn-danger btn-md btn-block">PROSES SIMPAN</button>
        </div>
        <?php echo form_close(); ?>
        <script>
            jQuery(document).ready(function($) {

                $('#button2').hide();
                $('#updtestimoni').submit(function(event) {
                    event.preventDefault();
                    $('#button1').hide();
                    $('#button2').show();

                    $.ajax({
                            url: '<?php echo site_url('postdata/admin_post/testimoni/testimoniupdate') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                        })
                        .done(function(data) {

                            // CSRF IS MAGIC
                            updateCSRF(data.csrf_data);

                            Swal.fire(
                                data.heading,
                                data.message,
                                data.type
                            ).then(function() {
                                if (data.status) {
                                    location.href = "<?php echo site_url('admin/testimoni') ?>";
                                }
                            });
                            $('#button1').show();
                            $('#button2').hide();
                        });
                });
            });
        </script>
    </div>
</div>
