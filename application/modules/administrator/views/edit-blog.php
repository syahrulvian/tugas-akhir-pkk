<?php
$this->template->title->set('Edit blog');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Edit blog');
?>

<div class="card">
    <div class="card-header">
        <div class="card-title"><?= $blog->blog_judul ?></div>
    </div>
    <div class="card-body">
        <?php echo form_open_multipart('', 'id="updblog"'); ?>
        <input type="hidden" name="codes" value="<?= $blog->blog_code ?>">
        <div class="mb-2">
            <div class="form-group">
                <label for="">Judul blog</label>
                <input type="text" class="form-control" name="jdul_blog" placeholder="Judul blog" autocomplete="off" value="<?= $blog->blog_judul ?>">
            </div>
        </div>
        <div class="mb-2">

            <div class="form-group">
                <label for="">Deskripsi Singkat</label>
                <textarea class="form-control" name="desc_blog" rows="5" style="resize: none;" placeholder="Deskripsi Singkat" autocomplete="off"><?= $blog->blog_desc ?></textarea>
            </div>
        </div>
        <div class="mb-2">

            <div class="form-group">
                <script type="text/javascript" src="<?php echo base_url('assets/vendors/tinymce/tinymce.min.js') ?>"></script>
                <label for="">Konten blog</label>
                <script>
                    tinymce.init({
                        selector: "#textarea",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor colorpicker textpattern"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                        automatic_uploads: true,
                        image_advtab: true,
                        images_upload_url: "<?php echo site_url('postdata/public_post/ulasan/tinymce_upload') ?>",
                        file_picker_types: 'image',
                        paste_data_images: true,
                        relative_urls: false,
                        remove_script_host: false,
                        file_picker_callback: function(cb, value, meta) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');
                            input.onchange = function() {
                                var file = this.files[0];
                                var reader = new FileReader();
                                reader.readAsDataURL(file);
                                reader.onload = function() {
                                    var id = 'post-image-' + (new Date()).getTime();
                                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                    var blobInfo = blobCache.create(id, file, reader.result);
                                    blobCache.add(blobInfo);
                                    cb(blobInfo.blobUri(), {
                                        title: file.name
                                    });
                                };
                            };
                            input.click();
                        }
                    });
                </script>
                <textarea id="textarea" name="content_blog" rows="15" placeholder="Konten blog" autocomplete="off"><?= $blog->blog_content ?></textarea>
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label>Upload Gambar</label>
                <div class="custom-file">
                    <input name="file_blog" type="file" class="custom-file-input" id="imgcover" onchange="getimggg(this)">
                    <label class="custom-file-label" for="imgcover">Pilih Gambar</label>
                </div>
                <small class="text-danger">Select Image To View Preview</small><br>
                <img src="<?php echo base_url('assets/blog/' . $blog->blog_img); ?>" id="gambarcover" style="max-width:150px; max-height:150px;margin-top: 10px;border: 1px solid #ddd">
                <script type="text/javascript">
                    function getimggg(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#gambarcover')
                                    .attr('src', e.target.result);
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" id="button1" name="buttonklik" value="simpan" class="btn btn-success btn-md btn-block">SIMPAN EDIT blog</button>
            <button disabled type="button" id="button2" class="btn btn-danger btn-md btn-block">PROSES SIMPAN</button>
        </div>
        <?php echo form_close(); ?>
        <script>
            jQuery(document).ready(function($) {

                $('#button2').hide();
                $('#updblog').submit(function(event) {
                    event.preventDefault();
                    tinymce.triggerSave();
                    $('#button1').hide();
                    $('#button2').show();

                    $.ajax({
                            url: '<?php echo site_url('postdata/admin_post/blog/blogupdate') ?>',
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
                                    location.href = "<?php echo site_url('admin/blog') ?>";
                                }
                            });
                            $('#button1').show();
                            $('#button2').hide();

                        })

                });
            });
        </script>
    </div>
</div>