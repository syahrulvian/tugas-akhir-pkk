<?php
$code = $this->input->get('code');
$this->db->where('katpkg_code', $code);
$kategori = $this->db->get('tb_kategori_pkg')->row();

 echo form_open('', 'id="editcate"') ?>
        <input type="hidden" name="katpkg_code" value="<?php echo htmlspecialchars($kategori->katpkg_code ?? '', ENT_QUOTES) ?>">

        <div class="mb-2">
            <div class="form-group">
                <label for="">Package Name</label>
                <input type="text" class="form-control" name="katpkg_name" placeholder="Package Name" autocomplete="off" value="<?php echo htmlspecialchars($kategori->katpkg_name ?? '', ENT_QUOTES) ?>">
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="katpkg_desc" rows="5" style="resize: none;" placeholder="Deskripsi Singkat" autocomplete="off"><?php echo htmlspecialchars($kategori->katpkg_desc ?? '', ENT_QUOTES) ?></textarea>
            </div>
        </div>
        <div class="mb-2">
            <div class="form-group">
                <button type="submit" id="btns1" name="buttonklik" value="update" class="btn btn-primary btn-md btn-block font-weight-bold">UPDATE CATEGORY</button>
                <button disabled type="button" id="btns2" class="btn btn-danger btn-md btn-block font-weight-bold">PROSES UPDATE category</button>
            </div>
        </div>
        <?php echo form_close() ?>

        <script>
            jQuery(document).ready(function($) {
                $('#btns2').hide();

                $('#editcate').submit(function(event) {
                    event.preventDefault();
                    $('#btns1').hide();
                    $('#btns2').show();

                    $.ajax({
                            url: '<?php echo site_url('postdata/admin_post/package/updatecategory') ?>',
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
                                    location.href = "<?php echo site_url('admin/kategori_pkg') ?>";
                                }
                            });

                            $('#btns1').show();
                            $('#btns2').hide();
                        })
                        .fail(function() {
                            // fallback on error
                            Swal.fire('Error', 'Terjadi kesalahan koneksi', 'error');
                            $('#btns1').show();
                            $('#btns2').hide();
                        });
                });
            });
        </script>