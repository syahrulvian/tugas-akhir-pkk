<?php
$code = $this->input->get('code');

$this->db->where('bankadmin_code', $code);
$cekbank = $this->db->get('tb_adminbank');

if ($cekbank->num_rows() == 0) {
?>
    <center>Data Tidak Ditemukan</center>
<?php } else {
    $databank = $cekbank->row();
?>
    <?php echo form_open('', 'id="update-databank"'); ?>
    <input type="hidden" name="code" value="<?php echo $code; ?>">
    <div class="form-group">
        <label for="">Rekening Atas Nama</label>
        <input type="text" class="form-control" placeholder="Rekening Atas Nama" name="bankadmin_bankaccount" autocomplete="off" value="<?php echo $databank->bankadmin_bankaccount ?>">
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Nama Bank</label>
                <input type="text" class="form-control" placeholder="Nama Bank" name="bankadmin_bankname" autocomplete="off" value="<?php echo $databank->bankadmin_bankname ?>">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Nomor Rekening</label>
                <input type="number" class="form-control" placeholder="Nomor Rekening" name="bankadmin_banknumber" autocomplete="off" value="<?php echo $databank->bankadmin_banknumber ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Konfirm Password</label>
        <div class="input-group" id="show_hide_passwordd">
            <input type="password" class="form-control" placeholder="Konfirm Password" aria-label="Konfirm Password" aria-describedby="basic-addon2" name="confirm_password" autocomplete="new-password">
            <div class="input-group-append">
                <button class="btn btn-info" type="button" id=""><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#show_hide_passwordd button").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_passwordd input').attr("type") == "text") {
                    $('#show_hide_passwordd input').attr('type', 'password');
                    $('#show_hide_passwordd i').addClass("fa-eye-slash");
                    $('#show_hide_passwordd i').removeClass("fa-eye");
                } else if ($('#show_hide_passwordd input').attr("type") == "password") {
                    $('#show_hide_passwordd input').attr('type', 'text');
                    $('#show_hide_passwordd i').removeClass("fa-eye-slash");
                    $('#show_hide_passwordd i').addClass("fa-eye");
                }
            });
        });
    </script>
    <div class="form-group">
        <button id='btn0101' type="submit" class="btn w-100 mt-2 btn-success">SIMPAN DATA BANK</button>
        <button id='btn0201' type="button" class="btn w-100 mt-2 btn-success" disabled>MEMPROSES</button>
    </div>
    <?php echo form_close(); ?>
    <script>
        $('#btn0201').hide();
        $('#update-databank').submit(function(event) {
            event.preventDefault();
            $('#btn0101').hide();
            $('#btn0201').show();

            $.ajax({
                    url: '<?php echo site_url('postdata/admin_post/bank/saveupdatebank') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#update-databank').serialize(),
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
                    $('#btn0101').show();
                    $('#btn0201').hide();
                })
        });
    </script>
<?php } ?>