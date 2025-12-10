<?php echo form_open('', array('id' => 'add-faq')); ?>

<div class="form-group mb-3">
    <label for="">Question</label>
    <input type="text" class="form-control" name="faq_quest" placeholder="Masukkan Pertanyaan" autocomplete="off" required>
</div>

<div class="form-group mb-3">
    <label for="">Answer</label>
    <textarea name="faq_answ" class="form-control" placeholder="Masukkan Jawaban"></textarea>
</div>

<div class="form-group">
    <button class="btn w-100 my-2 btn-primary" style="color:#fff">Simpan Faq</button>
</div>
<?php echo form_close(); ?>
<script>
    $(document).ready(function() {
        $('#add-faq').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?php echo site_url('postdata/admin_post/about/add_faq') ?>',
                type: 'post',
                dataType: 'json',
                data: $('#add-faq').serialize(),
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
            });
        });
</script>
