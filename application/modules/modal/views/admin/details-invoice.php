<?php
$code = $this->input->get('code');

$this->db->where('pembayaran_code', $code);
$this->db->join('tb_users_invoice', 'invoice_id = pembayaran_invoice_id');
$cekkkkPAY = $this->db->get('tb_users_pembayaran');

if ($cekkkkPAY->num_rows() == 0) {
?>
    <center>Data Tidak Ditemukan</center>
<?php } else {
    $dataPAY  = $cekkkkPAY->row();
?>
    <style>
        .receipt {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h2 {
            margin: 0;
        }

        .receipt-body {
            margin-bottom: 20px;
        }

        .receipt-footer {
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .total {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .ble td,
        tfoot th {
            border-top: 2px dotted #3890ba !important;
        }
    </style>
    <!-- <div class="receipt"> -->
    <div class="receipt-header">
        <div class="row">
            <div class="col">
                <p>Bank Admin</p>
                <p><?= $dataPAY->pembayaran_tobankaccount ?></p>
                <p><?= $dataPAY->pembayaran_tobankname . ' - ' . $dataPAY->pembayaran_tobanknumber ?></p>
            </div>
            <div class="col">
                <p>Bank User</p>
                <p><?= $dataPAY->pembayaran_frombankaccount ?></p>
                <p><?= $dataPAY->pembayaran_frombankname . ' - ' . $dataPAY->pembayaran_frombanknumber ?></p>
            </div>
        </div>
        <hr>
    </div>
    <div class="receipt-body">
        <div class="row mb-2">
            <div class="col-6 text-center">Tanggal: <?php echo $dataPAY->pembayaran_date_add ?></div>
            <div class="col-6 text-center">No. Struk: <?php echo $dataPAY->invoice_kodeinv ?></div>
        </div>

        <table class="table ble">
            <thead>
                <tr>
                    <th>Paket</th>
                    <th class="text-center" width="5%">Jumlah</th>
                    <th class="text-center" width="25%">Harga</th>
                    <th class="text-center" width="25%">Kode Unik</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $this->db->where('package_id', $dataPAY->invoice_package_id);
                $getpaket = $this->db->get('tb_packages');
                ?>
                    <tr>
                        <td><?php echo $getpaket->row()->package_name ?></td>
                        <td class="text-center"><?=  $dataPAY->invoice_qty ?></td>
                        <td class="text-center">Rp. <?= number_format($dataPAY->invoice_total, 0, ',', '.') ?></td>
                        <td class="text-center">Rp. <?= number_format($dataPAY->invoice_kode_unik, 0, ',', '.') ?></td>
                    </tr>
            
   
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Subtotal</th>
                    <th width="25%" class="text-center">Rp. <?php echo number_format($dataPAY->invoice_subtotal, 0, ',', '.') ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-start" style="vertical-align: top;">Data Member
                        <br>
                        <?php $userdata = userdata(['id' => $dataPAY->pembayaran_userid]); ?>
                        <?php echo $userdata->user_fullname ?> (<?php echo $userdata->user_phone ?>)
                        <br>
  
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
        <div class="receipt-footer">
            <p>Untuk Rincian Bukti Transfer Klik <u><a href="<?php echo base_url('assets/upload/' . $dataPAY->pembayaran_struk) ?>" target="_blank" class="text-primary">Disini!</a></u> </p>
        </div>
<?php } ?>