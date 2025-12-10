<?php
$code = $this->input->get('code');

$this->db->where('faq_code', $code);
$getFaq = $this->db->get('tb_faq');
if ($getFaq->num_rows() == 0) { 
?>
<center>Data Tidak Valid</center>
<?php
} else {

    $faq = $getFaq->row();
    echo form_open('', array('id' => 'edit-faq'));
?>
<input type="hidden" name="code" value="<?= $code ?>">
<div class="form-group mb-3">
    <label for="">Question</label>
    <input type="text" class="form-control" value="<?= $faq->faq_quest ?>" name="faq_quest" placeholder="Masukkan Pertanyaan" autocomplete="off" required>
</div>

<div class="form-group mb-3">
    <label for="">Answer</label>
    <textarea name="faq_answ" class="form-control" placeholder="Masukkan Jawaban"><?= $faq->faq_answ ?></textarea>
</div>

<div class="form-group">
    <button class="btn w-100 my-2 btn-primary" style="color:#fff">Simpan Faq</button>
</div>
<?php echo form_close(); ?>
<script>
    $(document).ready(function() {
        $('#edit-faq').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?php echo site_url('postdata/admin_post/about/edit_faq') ?>',
                type: 'post',
                dataType: 'json',
                data: $('#edit-faq').serialize(),
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
<?php } ?>