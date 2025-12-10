<?php
$code = $this->input->get('code');

$this->db->where('user_code', $code);
$cekuser = $this->db->get('tb_users');
if ($cekuser->num_rows() == 0) {
?>
    <center>DATA USER TIDAK VALID</center>
<?php } else { ?>
    <?php $userdata = $cekuser->row(); ?>
    <?php echo form_open('', array('id' => 'update_staff')); ?>
    <input type="hidden" name="code" value="<?php echo $code; ?>">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="staff_fullname" class="form-control" placeholder="Nama Lengkap" value="<?php echo $userdata->user_fullname; ?>" autocomplete="off">
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-6 col-lg-6">
            <label for="nama">Nama Perusahaan</label>
            <input type="text" name="staff_company" class="form-control" value="<?= $userdata->user_company ?>" placeholder="Nama Perusahaan">
        </div> -->
        <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
            <div class="form-group">
                <label for="exampleInputEmail1">No WA</label>
                <input type="number" name="staff_phone" class="form-control" placeholder="No WA" value="<?php echo $userdata->user_phone; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="<?php echo $userdata->email; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn w-100 my-2 btn-primary" style="color:#fff">Update Data Member</button>
    </div>
    <?php echo form_close(); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#update_staff').submit(function(event) {
                event.preventDefault();

                $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/userlist/update_staff') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: $('#update_staff').serialize(),
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
            });
        });
    </script>


    <hr>
    <h6>Update Password</h6>
    <?php echo form_open('', array('id' => 'ganti_password')); ?>
    <input type="hidden" name="code" value="<?php echo $code; ?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Current Password</label>
        <input type="text" value="<?php echo $userdata->user_passtext; ?>" readonly class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">New Password</label>
        <input type="text" name="staff_password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <button class="btn w-100 my-2 btn-primary" style="color:#fff">Update Password</button>
    </div>
    <?php echo form_close(); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ganti_password').submit(function(event) {
                event.preventDefault();

                $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/userlist/update_password_staff') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: $('#ganti_password').serialize(),
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
            });
        });
    </script>

<?php } ?>