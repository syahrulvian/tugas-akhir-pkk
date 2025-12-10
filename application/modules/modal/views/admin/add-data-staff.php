<?php
echo form_open('admin/data-staff', ['id' => 'formAddStaff']);
?>
<div class="row">
    <div class="col-md-6">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="staff_username" class="form-control" placeholder="Username">
    </div>
    <div class="col-md-6">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" name="staff_fullname" class="form-control" placeholder="Nama Staff">
    </div>
    <!-- <div class="col-md-6 mt-2">
        <label for="nama" class="form-label">Nama Perusahaan</label>
        <input type="text" name="staff_company" class="form-control" placeholder="Nama Perusahaan">
    </div> -->
    <div class="col-md-6 mt-2">
        <label for="phone" class="form-label">No WA/Telepon</label>
        <input type="number" name="staff_phone" class="form-control" placeholder="No WA">
    </div>
    <div class="col-md-6 mt-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="staff_email" class="form-control" placeholder="Email">
    </div>
</div>
<div class="mb-3 mt-3">
    <label for="password2" class="form-label">Password</label>
    <input class="form-control" name="staff_password" type="password" id="password2" placeholder="*********">
</div>
<button type="submit" class="btn btn-primary w-100">Simpan</button>
<?php echo form_close(); ?>

<script>
    $('#formAddStaff').submit(function(e) {
        e.preventDefault();

        $.ajax({
                url: '<?php echo site_url('postdata/admin_post/userlist/add_staff') ?>',
                type: 'post',
                dataType: 'json',
                data: $('#formAddStaff').serialize()
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
</script>