<?php
$this->template->title->set('Contact');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Contact');
?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Contact</div>
    </div>
    <div class="card-body">
        <?php echo form_open('', array('id' => 'contact')); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" value="<?= option('alamat')['option_desc1'] ?>" name="alamat" placeholder="Masukkan Alamat" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" value="<?= option('email')['option_desc1'] ?>" name="email" placeholder="Alamat Email" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Nomor Whatsapp</label>
                    <input type="text" class="form-control" value="<?= option('telp')['option_desc1'] ?>" name="telp" placeholder="Nomor Whatsapp" autocomplete="off" required>
                </div>
            </div>
            <!-- <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="">CS 2</label>
                <input type="text" class="form-control" value="<?= option('telp')['option_desc2'] ?>" name="cs2" placeholder="Customer Service 2" autocomplete="off" required>
            </div>
        </div> -->
        </div>

        <div class="form-group">
            <button type="submit" id="btns1" class="btn btn-md btn-block font-weight-bold" style="background: #27ae60;color:#fff">Simpan Perubahan</button>
        </div>

        <?php echo form_close(); ?>
        <script>
            $(document).ready(function() {
                $('#contact').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/contact/seContact') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: $('#contact').serialize(),
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


    </div>
</div>