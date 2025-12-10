<?php
$code = $this->input->get('code');

$this->db->where('user_code', $code);
$cekuser = $this->db->get('tb_users');
if ($cekuser->num_rows() == 0) {
?>
    <center>DATA USER TIDAK VALID</center>
<?php } else { ?>
    <?php $userdata = $cekuser->row(); ?>
    <?php echo form_open('', array('id' => 'change_userdata')); ?>
    <input type="hidden" name="code" value="<?php echo $code; ?>">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">

            <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="user_fullname" class="form-control" placeholder="Nama Lengkap" value="<?php echo $userdata->user_fullname; ?>" autocomplete="off">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="exampleInputEmail1">No. NIK</label>
                <input type="text" name="user_nik" class="form-control" placeholder="Nama Lengkap" value="<?php echo $userdata->user_nik; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Email</label>
                <input type="text" name="email" class="form-control" placeholder="Alamat Email" value="<?php echo $userdata->email; ?>" autocomplete="off">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Nomor WhatsApp</label>
                <input type="text" name="user_phone" class="form-control" placeholder="Nomor WhatsApp" value="<?php echo $userdata->user_phone; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row mt-2">

        <div class="col-md-6">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" id="ttl" value="<?php echo date('Y-m-d', strtotime($userdata->user_ttl)); ?>" class="form-control" name="user_ttl" placeholder="Tanggal Lahir" autocomplete="off" onkeypress="return event.charCode != 32">
        </div>
        <div class="col-md-6">
            <label class="form-label">Agama</label>
            <select name="user_agama" class="form-select">
                <option disabled selected>Pilih Agama</option>
                <option <?php echo ($userdata->user_agama == 'islam') ? 'selected' : ''; ?> value="islam">Islam</option>
                <option <?php echo ($userdata->user_agama == 'kristen') ? 'selected' : ''; ?> value="kristen">Kristen</option>
                <option <?php echo ($userdata->user_agama == 'hindu') ? 'selected' : ''; ?> value="hindu">Hindu</option>
                <option <?php echo ($userdata->user_agama == 'budha') ? 'selected' : ''; ?> value="budha">Buddha</option>
                <option <?php echo ($userdata->user_agama == 'konghuchu') ? 'selected' : ''; ?> value="konghuchu">Konghuchu</option>
            </select>
        </div>
    </div>
    <div class="hr-text text-muted text-uppercase small">
        <span>Domisili</span>
    </div>
    <div class="row">

        <div class="col-md-12">
            <label class="form-label">Provinsi</label>
            <select class="form-select" name="user_provinsi" id="provinsi_id" onchange="getkabkota()" required>
                <option selected disabled>Provinsi</option>
                <?php
                $getprov = $this->db->query('SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 2');
                foreach ($getprov->result() as $provinsi) {
                ?>
                    <option <?php echo ($userdata->user_provinsi == $provinsi->kode) ? 'selected' : ''; ?> value="<?php echo $provinsi->kode ?>"><?php echo $provinsi->nama ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label class="form-label">Kota / Kabupaten</label>
            <select class="form-select" name="user_kota" id="kabkota_id" onchange="getkecamatan()" required>
                <option selected disabled>Kota / Kabupaten</option>
                <?php
                if ($userdata->user_provinsi) {
                    $getkab = $this->db->query("SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 5 AND LEFT(kode, 2) = '" . $userdata->user_provinsi . "'");
                    foreach ($getkab->result() as $show) {
                        $selectcity         = ($show->kode == $userdata->user_kota) ? 'selected disabled' : false;
                ?>
                        <option <?php echo $selectcity ?> value="<?php echo $show->kode ?>"><?php echo $show->nama ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kecamatan</label>
            <select class="form-select" name="user_kec" id="kecamatan_id" required>
                <option selected disabled>Kecamatan</option>
                <?php
                if ($userdata->user_kota) {
                    $getkec = $this->db->query("SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 8 AND LEFT(kode, 5) = '" . $userdata->user_kota . "'");
                    foreach ($getkec->result() as $show) {
                        $selectkec         = ($show->kode == $userdata->user_kec) ? 'selected disabled' : false;
                ?>
                        <option <?php echo $selectkec ?> value="<?php echo $show->kode ?>"><?php echo $show->nama ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label class="form-label">Kode Pos</label>
            <input type="text" value="<?php echo $userdata->user_kodepos; ?>" class="form-control" name="user_kodepos" placeholder="Kode Pos" autocomplete="off" onkeypress="return event.charCode != 32">
        </div>
        <div class="col-md-6">
            <label class="form-label">Alamat Lengkap</label>
            <input type="text" value="<?php echo $userdata->user_alamat; ?>" class="form-control" name="user_alamat" placeholder="Alamat Lengkap" autocomplete="off">
        </div>
    </div>
    <div class="hr-text text-muted text-uppercase small">
        <span>Data Ahli Waris</span>
    </div>
    <div class="row mt-2">

        <div class="col-md-6">
            <label class="form-label">Nama Ahli Waris</label>
            <input value="<?php echo $userdata->user_ahliwaris; ?>" type="text" class="form-control" name="user_ahliwaris" placeholder="Nama Ahli Waris" autocomplete="new-password">
        </div>
        <div class="col-md-6">
            <label class="form-label">Hubungan</label>
            <input value="<?php echo $userdata->user_hubungan; ?>" type="text" class="form-control" name="user_hubungan" placeholder="Hubungan" autocomplete="new-password">
        </div>
    </div>
    <div class="hr-text text-muted text-uppercase small">
        <span>Data Bank</span>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Rekening Atas Nama</label>
        <input type="text" name="user_bank_account" class="form-control" placeholder="Rekening Atas Nama" value="<?php echo $userdata->user_bank_account; ?>" autocomplete="off">
    </div>
    <div class="row mt-2">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Bank</label>
                <select name="user_bank_name" class="form-select">
                    <option disabled selected>Pilih Bank</option>
                    <?php
                    $bankkkk = $this->db->get('tb_bank');
                    foreach ($bankkkk->result() as $showbank) { ?>
                        <option <?php echo ($userdata->user_bank_name == $showbank->bank_name) ? 'selected' : ''; ?> value="<?php echo $showbank->bank_name; ?>"><?php echo $showbank->bank_name; ?></option>
                    <?php }; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">No Rekening</label>
                <input type="text" name="user_bank_number" class="form-control" value="<?php echo $userdata->user_bank_number; ?>" placeholder="No Rekening" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn w-100 my-2 btn-primary" style="color:#fff">Update Data Member</button>
    </div>
    <?php echo form_close(); ?>
    <script type="text/javascript">
        function getkabkota() {
            var provinsi_id = $('#provinsi_id').val();

            $.ajax({
                url: '<?php echo site_url('getdata/user_get/getother/getwilayahKabKota') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    provinsi_id: provinsi_id,
                }
            }).done(function(data) {
                $('#kabkota_id').empty();
                $('#kecamatan_id').empty();
                $('#kabkota_id').append('<option disabled selected>Kabupaten / Kota</option>');
                $.each(data.result, function(index, val) {
                    $('#kabkota_id').append('<option value="' + val.kode + '">' + val.nama + '</option>');
                });
            })
        }

        function getkecamatan() {
            var kabkota_id = $('#kabkota_id').val();
            $.ajax({
                url: '<?php echo site_url('getdata/user_get/getother/getwilayahKec') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    kabkota_id: kabkota_id
                }
            }).done(function(data) {
                $('#kecamatan_id').empty().append('<option disabled selected>Kecamatan</option>');
                $.each(data.result, function(index, val) {
                    $('#kecamatan_id').append('<option value="' + val.kode + '">' + val.nama + '</option>');
                });
            });
        }
        $(document).ready(function() {
            $('#change_userdata').submit(function(event) {
                event.preventDefault();

                $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/userlist/update_member') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: $('#change_userdata').serialize(),
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
    <?php echo form_open('', array('id' => 'change_password')); ?>
    <input type="hidden" name="code" value="<?php echo $code; ?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Current Password</label>
        <input type="text" value="<?php echo $userdata->user_passtext; ?>" readonly class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">New Password</label>
        <input type="text" name="password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <button class="btn w-100 my-2 btn-primary" style="color:#fff">Update Password</button>
    </div>
    <?php echo form_close(); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#change_password').submit(function(event) {
                event.preventDefault();

                $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/userlist/update_password_member') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: $('#change_password').serialize(),
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