<!-- <div class="card-body"> -->
<?php echo form_open_multipart('', 'id="newpackage"') ?>

<div class="form-group">
    <label for="">Nama Paket</label>
    <input type="text" class="form-control" name="package_nama" placeholder="Masukkan nama paket wisata" autocomplete="off" required>
</div>

<div class="form-group">
    <label for="">Lokasi</label>
    <input type="text" class="form-control" name="package_lokasi" placeholder="Masukkan lokasi wisata" autocomplete="off" required>
</div>

<div class="form-group">
    <label for="">Lama Perjalanan</label>
    <input type="text" class="form-control" name="package_lamapjl" placeholder="Contoh: 5 Hari 4 Malam" autocomplete="off" required>
</div>

<div class="form-group">
    <label for="">Harga</label>
    <input type="text" class="form-control" name="package_harga" placeholder="Contoh: 2500000" autocomplete="off" required>
</div>

<div class="form-group">
    <label for="">Fasilitas</label>
    <input type="text" class="form-control" name="package_fasilitas" placeholder="Contoh: Hotel, Makan, Transportasi" autocomplete="off">
</div>

<div class="form-group">
    <label for="">Foto Paket</label>
    <input type="file" class="form-control" name="package_file" accept="image/*" required>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/vendors/tinymce/tinymce.min.js') ?>"></script>
<script>
    tinymce.init({
        selector: '#textarea',
        menubar: true,
        statusbar: false,
        toolbar: false,
        plugins: [
            "advlist autolink lists link charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
    });
</script>

<div class="form-group">
    <label for="">Deskripsi Paket</label>
    <textarea id="textarea" name="package_desc" rows="10"></textarea>
</div>

<div class="form-group">
    <button type="submit" id="btns1" class="btn btn-md btn-block font-weight-bold" style="background: #27ae60;color:#fff">PUBLIKASI</button>
    <button disabled type="button" id="btns2" class="btn btn-md btn-block font-weight-bold" style="background: #27ae60;color:#fff">PROSES PUBLIKASI</button>
</div>

<?php echo form_close() ?>

<script>
    jQuery(document).ready(function($) {

        $('#btns2').hide();

        $('#newpackage').submit(function(event) {
            event.preventDefault();
            tinymce.triggerSave();
            $('#btns1').hide();
            $('#btns2').show();

            $.ajax({
                    url: '<?php echo site_url('postdata/admin_post/package/newpackage') ?>', // endpoint baru
                    type: 'post',
                    dataType: 'json',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function(data) {

                    // update CSRF token
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
                    $('#btns1').show();
                    $('#btns2').hide();

                })

        });
    });
</script>
<!-- </div> -->
