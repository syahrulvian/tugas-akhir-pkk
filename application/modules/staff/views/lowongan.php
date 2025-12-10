<?php
$this->template->title->set('Data Package');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Data Package');
?>
<div class="card shadow-sm">
    <div class="card-header">
        <!-- Tambah Lowongan -->
        <a href="<?= site_url('staff/add-lowongan') ?>" class="btn btn-sm btn-primary text-white">
            <i class="fas fa-plus me-1"></i> Tambah Lowongan
        </a>

        <!-- Tambah Kategori -->
        <button type="button" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </button>

        <!-- Lihat Kategori (Modal Dinamis) -->
        <a
            href="javascript:void(0);"
            class="btn btn-sm btn-primary text-white"
            data-bs-href="<?= site_url('modal/staff/lihat-kategori') ?>"
            data-bs-title="Lihat Kategori"
            data-bs-remote="false"
            data-bs-toggle="modal"
            data-bs-target="#dinamicModal"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            title="Lihat Kategori">
            <i class="fas fa-eye me-1"></i> Lihat Kategori
        </a>
    </div>



    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover caption-top align-middle">
                <caption>Daftar Lowongan Kerja</caption>

                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Judul Lowongan</th>
                        <th>Perusahaan</th>

                        <th>Alamat</th>
                        <th>Durasi</th>
                        <th>Keahlian</th>
                        <th>Tipe Kerja</th>
                        <th>Deskripsi</th>
                        <th>Thumbnail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $limit  = 15;
                    $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
                    $no     = $offset + 1;

                    $this->db->order_by('lowongan_date', 'DESC');
                    $getdata  = $this->db->get('tb_lowongan', $limit, $offset);
                    $Gettotal = $this->db->get('tb_lowongan')->num_rows();

                    if ($getdata->num_rows() > 0):
                        foreach ($getdata->result() as $show):

                            $keahlian = $this->db
                                ->get_where(
                                    'tb_kategori',
                                    ['id_kategori' => $show->kategori_id]
                                )
                                ->row();

                            $tipe_kerja = $this->db
                                ->get_where(
                                    'tb_kategori',
                                    ['id_kategori' => $show->kategori_tipe]
                                )
                                ->row();
                    ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td><?= html_escape($show->lowongan_judul) ?></td>
                                <td><?= html_escape($show->lowongan_perusahaan) ?></td>
                                <td><?= html_escape($show->lowongan_alamat) ?></td>

                                <td class="text-center">
                                    <?= date('d M', strtotime($show->lowongan_start)) ?>
                                    -
                                    <?= date('d M', strtotime($show->lowongan_end)) ?>
                                </td>

                                <td>
                                    <?= $keahlian ? html_escape($keahlian->nama_kategori) : '-' ?>
                                </td>

                                <td>
                                    <?= $tipe_kerja ? html_escape($tipe_kerja->nama_kategori) : '-' ?>
                                </td>

                                <td>
                                    <?= word_limiter(strip_tags($show->lowongan_desc), 10) ?>
                                </td>

                                <td class="text-center">
                                    <?php if (!empty($show->lowongan_img)): ?>
                                        <img
                                            src="<?= base_url('assets/lowongan/thumbnail/' . $show->lowongan_img) ?>"
                                            style="max-width:80px;border-radius:5px;">
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= site_url('staff/edit-lowongan/' . $show->lowongan_code) ?>"
                                        class="btn btn-sm btn-success mb-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="hapuslowongan('<?= $show->lowongan_code ?>')"
                                        class="btn btn-sm btn-danger mb-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        endforeach;
                    else:
                        ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted p-4">
                                Tidak ada data Lowongan ditemukan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?= $this->paginationmodel->paginate('tb_lowongan', $Gettotal, $limit); ?>

        </div>
    </div>
</div>





<script>
    function hapuslowongan(code) {
        Swal.fire({
            allowOutsideClick: false,
            title: 'Apakah Anda Yakin',
            text: "Lowongan Akan Dihapus dan Tidak Dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {

                $.ajax({
                        url: '<?php echo site_url('postdata/staff_post/lowongan/hapuslowongan') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            code: code,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
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
            }
        });
    }
</script>

<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- FORM -->
            <?php echo form_open('', 'id="TambahKategori"'); ?>
            <!-- HEADER -->
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-tags me-2"></i> Tambah Kategori
                </h5>
                <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text"
                        name="nama_kategori"
                        class="form-control"
                        placeholder="Contoh: Teknik Pemesinan"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kategori</label>
                    <select name="jenis_kategori"
                        class="form-select"
                        required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="keahlian">Keahlian</option>
                        <option value="tipe_kerja">Tipe Kerja</option>
                    </select>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0">
                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit"
                    class="btn btn-primary fw-bold">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {

        $('#btns2').hide();
        $('#TambahKategori').submit(function(event) {
            event.preventDefault();
            $('#btns1').hide();
            $('#btns2').show();

            $.ajax({
                    url: '<?php echo site_url('postdata/staff_post/lowongan/addkategori') ?>',
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
                            location.href = "<?php echo site_url('staff/lowongan') ?>";
                        }
                    });
                    $('#btns1').show();
                    $('#btns2').hide();

                })

        });
    });
</script>