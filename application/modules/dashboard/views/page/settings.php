<?php
$this->template->title->set('Settings');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Settings');
?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Update Password</div>
            </div>
            <div class="card-body">
                <?php echo form_open('', 'id="setting"'); ?>
                <div class="form-group mb-3">
                    <label for="">Password Lama</label>
                    <input type="password" class="form-control" placeholder="Password Lama" autocomplete="off" name="current_password" id="pass1">
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group mb-3">
                            <label for="">Password Baru</label>
                            <input type="password" class="form-control" placeholder="Password Baru" autocomplete="off" name="new_password" id="pass2">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group mb-3">
                            <label for="">Ulangi Password Baru</label>
                            <input type="password" class="form-control" placeholder="Ulangi Password Baru" autocomplete="off" name="confirm_password" id="pass3">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="checkbox" id="chk1" onclick="shopass()">
                    <label for="chk1" style="font-weight:300;">Show Password</label>
                </div>
                <div class="form-group mb-3">
                    <button id='btn01' type="submit" class="btn btn-md btn-block font-weight-bold" style="background: #27ae60;color:#fff">UPDATE PASSWORD</button>
                    <button id='btn02' type="button" class="btn btn-md btn-block font-weight-bold" disabled>MEMPROSES</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <script>
                function shopass() {
                    var pass1 = document.getElementById("pass1");
                    if (pass1.type === "password") {
                        pass1.type = "text";
                    } else {
                        pass1.type = "password";
                    }

                    var pass2 = document.getElementById("pass2");
                    if (pass2.type === "password") {
                        pass2.type = "text";
                    } else {
                        pass2.type = "password";
                    }

                    var pass3 = document.getElementById("pass3");
                    if (pass3.type === "password") {
                        pass3.type = "text";
                    } else {
                        pass3.type = "password";
                    }
                }

                $('#btn02').hide();
                $('#updatepass').submit(function(event) {
                    event.preventDefault();
                    $('#btn01').hide();
                    $('#btn02').show();

                    $.ajax({
                            url: '<?php echo site_url('postdata/admin_post/profile/update_pass') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: $('#updatepass').serialize(),
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
                            $('#btn01').show();
                            $('#btn02').hide();
                        })
                });

                $(document).ready(function() {

                    var activeTab = localStorage.getItem('activeTab');
                    if (activeTab) {
                        $('#myTab button[data-bs-target="' + activeTab + '"]').tab('show');
                    } else {
                        $('#myTab button:first').tab('show');
                    }
                    $('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                        var tabId = $(e.target).data('bs-target');
                        localStorage.setItem('activeTab', tabId);
                    });

                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#setting').submit(function(event) {
                        event.preventDefault();
                        $.ajax({
                            url: '<?php echo site_url('postdata/admin_post/profile/update_pass') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: $('#setting').serialize(),
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
</div>