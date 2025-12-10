<?php
$this->template->title->set('New Testimoni');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('New Testimoni');
?>
<div class="card">
    <div class="card-header">
        <div class="card-title">New Testimoni</div>
    </div>
    <div class="card-body">
        <?php echo form_open_multipart('', 'id="nwtestimoni"') ?>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="testimoni_name" placeholder="Nama pemberi testimoni" autocomplete="off">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Profesi</label>
                <input type="text" class="form-control" name="testimoni_profesi" placeholder="Profesi" autocomplete="off">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Judul Testimoni</label>
                <input type="text" class="form-control" name="testimoni_judul" placeholder="Judul testimoni" autocomplete="off">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea class="form-control" name="testimoni_desc" rows="5" style="resize: none;" placeholder="Isi testimoni..." autocomplete="off"></textarea>
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
                <img id="gambarcover" style="max-width:150px; max-height:150px;margin-top: 10px;border: 1px solid #ddd">
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

        <div class="mb-2">
            <div class="form-group">
                <button type="submit" id="btns1" name="buttonklik" value="simpan" class="btn btn-success btn-md btn-block font-weight-bold">SIMPAN Testimoni</button>
                <button disabled type="button" id="btns2" class="btn btn-danger btn-md btn-block font-weight-bold">PROSES SIMPAN Testimoni</button>
            </div>
        </div>

        <?php echo form_close() ?>
        <script>
            jQuery(document).ready(function($) {

                $('#btns2').hide();
                $('#nwtestimoni').submit(function(event) {
                    event.preventDefault();
                    $('#btns1').hide();
                    $('#btns2').show();

                    $.ajax({
                            url: '<?php echo site_url('postdata/admin_post/testimoni/savenewtestimoni') ?>',
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
                            $('#btns1').show();
                            $('#btns2').hide();

                        })

                });
            });
        </script>
    </div>
</div>