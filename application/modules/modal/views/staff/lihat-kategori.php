<!-- Modal Lihat Kategori -->

<?php echo form_open('', 'id="hapusKategori"'); ?>

<!-- HEADER -->
<div class="modal-header bg-primary text-white rounded-top-4">
    <h5 class="modal-title fw-bold">
        <i class="fas fa-tags me-2"></i> Data Kategori
    </h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<!-- BODY -->
<div class="modal-body p-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Kategori</th>
                    <th>Jenis Kategori</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = 15;
                $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
                $no = $offset + 1;

                $this->db->order_by('nama_kategori', 'ASC');
                $getdata = $this->db->get('tb_kategori', $limit, $offset);
                $Gettotal = $this->db->get('tb_kategori')->num_rows();

                if ($getdata->num_rows() > 0) {
                    foreach ($getdata->result() as $show) {
                        ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $show->nama_kategori; ?></td>
                            <td><?= $show->jenis_kategori; ?></td>
                            <td>
                                <?= $show->status
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-danger">Nonaktif</span>'; ?>
                            </td>
                            <td>
                                <button type="button" onclick="hapusKategori('<?= $show->id_kategori ?>')"
                                    class="btn btn-sm btn-danger text-white" style="min-width: 20px;" title="Hapus Kategori">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center text-muted p-4">
                                        <i class="fas fa-info-circle me-2"></i>Tidak ada data kategori.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- FOOTER -->
<div class="modal-footer border-0">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>

<?php echo form_close(); ?>


<!-- Script JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fokus tombol close setelah modal tampil
        var modalEl = document.getElementById('modalLihatKategori');
        if (modalEl) {
            modalEl.addEventListener('shown.bs.modal', function () {
                var btnClose = modalEl.querySelector('.btn-close');
                if (btnClose) btnClose.focus();
            });
        }
    });

    function hapusKategori(id) {
        Swal.fire({
            allowOutsideClick: false,
            title: 'Apakah Anda Yakin?',
            text: "Kategori akan dihapus dan tidak bisa dikembalikan!",
            type: 'warning', // icon valid
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= site_url("postdata/staff_post/kategori/hapusKategori") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (data) {
                        // Update CSRF jika ada fungsi updateCSRF
                        if (typeof updateCSRF === 'function') {
                            updateCSRF(data.csrf_data);
                        }
                        Swal.fire({
                            title: data.heading,
                            text: data.message,
                            type: data.type // pastikan "success", "error", "warning"
                        }).then(() => {
                            if (data.status) location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Terjadi kesalahan server.', 'error');
                    }
                });
            }
        });
    }
</script>