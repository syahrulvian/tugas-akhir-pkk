<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Getother extends CI_Model
{

    private static $data = [
        'status'  => true,
        'message' => null,
        'result'  => null,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function get_paket_by_kategori() {
        $id = $this->input->get('katpkg_id');
        $paket = $this->db->get_where('tb_package', ['package_categori' => $id])->result();

        self::$data['result'] = $paket;
        return self::$data;
    }

    public function get_kategori() {
        $kategori = $this->db->get('tb_kategori_pkg')->result();
        foreach ($kategori as $k) {
            echo '<li data-id="'.$k->katpkg_id.'" class="kategori-item">'.$k->katpkg_name.'</li>';
        }
    }


    // function cekusernamedownline()
    // {
    //     $data['status']     = FALSE;
    //     $data['pesan']      = "Username Tidak Dikenal";
    //     $data['userdata']   = NULL;

    //     $this->db->where('username', $this->input->get('uname'));
    //     $cek_user = $this->db->get('tb_users');
    //     if ($cek_user->num_rows() != 0) {
    //         $data['status']     = TRUE;
    //         $data['pesan']      = NULL;
    //         $data['userdata']   = $cek_user->row();
    //     }
    //     return $data;
    // }

    function cekusername()
    {
        $data['status']     = FALSE;
        $data['pesan']      = "Username Tidak Dikenal";
        $data['userdata']   = NULL;

        $this->db->where('username', $this->input->get('uname'));
        $cek_user = $this->db->get('tb_users');
        if ($cek_user->num_rows() != 0) {
            $data['status']     = TRUE;
            $data['pesan']      = NULL;
            $data['userdata']   = $cek_user->row();
        }
        return $data;
    }

    public function getbankadmin()
    {
        $this->db->where('bankadmin_code', $this->input->get('jenisbank'));
        $getbank = $this->db->get('tb_adminbank');
        self::$data['result'] = $getbank->row();
        return self::$data;
    }

    public function getwilayahKabKota()
    {
        $getkabupaten = $this->db->query("SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 5 AND LEFT(kode, 2) = '" . $this->input->get('provinsi_id') . "'");
        self::$data['result'] = $getkabupaten->result();
        return self::$data;
    }

    public function getwilayahKec()
    {
        $getkecamatan = $this->db->query("SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 8 AND LEFT(kode, 5) = '" . $this->input->get('kabkota_id') . "'");
        self::$data['result'] = $getkecamatan->result();
        return self::$data;
    }

    public function getwilayahKel()
    {
        $getkelurahan = $this->db->query("SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 13 AND LEFT(kode, 8) = '" . $this->input->get('kecamatan_id') . "'");
        self::$data['result'] = $getkelurahan->result();
        return self::$data;
    }

    function getdetailpaket()
    {
        $harga['harga'] = 0;

        $this->db->where('package_type', 'active');
        $this->db->where('package_id', $this->input->get('paket_id'));
        $cekpaket = $this->db->get('tb_packages');
        if ($cekpaket->num_rows() != 0) {
            $harga['harga'] = $cekpaket->row()->package_price;
        }
        return $harga;
    }

    function hitungharga()
    {
        $jmlpin     = preg_replace('/[^0-9.]+/', '', preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $this->input->get('jmlpin')));
        $harga_pin  = preg_replace('/[^0-9.]+/', '', preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $this->input->get('harga_pin')));

        $totalll    = (int)$harga_pin * (int)$jmlpin;

        $hitung['harga']    = $totalll;
        return $hitung;
    }
    function getpaketpenjual()
    {
        $stockpinn = array();

        $this->db->where('id', $this->input->get('penjual_id'));
        $getttttttt = $this->db->get('tb_users');
        if ($getttttttt->num_rows() != 0) {
            $userdata = $getttttttt->row();

            $this->db->order_by('package_id', 'ASC');
            $this->db->where('package_type', 'active');
            $getpaket = $this->db->get('tb_packages');
            foreach ($getpaket->result() as $show) {

                $this->db->where('package_type', 'active');
                $this->db->where('pin_userid', (int)$userdata->id);
                $this->db->where('pin_package_id', (int)$show->package_id);
                $this->db->join('tb_packages', 'pin_package_id = package_id');
                $getpinnnn = $this->db->get('tb_users_pin');
                $admin = true;
                $stockkkk = $getpinnnn->num_rows();

                $stockpinn[] = array(
                    'statusshow'    => $admin,
                    'paket'         => $show->package_name,
                    'stockpin'      => $stockkkk,
                    'paket_id'    => $show->package_id,
                );
            }
        }
        Self::$data['result'] = $stockpinn;
        return Self::$data;
    }

    function cekusernamedownline()
    {
        $data['status']     = TRUE;
        $data['pesan']      = '';

        $this->db->where('username', $this->input->get('uname'));
        $cek_user = $this->db->get('tb_users');
        if ($cek_user->num_rows() == 0) {
            $data['status']     = false;
            $data['pesan']      = 'Username tidak ditemukan';
            return $data;
        }
        if ($cek_user) {
            $arrayjaringan = $this->usermodel->jaringansaya(userid()) ?? [];
            if (!in_array($cek_user->row()->id, $arrayjaringan)) {
                $data['status']     = false;
                $data['pesan']      = 'Username tidak didalam jaringan';
                return $data;
            }
        }
        if ($data['status']) {
            $data['pesan']      = 'Username : ' . $cek_user->row()->username . ' - ' . $cek_user->row()->user_fullname . ' Dalam Jaringan Tersedia';
            $data['userdata']   = $cek_user->row();

            $this->db->where('pin_userid', $cek_user->row()->id);
            $this->db->where('pin_package_id', (int)7);
            $data['pinRO'] = $this->db->get('tb_users_pin')->num_rows();
        }
        return $data;
    }
}
