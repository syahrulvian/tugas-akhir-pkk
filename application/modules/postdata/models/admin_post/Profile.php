<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Model
{
    private static $data = [
        'status'  => true,
        'message' => null,
    ];

    public function __construct()
    {
        parent::__construct();
        Self::$data['csrf_data'] = $this->security->get_csrf_hash();
    }

    function ubahKurs()
    {
        $this->form_validation->set_rules('kurs_dollar', 'Kurs Dollar', 'required|numeric');
        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['message'] = validation_errors(' ', '<br/>');
        }

        // Jika semua validasi lolos
        if (Self::$data['status']) {
           
            $this->db->update('tb_options', [
                'option_desc1' => post('kurs_dollar')
            ],[
                'option_name' => 'kurs_dollar'
            ]);

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Kurs berhasil diperbarui!';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }

    function update_pass()
    {
        // Validasi password lama
        if (!$this->ion_auth->hash_password_db(userid(), post('current_password'))) {
            Self::$data['status']  = false;
            Self::$data['message'] = 'Password lama tidak sesuai!';
        }

        // Validasi form input
        $this->form_validation->set_rules('current_password', 'Password Lama', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');

        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['message'] = validation_errors(' ', '<br/>');
        }

        // Jika semua validasi lolos
        if (Self::$data['status']) {
            $this->ion_auth->update(userid(), [
                'password' => post('new_password')
            ]);

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Password berhasil diperbarui!';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }
}
